<?php
class UserController {
	public static function run() {
		$action = $_SESSION ['action'];
		$arguments = $_SESSION ['arguments'];
		$user = (array_key_exists ( 'user', $_SESSION )) ? $_SESSION ['user'] : null;
		switch ($action) {
			case "create" :
				self::createAccount ();
				break;
			case "modify" :
				EditAccountView::show ( $user );
				break;
			case "edit" :
				self::modifyAccount ();
				break;
			default :
				if ($user) {
					AccountView::show ();
				} else {
					RegisterView::show ();
				}
		}
	}
	public static function createAccount() {
		if ($_SERVER ["REQUEST_METHOD"] == "POST") {
			$user = new User ( $_POST );
			if ($user->getErrorCount () == 0) { // local account success, add to db
				$user = UsersDB::addUser ( $user );
				$_SESSION ['user'] = $user;
				AccountView::show ();
			} else // something wrong
				RegisterView::show ();
		}
	}
	public static function modifyAccount() {
		$user = $_SESSION ['user'];
		if ($_SERVER ["REQUEST_METHOD"] == "POST") {			
			// do the change
			$user->changeInfo ( $_POST );
			
			if ($user->getErrorCount () == 0) { // local account success, change in db
				$user = UsersDB::editUser ( $user );
				$_SESSION ['user'] = $user;
				AccountView::show ();
			} else // something wrong
				AccountView::show ();
		}
	}
}
?>