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

<!-- <div class="course-block">
	<div class="content-block">
		<header class="course-name">
			<a href="">
				Project Euler #191: Prize Strings
			</a>
		</header>
		<div class="description">
			<i class="status-indicator active mmR"></i>
			<span class="description-detail">
				Làm quen với các Thuật Toán liên quan đến đồ thị (Graph) (Breadth-first search, Depth-first search).
				Giải quyết các bài toán về đường đi và giao thông:
					Tìm đường thoát khỏi mê cung.
					Tìm giải pháp việc đi thang máy nhanh nhất.
			</span>
		</div>
	</div>
	<footer class="footer-block clearfix">
		<div class="float-left">
			<span class="msR">
				<span class="zeta">Start Time: </span>
				<span class="course-date">01/01/1970</span>
			</span>
			<span class="msR">
				<span class="zeta">End Time: </span>
				<span class="course-date">01/01/1970</span>
			</span>
		</div>
		<a href="" class="btn btn-primary btn-enter float-right">Enter</a>
	</footer>
</div> -->

<!-- Show All Available Courses -->
<?php
/*
echo '<div class="col-sm-12">';
echo '<div class="mt-5" style="margin-left: 20px; border-bottom: 1px solid #C2C7D0; width: 100%">
			<h6>Available Courses</h6>
		</div>';
global $userdata;
$res = $DB->q('TABLE SELECT `courseid`, `name`, `description`, `starttime`, `endtime`
				FROM `course` LEFT JOIN `course_user` USING(`courseid`)
				WHERE (`userid` != %i OR `userid` IS NULL) AND (`starttime` <= unix_timestamp() AND `endtime` >= unix_timestamp())', $userdata["userid"]);
?>
	<?php foreach ($res as $row) {
	echo '
			<div class="course-block">
				<div class="content-block">
					<header class="course-name">
						<p>
							'.$row['name'].'
						</p>
					</header>
					<div class="description">
						<i class="status-indicator active mmR"></i>
						<span class="description-detail">'.$row['description'].'
						</span>
					</div>
				</div>
				<footer class="footer-block clearfix">
					<div class="float-left">
						<span class="msR">
							<span class="zeta">Start Time: </span>
							<span class="course-date">'.printtime($row['starttime'], '%d/%m/%Y').'</span>
						</span>
						<span class="msR">
							<span class="zeta">End Time: </span>
							<span class="course-date">'.printtime($row['endtime'], '%d/%m/%Y').'</span>
						</span>
					</div>
				</footer>
			</div>
			';
	}
	?>
<?php
echo '</div>';
?>

<!-- Show All Upcoming Courses -->
<?php

echo '<div class="col-sm-12">';
echo '<div class="" style="margin-left: 20px; border-bottom: 1px solid #C2C7D0; width: 100%">
		<h6>Upcoming Courses</h6>
	  </div>';
global $userdata;
$res = $DB->q('TABLE SELECT `courseid`, `name`, `description`, `starttime`, `endtime`
				FROM `course` LEFT JOIN `course_user` USING(`courseid`)
				WHERE (`userid` != %i OR `userid` IS NULL) AND (`starttime` > unix_timestamp())', $userdata["userid"]);
?>
	<?php foreach ($res as $row) {
	// $href = 'lectures.php?courseid='.$row['courseid'];
	echo '
			<div class="course-block">
				<div class="content-block">
					<header class="course-name">
						<p>
							'.$row['name'].'
						</p>
					</header>
					<div class="description">
						<i class="status-indicator active mmR"></i>
						<span class="description-detail">'.$row['description'].'
						</span>
					</div>
				</div>
				<footer class="footer-block clearfix">
					<div class="float-left">
						<span class="msR">
							<span class="zeta">Start Time: </span>
							<span class="course-date">'.printtime($row['starttime'], '%d/%m/%Y').'</span>
						</span>
						<span class="msR">
							<span class="zeta">End Time: </span>
							<span class="course-date">'.printtime($row['endtime'], '%d/%m/%Y').'</span>
						</span>
					</div>
				</footer>
			</div>
			';
	}
	?>
<?php
echo '</div>';
?> */ ?>

</div>
<div class="col-sm-4 right-side">
  <!-- <div class="clock-block">

  </div> -->
  	<div class="toprated mr-3">
		<?php putTopRated(); ?>
	</div>
</div>
</div>
</div>
<?php
require(LIBWWWDIR . '/footer.php');
