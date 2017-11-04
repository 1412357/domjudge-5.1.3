<?php
	global $username;
?>
	<div class="blue clearfix" id="header">
		<div class="logo float-left">
			<img src="../images/BigOlogo.png" alt="BigO" style="height: 100%;">
		</div>
		<div class="login-form float-right">
		<a href=""><?php echo $username ?></a> |
        <a href="../auth/logout.php">Logout</a>
		</div>
	</div>

	<div class="roundbox menu-box">
		<div class="menu-list-container">

			<ul class="nav menu-list main-menu-list">
				<li class="nav-item">
					<a class="active" href="index.php">Home</a>
				</li>
				<li class="nav-item">
					<a class="active" href="courses.php">Courses</a>
				</li>
				<!-- <li class="nav-item dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
					<div class="dropdown-menu">
					<a class="dropdown-item" href="#">Action</a>
					<a class="dropdown-item" href="#">Another action</a>
					<a class="dropdown-item" href="#">Something else here</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#">Separated link</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="" href="#">Link</a>
				</li>
				<li class="nav-item">
					<a class="" href="#">Disabled</a>
				</li> -->
			</ul>

		</div>
	</div>
<?php
// echo "<nav><div id=\"menutop\">\n";

// echo "<a target=\"_top\" href=\"index.php\" accesskey=\"o\">overview</a>\n";

// if ( have_problemtexts() ) {
// 	echo "<a target=\"_top\" href=\"problems.php\" accesskey=\"t\">problems</a>\n";
// }

// if ( have_printing() ) {
// 	echo "<a target=\"_top\" href=\"print.php\" accesskey=\"p\">print</a>\n";
// }

// echo "<a target=\"_top\" href=\"courses.php\" accesskey=\"b\">courses</a>\n";

// echo "<a target=\"_top\" href=\"scoreboard.php\" accesskey=\"b\">scoreboard</a>\n";

// if ( checkrole('jury') || checkrole('balloon') ) {
// 	echo "<a target=\"_top\" href=\"../jury/\" accesskey=\"j\">→jury</a>\n";
// }

// echo "</div>\n\n<div id=\"menutopright\">\n";

// putClock();

// echo "</div></nav>\n\n";
