<?php
class AccountController {

	public static function run() {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$user = new User($_POST);  
			if ($user->getErrorCount() == 0) 
				LoginView::show($user);		
		    else  
				AccountView::show($user);
		} else  // Initial link
			HomeView::show();
	}
}
?>