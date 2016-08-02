<?php
class RegisterController {

	public static function run() {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$user = new User($_POST);  
			if ($user->getErrorCount() == 0) 
				HomeView::show();		
		    else  
				RegisterView::show($user);
		} else  // Initial link
			RegisterView::show(null);
	}
}
?>