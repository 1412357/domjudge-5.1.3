<?php
/**
 * Scoreboard
 *
 * Part of the DOMjudge Programming Contest Jury System and licenced
 * under the GNU GPL. See README and COPYING for details.
 */
require('init.php');

$title = 'Scoreboard';
require(LIBWWWDIR . '/header.php');
?>
<div class="main-container box-shadow">
<div class="row">
<div class="col-sm-8 left-side">
<ul class="nav lecture-menu">
  <li class="nav-item">
    <a class="nav-link active" href="problems.php">PROBLEMS</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="submit.php">SUBMIT CODE</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="my.php">MY SUBMISSIONS</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="scoreboard_v1.php">SCOREBOARD</a>
  </li>
</ul>

<div class="problem-content">
    <iframe style="width: 95%; height: 700px" src="problem.php?id=<?php echo $_GET[id] ?>">
        <p>Your browser does not support iframes.</p>
    </iframe>
</div>
<?php

?>
</div>
<div class="col-sm-4 right-side">
  <!-- <div class="clock-block">

  </div> -->
</div>
</div>
</div>
<?php
require(LIBWWWDIR . '/footer.php');
