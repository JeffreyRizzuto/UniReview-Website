<?php
class LoginController {
	public static function run() {
		if ($_SERVER ["REQUEST_METHOD"] == "POST") {
			LoginController::login();
		} else // Initial link
		if(isset ( $_SESSION ['user'])){
			LoginController::logout();
			HomeView::show ( null );
		} else {
			LoginView::show ( null );
		}
			
	}
	public static function login() {
		if ($_SERVER ["REQUEST_METHOD"] == "POST") {
			$username = LoginController::extractForm ( $_POST, "userName" );
			$password = LoginController::extractForm ( $_POST, "password" );
			$user = UsersDB::loginUser ( $username, $password );
			HomeView::show ();
		} else // Initial link
			LoginView::show ( $_POST );
	}
	public static function logout() {
		$_SESSION ['user'] = null;
		HomeView::show ();
		exit();
	}
	public function extractForm($input, $valueName) {
		$value = "";
		if (isset ( $input [$valueName] )) {
			$value = trim ( $input [$valueName] );
			$value = stripslashes ( $value );
			$value = htmlspecialchars ( $value );
			return $value;
		}
	}
}
?>