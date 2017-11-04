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
<?php

echo '<div class="col-sm-12 pt-3">
<h4 class="text-center">My Submissions</h4>
</div>';

// MY OVERVIEW = Scoreboard + submissions
// Put overview of team submissions (like scoreboard)
// MY OVERVIEW = Scoreboard + submissions
// Put overview of team submissions (like scoreboard)
$refreshtime = 30;

$submitted = @$_GET['submitted'];

$fdata = calcFreezeData($cdata);
$langdata = $DB->q('KEYTABLE SELECT langid AS ARRAYKEY, name, extensions
                    FROM language WHERE allow_submit = 1');

echo "<script type=\"text/javascript\">\n<!--\n";

if ( $fdata['cstarted'] ) {
  if ( $submitted ) {
		echo "<p class=\"submissiondone\">submission done <a href=\"./\">x</a></p>\n\n";
	}
	$probdata = $DB->q('TABLE SELECT probid, shortname, name FROM problem
	                    INNER JOIN contestproblem USING (probid)
	                    WHERE cid = %i AND allow_submit = 1
	                    ORDER BY shortname', $cid);

	putgetMainExtension($langdata);

	echo "function getProbDescription(probid)\n{\n";
	echo "\tswitch(probid) {\n";
	foreach($probdata as $probinfo) {
		echo "\t\tcase '" . specialchars($probinfo['shortname']) .
		    "': return '" . specialchars($probinfo['name']) . "';\n";
	}
	echo "\t\tdefault: return '';\n\t}\n}\n\n";
}

echo "initReload(" . $refreshtime . ");\n";
echo "// -->\n</script>\n";
putTeamRow($cdata, array($teamid));

echo "<div id=\"submitlist\">\n";

echo "<h3 class=\"teamoverview\">Submissions</h3>\n\n";

// call putSubmissions function from common.php for this team.
$restrictions = array( 'teamid' => $teamid );
putSubmissions(array($cdata['cid'] => $cdata), $restrictions, null, $submitted);

echo "</div>\n\n";
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