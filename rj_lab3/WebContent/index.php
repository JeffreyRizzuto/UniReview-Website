<?php
// try {
include ("includer.php");
session_start ();
$url = parse_url ( $_SERVER ["REQUEST_URI"], PHP_URL_PATH );
list ( $fill, $base, $control, $action, $arguments ) = explode ( '/', $url, 5 ) + array (
																						"",
																						"",
																						"",
																						"",
																						null 
);
$_SESSION ['base'] = $base;
$_SESSION ['control'] = $control;
$_SESSION ['action'] = $action;
$_SESSION ['arguments'] = $arguments;

switch ($control) {
	case "login" :
		LoginController::run ();
		break;
	case "register" :
		RegisterController::run ();
		break;
	case "account" :
		UserController::run ();
		break;
	case "testReview" :
		TestReviewController::run ();
		break;
	case "editAccount" :
		EditAccountController::run ();
		break;
	case "":
		HomeView::show();
		break;
	default:
		ArticleController::run();
		break;
}
;

// } catch (Exception $ex) {
// }
?>	
