<?php
class TestReviewController {

	public static function run() {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$user = new User($_POST);  
			if ($user->getErrorCount() == 0) 
				HomeView::show();		
		    else  
				TestReviewView::show($user);
		} else  // Initial link
			TestReviewView::show(null);
	}
}
?>