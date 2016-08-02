<?php
class CreateArticleView {
	public static function show() {
		$_SESSION ['headertitle'] = "Create Page";
		MasterView::showHeader ();
		MasterView::showNavbar ();
		CreateArticleView::showDetails ();
		$_SESSION ['footertitle'] = "";
		MasterView::showFooter ();
		
	}
	
	public static function showDetails(){
		
		$user = (array_key_exists('user', $_SESSION))?$_SESSION['user']:null;
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
		echo '<h1>UniReview Create Page</h1>';
		echo '<form action ="/'.$base.'/create" method="Post">';
		echo '<p>Article Title: <input type="text" name ="title">';
		echo '<p><textarea name="content"></textarea></p>';
		echo '<p><input type = "submit" name = "submit" value="Submit"></p></form>';
	}
	

}