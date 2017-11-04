<?php
	logged_in();
	global $username;
?>
	<div class="blue" id="header">
		<div class="logo float-left">
			<img src="../images/BigOlogo.png" alt="BigO" style="height: 100%;">
		</div>
		<div class="login-form float-right">
		<?php if ( !logged_in() ): ?>
			<a href="login.php" accesskey="l">login</a> 
			<!-- |
			<a href="">Register</a> -->
		<?php else: ?>
			<a href=""><?php echo $username ?></a> |
			<a href="../auth/logout.php">Logout</a>
		<?php endif ?>
		</div>
	</div>
	
	<div class="roundbox menu-box">
		<div class="menu-list-container">

			<ul class="nav menu-list main-menu-list">
				<li class="nav-item current">
					<a class="active" href="index.php">Home</a>
				</li>
				<!-- <li class="nav-item">
					<a class="active" href="courses.php">Courses</a>
				</li> -->
			<?php if ( checkrole('team') ):?>
				<li class="nav-item">
					<a class="active" href="../team/">→ Team</a>
				</li>
			<?php endif ?>
			<?php if ( checkrole('jury') || checkrole('balloon')):?>
				<li class="nav-item">
					<a class="active" href="../jury/">→ Jury</a>
				</li>
			<?php endif ?>
			</ul>

		</div>
	</div>
<?php
	
?>

<!-- OLD VERSION -->
<!-- <nav><div id="menutop"> -->
<!-- <a href="index.php" accesskey="h">home</a> -->
<?php
/*
if ( have_problemtexts() ) {
	echo "<a href=\"problems.php\" accesskey=\"p\">problems</a>\n";
}
logged_in(); // fill userdata
if ( checkrole('team') ) {
	echo "<a target=\"_top\" href=\"../team/\" accesskey=\"t\">→team</a>\n";
}
if ( checkrole('jury') || checkrole('balloon') ) {
	echo "<a target=\"_top\" href=\"../jury/\" accesskey=\"j\">→jury</a>\n";
}
if ( !logged_in() ) {
	echo "<a href=\"login.php\" accesskey=\"l\">login</a>\n";
}
?>
</div></nav>
