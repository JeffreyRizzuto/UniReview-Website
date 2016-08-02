<?php
class RegisterController {
	public static function run() {
		if ($_SERVER ["REQUEST_METHOD"] == "POST") {
			$user = new User ( $_POST );
			if ($user->getErrorCount () == 0)
				AccountView::show ( $user );
			else
				AccountView::show ( $user );
		} else // Initial link
			RegisterView::show ( null );
	}
}
?>