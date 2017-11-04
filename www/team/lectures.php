<?php
/**
 * View/download problem texts
 *
 * Part of the DOMjudge Programming Contest Jury System and licenced
 * under the GNU GPL. See README and COPYING for details.
 */

require('init.php');

$title = 'Courses';
require(LIBWWWDIR . '/header.php');
?>
<div class="main-container box-shadow">
<div class="row">
<div class="col-sm-8 left-side">

<!-- select problems Tab -->
<script>
	selectMenuTab('problemsTab')
</script>

<?php
global $userdata;
$courseid = $_GET["courseid"];
$isPermission = $DB->q('TABLE select exists (select * from course_user where userid = %i and courseid = %i) as isPermission', $userdata["userid"],  $courseid);
if (!$isPermission[0]["isPermission"]) {
	header('Location: courses.php');
	exit();
}

echo '<div class="col-sm-12">';
echo '<div class="mt-5" style="margin-left: 20px; border-bottom: 1px solid #C2C7D0; width: 100%;">
		<h6>Lectures</h6>
		</div>';
$res = $DB->q('TABLE SELECT * FROM `lecture` WHERE `courseid` = %i', $courseid);
global $userdata;
$userID = $userdata["userid"];
?>
	<?php foreach ($res as $row) {
		$contestID = $row['contestid'];
		$scale = $DB->q("tuple select count(*) as solved,
						(select count(distinct(probid))
						from contestproblem
						where cid = $contestID) as total
						from scorecache_public
						where cid = $contestID
						and teamid = (select teamid
									from user
									where userid = $userID limit 1)
						and is_correct = 1;");
		$href = 'lecture.php?cid='.$row['contestid'];
		echo '
		<div class="course-block">
			<div class="content-block">
				<header class="course-name">
					<a href="'.$href.'">
						'.$row['name'].'
					</a>
				</header>
				<div class="description">
					<i class="status-indicator active mmR"></i>
					<span class="description-detail">'.$row['description'].'
					</span>
				</div>
			</div>
			<footer class="footer-block clearfix">
				<span class="float-left zeta" style="
					  margin-top: 12px; font-size: 90%"><span style="font-size: 120%; color: #39424e">'.$scale['solved'].'</span>
					   Challenge Solved / <span style="font-size: 120%; color: #39424e">' .$scale['total']. '</span> Total</span>
				<a href="'.$href.'" class="btn btn-primary btn-enter float-right">Enter</a>
			</footer>
		</div>
		';
	}
	?>
<?php
echo '</div>';
?>
</div>
<div class="col-sm-4 right-side">
  <!-- <div class="clock-block">

  </div> -->
  	<div class="toprated mr-3">
		<?php putTopRatedCourse($courseid); ?>
	</div>
</div>
</div>
</div>
<?php
require(LIBWWWDIR . '/footer.php');
