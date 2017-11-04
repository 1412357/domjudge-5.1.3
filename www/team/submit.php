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

echo '<div class="col-sm-12 p-3">
<h4 class="text-center">Submit solution</h4>
</div>';

// MY OVERVIEW = Scoreboard + submissions
// Put overview of team submissions (like scoreboard)
$refreshtime = 30;

$submitted = @$_GET['submitted'];

$fdata = calcFreezeData($cdata);
$langdata = $DB->q('KEYTABLE SELECT langid AS ARRAYKEY, name, extensions
                    FROM language WHERE allow_submit = 1');

echo "<script type=\"text/javascript\">\n<!--\n";

if ( $fdata['cstarted'] ) {
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

// echo "initReload(" . $refreshtime . ");\n";
echo "// -->\n</script>\n";
// putTeamRow($cdata, array($teamid));

echo "<div id=\"submitlist\">\n";

$probs = array();
$langs = array();
if ( $fdata['cstarted'] ) {
	if ( $submitted ) {
		echo "<p class=\"submissiondone\">submission done <a href=\"./\">x</a></p>\n\n";
	} else {
		$maxfiles = dbconfig_get('sourcefiles_limit',100);

		echo addForm('upload.php','post',null,'multipart/form-data', null,
		             ' onreset="resetUploadForm('.$refreshtime .', '.$maxfiles.');"');

        echo '<textarea id="mainEditor" name="mainEditorCode" hidden></textarea>';

		// $probs = array();
		foreach($probdata as $probinfo) {
			$probs[$probinfo['probid']]=$probinfo['shortname'];
		}
		$probs[''] = 'problem';
		// echo addSelect('probid', $probs, '', true);
		// $langs = array();
		foreach($langdata as $langid => $langdata) {
			$langs[$langid] = $langdata['name'];
		}
		$langs[''] = 'language';
		// echo addSelect('langid', $langs, '', true);

        $chooseAddFile = chooseAddFile($maxfiles);
        echo putEditor($probs, $langs, $chooseAddFile);
        echo addSubmit('submit', 'submit',
        "return checkUploadForm();", true,
        'style="margin: auto; display: block; margin-top: 10px" class="btn btn-primary btn-sm"');
        echo "</form>\n\n";
	}
}
// call putSubmissions function from common.php for this team.
// $restrictions = array( 'teamid' => $teamid );
// putSubmissions(array($cdata['cid'] => $cdata), $restrictions, null, $submitted);

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

function putEditor($probs, $langs, $chooseAddFile) {
    return '
    <script src="../js/ace/ace.js" type="text/javascript" charset="utf-8"></script>
    <!-- <div class="col-sm-12 p-3">
        <h1 class="text-center">Submit solution</h1>
    </div> -->
    
    <div class="col-sm-12 ace-editor">
        <div class="col-sm-12 offset-sm-0">
    
        <div class="col-sm-12">
        <div class="row">
            <table class="col-sm-12 table-form">
                <tbody>
                    <tr class="m-5">
                        <td class="field-name">Problem: </td>
                        <td>' . addSelect("probid", $probs, "", true, false, 'class="form-control form-control-sm"') . '</td>
                    </tr>
                    <tr class="subscription-row">
                            <td>&nbsp;</td>
                            <td>
                                <div class="shiftUp error__submittedProblemIndex" style="width: 300px;">
                                    <span class="error for__submittedProblemIndex" style="display: none;">&nbsp;</span>
                                    <span class="notice for__submittedProblemIndex">&nbsp;</span>
                                </div>
                            </td>
                        </tr>
                    <tr>
                        <td class="field-name">Language: </td>
                        <td>
                            '. addSelect("langid", $langs, "", true, false, 'class="form-control form-control-sm"') .'
                        </td>
                    </tr>
    
                    <tr>
                        <td class="field-name">Source code: </td>
                        <td class="editor-container">
                            <div id="editor"></div>
                        </td>
                    </tr>
    
                    <tr>
                        <td class="field-name">Or choose file: </td>
                        <td>'.$chooseAddFile.'
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
        </div>
    </div>
        
    <script>
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/xcode");
        editor.getSession().setMode("ace/mode/c_cpp");
    </script>
    ';
}

function chooseAddFile($maxfiles) {
    $str = "";
    $str .= "<input type=\"file\" name=\"code[]\" id=\"maincode\" style=\"font-size: small\" class=\"btn btn-secondary\"";
    if ( $maxfiles > 1 ) {
        $str .= " multiple";
    }
    $str .= " />\n";
    if ( $maxfiles > 1 ) {
       $str .= "<span id=\"auxfiles\"></span>\n" .
           "<input type=\"button\" name=\"addfile\" id=\"addfile\" " .
           "value=\"Add another file\" onclick=\"addFileUpload();\" " .
           "disabled=\"disabled\" />\n";
   }
   $str .= '<input type="reset" value="cancel" class="btn btn-secondary btn-sm">';
   $str .= "<script type=\"text/javascript\">initFileUploads($maxfiles);</script>\n\n";
   return $str;
}
