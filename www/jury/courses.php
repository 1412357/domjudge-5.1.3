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

echo "<h1>Courses</h1>\n\n";


// Get data. Starttime seems most logical sort criterion.
$res = $DB->q('TABLE SELECT course . * , course_category.name as catname
				FROM  `course` 
				INNER JOIN  `course_category` ON course.catid = course_category.catid');
?>

<table class="list sortable">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <!-- <th>Start</th>
      <th>End</th> -->
	  <th>Lectures</th>
      <th>Cat_Name</th>
	  <th></th>
    </tr>
  </thead>
  <tbody>

	<?php
	if(!count($res)) {
		echo "<p class=\"nodata\">No courses defined</p>\n\n";
	} else {
		$numprobs = $DB->q('KEYVALUETABLE SELECT courseid, COUNT(lectureid) FROM course LEFT JOIN lecture USING(courseid) GROUP BY courseid');
		foreach ($res as $row) {
			$href = 'course.php?id=' . urlencode($row['courseid']);
			$hrefLecture = 'lectures.php?courseid=' . urlencode($row['courseid']);
			echo '
				<tr>
					<th scope="row"><a href="'.$href.'">cs'. $row['courseid'] .'</a>
					</th>
					<td> <a href="'. $href .'">'. $row['name'] .'</a>
					</td>
					<td> <a href="'. $href .'">' . $numprobs[$row['courseid']] . '</a>
					</td>
					<td> <a href="'. $href .'">'. $row['catname'] .'</a>
					</td>';

					if ( IS_ADMIN ) {
						echo "<td class=\"editdel\">" .
							editLink('course', $row['courseid']) . "&nbsp&nbsp&nbsp" .
							delLink('course','courseid',$row['courseid']) . "&nbsp&nbsp&nbsp" .
							'<a href="'. $hrefLecture .'"><img src="../images/problem.png" alt="list" title="list lecture" class="picto"></a>' .
							"</td>\n";
					}

			echo '</tr>';
		}
	} 
	
	?>
  </tbody>
</table>

<?php
if ( IS_ADMIN ) {
	echo "<p>" . addLink('course') . "</p>\n\n";
}

echo '</div>';
require(LIBWWWDIR . '/footer.php');
