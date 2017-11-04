<?php
/**
 * Change current contest
 *
 * Part of the DOMjudge Programming Contest Jury System and licenced
 * under the GNU GPL. See README and COPYING for details.
 */

require('init.php');

// Referer can not be submission_details or clarification, then we redirect
// back to index

if ( empty($_SERVER['HTTP_REFERER']) && empty($_GET['HTTP_REFERER']) ) {
	die("Missing referrer header.");
} else if (!empty($_GET['HTTP_REFERER'])) {
	$referer = $_GET['HTTP_REFERER'];
} else {
	$referer = $_SERVER['HTTP_REFERER'];
}

if ( preg_match('/(.*team\/)(?:submission_details|clarification)\.php/', $referer, $matches) ) {
	$referer = $matches[1];
}

dj_setcookie('domjudge_cid', $_REQUEST['cid']);
header('Location: ' . $referer);
