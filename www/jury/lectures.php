<?php
/**
 * View current, past and future contests
 *
 * Part of the DOMjudge Programming Contest Jury System and licenced
 * under the GNU GPL. See README and COPYING for details.
 */

require('init.php');
require(LIBWWWDIR . '/checkers.jury.php');

$title = 'Courses';
require(LIBWWWDIR . '/header.php');
echo '<div class="col-sm-12">';

echo "<h1>Lectures</h1>\n\n";

$WhereCourseId = $_GET['courseid'] ? 'WHERE lecture.courseid = ' . $_GET['courseid'] : '';
// Get data. Starttime seems most logical sort criterion.
$res = $DB->q('TABLE SELECT lecture.*, contest.name AS contestName, course.name AS courseName
								FROM `lecture` 
								INNER JOIN `contest` ON lecture.contestid = contest.cid 
								INNER JOIN `course` ON lecture.courseid = course.courseid
								' . $WhereCourseId);
?>

<table class="list sortable">
  <thead>
    <tr>
      <th>LID</th>
      <th>Name</th>
      <!-- <th>Start</th>
      <th>End</th> -->
			<th>Description</th>
      <th>Course Name</th>
	  	<th>Contest Name</th>
	  <th></th>
    </tr>
  </thead>
  <tbody>
	<?php foreach ($res as $row) {
		$href = 'lecture.php?id=' . urlencode($row['lectureid']);
		$hrefLecture = 'problems_v2.php?contestid=' . urlencode($row['contestid']);
		echo '
			<tr>
				<th scope="row"><a href="'.$href.'">l'. $row['lectureid'] .'</a>
				</th>
				<td> <a href="'. $href .'">'. $row['name'] .'</a>
				</td>
				<td style="width: 30%"> <a href="'. $href .'">' . $row['description'] . '</a>
				</td>
				<td> <a href="'. $href .'">'. $row['courseName'] .'</a>
				</td>
				<td> <a href="'. $href .'">'. $row['contestName'] .'</a>
				</td>';
				
				if ( IS_ADMIN ) {
					echo "<td class=\"editdel\">" .
						editLink('lecture', $row['lectureid']) . "&nbsp&nbsp&nbsp" .
						delLink('lecture','lectureid',$row['lectureid']) . "&nbsp&nbsp&nbsp" .
						'<a href="'. $hrefLecture .'"><img src="../images/problem.png" alt="list" title="list problems" class="picto"></a>' .
						"</td>\n";
				}

		echo '</tr>';
	} ?>
  </tbody>
</table>

<?php
if ( IS_ADMIN ) {
	echo "<p>" . addLink('lecture') . "</p>\n\n";
}

echo '</div>';
require(LIBWWWDIR . '/footer.php');
