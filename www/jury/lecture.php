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
                 'Lecture' . ($id ? ' l'.specialchars(@$id) : ''));

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
		$row = $DB->q('MAYBETUPLE SELECT * FROM lecture WHERE lectureid = %s', $id);
		if ( !$row ) error("Missing or invalid lecture id");

		echo "<tr><td>Lecture ID:</td><td>" .
			addHidden('keydata[0][lectureid]', $row['lectureid']) .
			'l' . specialchars($row['lectureid']) .
			"</td></tr>\n";
	}
?>

<tr><td><label for="data_0__name_">Lecture name:</label></td>
<td colspan="2"><?php echo addInput('data[0][name]', @$row['name'], 40, 255, 'required')?></td></tr>

<tr><td><label for="data_0__description_">Description:</label></td>
<td colspan="2"><?php echo addTextArea('data[0][description]', @$row['description'], 40, 10, 'required style="background-color: white"')?></td></tr>

<!-- Course selection -->
<tr><td><label for="data_0__contestid_">Course:</label></td>
<td><?php
$tmap = $DB->q("KEYVALUETABLE SELECT courseid, name FROM course ORDER BY name");
echo addSelect('data[0][courseid]', $tmap, isset($row['courseid'])?$row['courseid']:@$_GET['forcourse'], true);
?>

<!-- Contest selection -->
<tr><td><label for="data_0__contestid_">Contest:</label></td>
<td><?php
$tmap = $DB->q("KEYVALUETABLE SELECT cid, name FROM contest ORDER BY name");
echo addSelect('data[0][contestid]', $tmap, isset($row['contestid'])?$row['contestid']:@$_GET['forcontest'], true);

if ( IS_ADMIN ) {
	echo "<span> Add new contest " . addLink('contest') . "</span>\n\n";
}
?>

</td></tr>

</table>

<?php
echo addHidden('cmd', $cmd) .
	addHidden('table','lecture') .
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
		addHidden('lectureid', $id) .
		addEndForm();

}


$data = $DB->q('TUPLE SELECT * FROM lecture WHERE lectureid = %i', $id);

echo "<h1>Lecture: ".specialchars($data['name'])."</h1>\n\n";

$contest = $DB->q("TUPLE SELECT * FROM `contest` WHERE cid = %i", $data["contestid"]);
$course = $DB->q("TUPLE SELECT * FROM `course` WHERE courseid = %i", $data["courseid"]);

echo "<table>\n";
echo '<tr><td>Lectureid:</td><td>l' .
	(int)$data['lectureid'] . "</td></tr>\n";
echo '<tr><td>Name:</td><td>' .
	specialchars($data['name']) .
	"</td></tr>\n";
echo '<tr><td>Description:</td><td> <textarea style="background-color: white" rows="5" cols="100">' 
		.specialchars($data['description']) .
	"</textarea></td></tr>\n";

$href = 'course.php?id=' . urlencode($course['courseid']);
echo '<tr><td>Course:</td><td> <a href="'. $href .'">' .
	specialchars($course['name']) .
	"</a> </td></tr>\n";

$href = 'contest.php?id=' . urlencode($contest['cid']);
echo '<tr><td>Contest:</td><td> <a href="'. $href .'">' .
	specialchars($contest['name']) .
	"</a> </td></tr>\n";

echo '</td></tr>';
echo "</table>\n\n";

if ( IS_ADMIN ) {
	echo "<p>" .
		editLink('lecture',$data['lectureid']) . "\n" .
		delLink('lecture','lectureid',$data['lectureid']) ."</p>\n\n";
}

echo '</div>';
require(LIBWWWDIR . '/footer.php');
