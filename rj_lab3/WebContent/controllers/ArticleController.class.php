<?php
class ArticleController {
	public static function run() {
		$action = $_SESSION ['action'];
		$arguments = $_SESSION ['arguments'];
		$user = (array_key_exists ( 'user', $_SESSION )) ? $_SESSION ['user'] : null;
		$article = ArticleDB::getArticle('articleTitle',$action);
		if(is_null($article)){
			ArticleView::showBlank($article);
		} else {
			ArticleView::show($article);
		}
	}
}
?>