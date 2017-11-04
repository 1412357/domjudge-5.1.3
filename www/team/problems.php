<?php
/**
 * View/download problem texts
 *
 * Part of the DOMjudge Programming Contest Jury System and licenced
 * under the GNU GPL. See README and COPYING for details.
 */

require('init.php');

$title = 'Problem statements';
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

<!-- <div class="problem-list">
<table class="table-problem table-striped table-bordered">
  <caption class="problem-header">Problem</caption>
  <thead>
    <tr>
      <th class="problem-index">#</th>
      <th class="problem-name">Problem Name</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
    </tr>
  </tbody>
</table>
</div> -->

<?php

// echo "<h1>Problem statements</h1>\n\n";

// putProblemTextList();
putProblemTextList_v1();
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
