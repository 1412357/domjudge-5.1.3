<?php
/**
 * View/download problem texts
 *
 * Part of the DOMjudge Programming Contest Jury System and licenced
 * under the GNU GPL. See README and COPYING for details.
 */

require('init.php');
if (isset($_GET['cid'])) {
	header('Location: change_contest.php?cid='.$_GET['cid'].'&HTTP_REFERER=problems.php');
} else {
	header('Location: problems.php');
}
