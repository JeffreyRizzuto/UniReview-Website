<?php
class LoginController {

	public static function run() {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {;  
			if ($_SESSION['user']) 
				HomeView::show();		
		    else  
				LoginView::show();
		} else  // Initial link
			LoginView::show(null);
	}
}
?>