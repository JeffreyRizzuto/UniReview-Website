<?php
class ArticleController {
	public static function run() {
		$control = $_SESSION ['control'];
		$arguments = $_SESSION ['arguments'];
		if(isset($_SESSION['user'])){
			if($control = "create"){
				if ($_SERVER ["REQUEST_METHOD"] == "POST") {
					$article = new Article( $_POST);
					ArticleDB::addArticle($article);
					ArticleController::run();
				} else {
					CreateArticleView::show();
					return;
				}
			}
			$user = (array_key_exists ( 'user', $_SESSION )) ? $_SESSION ['user'] : null;
			$article = ArticleDB::getArticle('articleTitle',$control);
			if(empty($article)){
				echo "SHOWING BLANK";
				ArticleView::showBlank($article);
			} else {
				echo "SHOWING ARTICLE";
				ArticleView::show($article);
			}
		} else {
			HomeView::show();
		}
		
	}
}
?>