<?php
/**
 * Produce a total score. Call with parameter 'static' for
 * output suitable for static HTML pages.
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
<div class="all-courses">

	<!-- Begin Course Green -->
	<div class="challenge-card-modern" id="green" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true">
			<div class="course-img green-course">
			</div>
			<div class="summary-course">
				<div class="course-title-english">big-o green: introduction to programming</div>
				<!-- <div class="course-title-vietnamese">lập trình cơ bản</div> -->
				<div class="teacher-name">hồ tuần thanh</div>			
				<div class="fee-course">5.500.000 VNĐ</div>
			</div>
		</div>

		<div id="popover-content-green"  hidden>
			<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_2 detail-course">
						
				<p style="text-align: center;"><span style="color: #000000;"><strong><a href="khoa-hoc-dang-mo/#tongquankhoahoc" style="color: #000000;">BIG-O GREEN: INTRODUCTION TO PROGRAMMING</a></strong></span></p>
				<p style="text-align: center;"><span style="color: #000000;"><strong>LẬP TRÌNH CƠ BẢN</strong></span></p>
				<p style="text-align: center;"><span style="color: #ff0000;"><strong>KHÓA 2 KHAI GIẢNG 06/11/2017 </strong></span></p>
				<p style="text-align: center;"><span style="text-decoration: line-through;"><span style="color: #000000;"><strong><a href="khoa-hoc-dang-mo/#tongquankhoahoc">Học phí: 5.500.000</a></strong></span></span></p>
				<p style="text-align: center;"><span style="color: #000000;"><strong>Ưu đãi học phí khai giảng khóa đầu tiên còn: 4.000.000</strong></span></p>
				<p style="text-align: justify;"><span style="color: #000000;">Khóa học dành cho các bạn chưa học về Lập Trình trước đó, những bạn chuyển từ ngành khác sang Công Nghệ Thông Tin, hoặc những bạn học Lập Trình như chưa thành thạo. Lớp này sẽ là tiền đề để các bạn bước vào các lớp học Thuật Toán sau này.</span></p>

			</div>
		</div>

		<script>
		$(document).ready(function(){
			$("#green").popover({
				html: true,
				delay: { 
					show: "500", 
					hide: "100"
				}, 
				content: function() {
					return $('#popover-content-green').html();
					}
			});
		});
		</script>
	<!-- Begin Course Green -->

	<!-- Begin Course blue -->
	<div class="challenge-card-modern" id="blue" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true">
			<div class="course-img blue-course">
			</div>
			<div class="summary-course">
				<div class="course-title-english">big-o blue: introduction to algorithms</div>
				<!-- <div class="course-title-vietnamese">lập trình cơ bản</div> -->
				<div class="teacher-name">phạm nguyễn sơn tùng</div>			
				<div class="fee-course">6.500.000 VNĐ</div>
			</div>
		</div>

		<div id="popover-content-blue"  hidden>
			<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left et_pb_text_2 detail-course">
					
				<p style="text-align: center;"><span style="color: #000000;"><a href="khoa-hoc-dang-mo/#tongquankhoahoc" style="color: #000000;"><strong>BIG-O BLUE: INTRODUCTION TO ALGORITHMS</strong></a></span></p>
				<p style="text-align: center;"><span style="color: #000000;"><strong>THUẬT TOÁN CƠ BẢN</strong></span></p>
				<p style="text-align: center;"><span style="color: #ff0000;"><strong>KHÓA 7 KHAI GIẢNG 09/01/2018</strong></span></p>
				<p style="text-align: center;"><span style="text-decoration: line-through;"><strong><a href="khoa-hoc-dang-mo/#tongquankhoahoc">Học phí: 6.500.000</a></strong></span></p>
				<p style="text-align: justify;"><span style="color: #000000;"><strong>ĐẶC BIỆT: Giảm 20% khai giảng còn 5.200.000 cho 10 bạn đăng ký đầu tiên.</strong></span></p>
				<p style="text-align: justify;"><span style="color: #000000;"><strong>Đặc biệt: có chính sách chia học phí ra nhiều lần đóng dành cho các bạn học sinh/sinh viên.</strong></span></p>
				<p style="text-align: justify;"><span style="color: #000000;"><a href="khoa-hoc-dang-mo/#tongquankhoahoc" style="color: #000000;">Khóa học được thiết kế sinh động dễ hiểu, bài tập áp dụng thực tế cần thiết cho các Lập Trình Viên Chuyên Nghiệp. Giảng Viên 5 năm là Huấn Luyện Viên trưởng đội tuyển HCMUS, 2 lần đại diện Việt Nam tham dự vòng Chung Kết Thế Giới kỳ thi Lập Trình ACM-ICPC World Finals.</a></span></p>

			</div>
		</div>

		<script>
		$(document).ready(function(){
			$("#blue").popover({
				html: true,
				delay: { 
					show: "500", 
					hide: "100"
				}, 
				content: function() {
					return $('#popover-content-blue').html();
					}
			});
		});
		</script>
	<!-- Begin Course blue -->

	<!-- Begin Course orange -->
	<div class="challenge-card-modern" id="orange" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true">
			<div class="course-img orange-course">
			</div>
			<div class="summary-course">
				<div class="course-title-english">big-o orange: advanced algorithms</div>
				<!-- <div class="course-title-vietnamese">lập trình cơ bản</div> -->
				<div class="teacher-name">phạm nguyễn sơn tùng</div>			
				<div class="fee-course">Coming soon</div>
			</div>
		</div>

		<div id="popover-content-orange"  hidden>
			<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left et_pb_text_2 detail-course">
					
				<p style="text-align: center;"><span style="color: #000000;"><strong>BIG-O ORANGE: ADVANCED ALGORITHMS</strong></span></p>
				<p style="text-align: center;"><span style="color: #000000;"><strong><img class="wp-image-168 alignnone size-medium" src="wp-content/uploads/2017/02/095-300x291.png" alt="" width="133" height="129" srcset="http://bigocoding.com/wp-content/uploads/2017/02/095-300x291.png 300w, http://bigocoding.com/wp-content/uploads/2017/02/095.png 528w" sizes="(max-width: 133px) 100vw, 133px"></strong></span></p>

			</div>
		</div>

		<script>
		$(document).ready(function(){
			$("#orange").popover({
				html: true,
				delay: { 
					show: "500", 
					hide: "100"
				}, 
				content: function() {
					return $('#popover-content-orange').html();
					}
			});
		});
		</script>
	<!-- Begin Course orange -->

	<!-- Begin Course red -->
	<div class="challenge-card-modern" id="red" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true">
	<div class="overlay"></div>
			<div class="course-img red-course">
			</div>
			<div class="summary-course">
				<div class="course-title-english">big-o red: Guru algorithms</div>
				<!-- <div class="course-title-vietnamese">lập trình cơ bản</div> -->
				<div class="teacher-name">phạm nguyễn sơn tùng</div>			
				<div class="fee-course">Coming soon</div>
			</div>
		</div>

		<div id="popover-content-red"  hidden>
			<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left et_pb_text_2 detail-course">
					
				<p style="text-align: center;"><span style="color: #000000;"><strong>BIG-O RED: GURU ALGORITHMS</strong></span></p>
				<p style="text-align: center;"><span style="color: #000000;"><strong><img class="wp-image-168 alignnone size-medium" src="wp-content/uploads/2017/02/095-300x291.png" alt="" width="133" height="129" srcset="http://bigocoding.com/wp-content/uploads/2017/02/095-300x291.png 300w, http://bigocoding.com/wp-content/uploads/2017/02/095.png 528w" sizes="(max-width: 133px) 100vw, 133px"></strong></span></p>

			</div>
		</div>

		<script>
		$(document).ready(function(){
			$("#red").popover({
				html: true,
				delay: { 
					show: "500", 
					hide: "100"
				}, 
				content: function() {
					return $('#popover-content-red').html();
					}
			});
		});
		</script>
	<!-- Begin Course red -->

</div>
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

// OLD VERSION
/*
require('init.php');
$title="Scoreboard";
// set auto refresh
$refresh="30;url=./";

// This reads and sets a cookie, so must be called before headers are sent.
$filter = initScorefilter();

$menu = true;
require(LIBWWWDIR . '/header.php');

$isstatic = @$_SERVER['argv'][1] == 'static' || isset($_REQUEST['static']);

if ( ! $isstatic ) {
	echo "<div id=\"menutopright\">\n";
	putClock();
	echo "</div>\n";
}

// call the general putScoreBoard function from scoreboard.php
putScoreBoard($cdata, null, $isstatic, $filter);

echo "<script type=\"text/javascript\">initFavouriteTeams();</script>";

require(LIBWWWDIR . '/footer.php');
