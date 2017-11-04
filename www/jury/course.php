<?php
/**
 * View of one contest.
 *
 * Part of the DOMjudge Programming Contest Jury System and licenced
 * under the GNU GPL. See README and COPYING for details.
 */

require('init.php');
require(LIBWWWDIR . '/checkers.jury.php');

$id = getRequestID();
$title = ucfirst((empty($_GET['cmd']) ? '' : specialchars($_GET['cmd']) . ' ') .
                 'course' . ($id ? ' cs'.specialchars(@$id) : ''));

$jscolor=true;
$jqtokeninput = true;

require(LIBWWWDIR . '/header.php');
echo '<div class="col-sm-12">';

if ( !empty($_GET['cmd']) ):

	requireAdmin();

	$cmd = $_GET['cmd'];

	echo "<h2>$title</h2>\n\n";

	echo addForm('edit.php');

	echo "<table>\n";

	if ( $cmd == 'edit' ) {
		$row = $DB->q('MAYBETUPLE SELECT * FROM course WHERE courseid = %s', $id);
		if ( !$row ) error("Missing or invalid course id");

		echo "<tr><td>Course ID:</td><td>" .
			addHidden('keydata[0][courseid]', $row['courseid']) .
			'c' . specialchars($row['courseid']) .
			"</td></tr>\n";
	} else if ($cmd == 'adduser') {
		// Add new members to course_user Table
		$str = 'INSERT INTO `course_user`(`courseid`, `userid`) VALUES ';
		$courseid = $_POST['courseid'];
		foreach ($_POST as $key => $value) 
		if (strpos($key, 'adduser') !== false) {
			$str = $str . '('. $courseid .','. $value .'),';
			$teamId = $DB->q("table select teamid from user where userid = %i Limit 1", $value);
			addUserToContestTeamTable($courseid, $teamId[0]["teamid"]);
		}
		$str = rtrim($str,',');
		$DB->q($str);	
		header('Location: '.'course.php?id='.$id);
		exit();
	}
?>

<tr><td><label for="data_0__name_">Course name:</label></td>
<td colspan="2"><?php echo addInput('data[0][name]', @$row['name'], 40, 255, 'required')?></td></tr>

<tr><td><label for="data_0__description_">Description:</label></td>
<td colspan="2"><?php echo addInput('data[0][description]', @$row['description'], 40, 10, 'required')?></td></tr>

<!-- Category selection -->
<tr><td><label for="data_0__teamid_">Team:</label></td>
<td><?php
$tmap = $DB->q("KEYVALUETABLE SELECT catid,name FROM course_category ORDER BY name");
echo addSelect('data[0][catid]', $tmap, isset($row['catid'])?$row['catid']:@$_GET['forcat'], true);
?>
</td></tr>

</table>

<?php
echo addHidden('cmd', $cmd) .
	addHidden('table','course') .
	addHidden('referrer', @$_GET['referrer'] . ( $cmd == 'edit'?(strstr(@$_GET['referrer'],'?') === FALSE?'?edited=1':'&edited=1'):'')) .
	addSubmit('Save', null, 'clearTeamsOnPublic()') .
	addSubmit('Cancel', 'cancel', null, true, 'formnovalidate' . (isset($_GET['referrer']) ? ' formaction="' . specialchars($_GET['referrer']) . '"':'')) .
	addEndForm();

echo '</div>';
require(LIBWWWDIR . '/footer.php');
exit;

endif;

if ( ! $id ) error("Missing or invalid contest id");

if ( isset($_GET['edited']) ) {

	echo addForm('refresh_cache.php') .
            msgbox (
                "Warning: Refresh scoreboard cache",
		"If the contest start time was changed, it may be necessary to recalculate any cached scoreboards.<br /><br />" .
		addSubmit('recalculate caches now', 'refresh')
		) .
		addHidden('cid', $id) .
		addEndForm();

}


$data = $DB->q('TUPLE SELECT * FROM course WHERE courseid = %i', $id);

echo "<h1>Course: ".specialchars($data['name'])."</h1>\n\n";

$category = $DB->q("TUPLE SELECT * FROM `course_category` WHERE catid = %i", $data["catid"]);

echo "<table>\n";
echo '<tr><td>Courseid:</td><td>c' .
	(int)$data['courseid'] . "</td></tr>\n";
echo '<tr><td>Name:</td><td>' .
	specialchars($data['name']) .
	"</td></tr>\n";
// echo '<tr><td>Start time:</td><td>' .
// 	specialchars($data['starttime_string']) .
// 	"</td></tr>\n";
// echo '<tr><td>End time:</td><td>' .
// 	specialchars($data['endtime_string']) .
// 	"</td></tr>\n";;
echo '<tr><td>Description:</td><td>' .
	specialchars($data['description']) .
	"</td></tr>\n";
echo '<tr><td>Category:</td><td>' .
specialchars($category['name']) .
"</td></tr>\n";

echo '</td></tr>';
echo "</table>\n\n";

if ( IS_ADMIN ) {
	echo "<p>" .
		editLink('course',$data['courseid']) . "\n" .
		delLink('course','courseid',$data['courseid']) ."</p>\n\n";
}

echo '</div>';

?>

<!-- BEGIN Show all members of this course -->

<?php
	$users = $DB->q('TABLE SELECT `userid`, `username`, `name`, `email`, `course_userid` FROM `course_user`
					 INNER JOIN user USING(userid)
					 WHERE `courseid` = %i', $id);
?>
<h4>All members of this course</h4>

<?php  if (count($users) == 0) : ?>
	<h4 style="margin-left: 20px ;color: #aaa">There are no members</h4>
<?php else: ?>
	<table class="list sortable">
		<tr>
			<th>Userid</th>
			<th>Username</th>
			<th>Name</th>
			<th>Email</th>
			<th>&nbsp</th>
			<th>&nbsp</th>
		</tr>
		<?php
		foreach ($users as $row) {
			echo '
				<tr>
					<td>
						u'.$row['userid'].'
					</td>
					<td>
						'.$row['username'].'
					</td>
					<td style="padding: 0 10px 0 10px">
						'.$row['name'].'
					</td>
					<td>
						'.$row['email'].'
					</td>';

			if ( IS_ADMIN ) {
				$referrer = 'course.php?id='.$id;
				echo "<td class=\"editdel\">" .
				delLinkMultiple('course_user',array('course_userid'),array($row['course_userid']),'course.php?id='.$id) . "</td>\n";
			}
			echo '<td> 
						<a href="user.php?id='.$row['userid'].'" style="color: blue">
							Detail
						</a>
				  </td>';
			echo '</tr>';
		}
		?>
	</table>

<?php endif; ?>
<!-- END Show all members of this course -->


<!-- BEGIN Add new members to this course -->
<?php if ( IS_ADMIN ): ?>
<?php
	$users = $DB->q('TABLE SELECT *
	FROM (SELECT userid, username, `name`, email 
			FROM user 
			LEFT JOIN userrole USING (userid)
			WHERE (`roleid` = 3 OR `roleid` IS NULL)) as st
	WHERE NOT EXISTS (SELECT * FROM course_user as cs WHERE cs.userid = st.userid AND cs.courseid = %i)
	ORDER BY username', $id);
?>

<h4>Add new members to this course</h4>
<form action="course.php?cmd=adduser&id=<?php echo $id ?>" method="POST" name="info">
	<input type="hidden" name="courseid" value="<?php echo $id ?>">
	<table class="list sortable">
	<tr>
		<th>Select</th>
		<th>Username</th>
		<th>Name</th>
		<th>Email</th>
		<th>&nbsp</th>
	</tr>
	<?php
	foreach ($users as $row) {
		$identity = 'adduser'.$row['userid'];
		echo '
			<tr>
				<td>
					<input type="checkbox" name="'.$identity.'" value="'.$row['userid'].'" id="'.$identity.'">
				</td>
				<td> <label for="'.$identity.'">
					'.$row['username'].'
				</td> </label>
				<td style="padding: 0 10px 0 10px"> <label for="'.$identity.'">
					'.$row['name'].'
				</td> </label> 
				<td> <label for="'.$identity.'">
					'.$row['email'].'
				</td> </label>
				<td> 
				<a href="user.php?id='.$row['userid'].'" style="color: blue">
					Detail
				</a>
				</td>
			</tr>
		';
	}
	?>
	</table>
<input style="margin: 10px" type="submit" value="Add">
</form>
<?php endif ?>
<!-- END Add new members to this course -->

<?php
require(LIBWWWDIR . '/footer.php');
