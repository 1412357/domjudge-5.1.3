<?php
/**
 * Scoreboard
 *
 * Part of the DOMjudge Programming Contest Jury System and licenced
 * under the GNU GPL. See README and COPYING for details.
 */

$pagename = basename($_SERVER['PHP_SELF']);

require('init.php');
$refresh = '30;url=scoreboard_v1.php';
$title = 'Scoreboard';

// This reads and sets a cookie, so must be called before headers are sent.
$filter = initScorefilter();

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
<div class="ml-3 mt-2" id="scoreboard_v1">
  <?php
  // call the general putScoreBoard function from scoreboad.php
  putScoreBoard($cdata, $teamid, FALSE, $filter);
  ?>
</div>
</div>
<div class="col-sm-4 right-side">
  <!-- <div class="clock-block">

  </div> -->
</div>
</div>
</div>
<?php
require(LIBWWWDIR . '/footer.php');
