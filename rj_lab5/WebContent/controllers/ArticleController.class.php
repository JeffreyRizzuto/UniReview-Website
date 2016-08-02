<?php
class ArticleController {
	public static function run() {
		$control = $_SESSION ['control'];
		$action = $_SESSION ['action'];
		
		$user = (array_key_exists ( 'user', $_SESSION )) ? $_SESSION ['user'] : null;
		if ($control == "create") {
			if ($_SERVER ["REQUEST_METHOD"] == "POST") {
				// print_r($_POST);
				// echo file_get_contents ( 'php://input' );
				
				$article = new Article ( $_POST );
				ArticleDB::addArticle ( $article );
				HomeView::show ();
			} else {
				if (isset ( $user )) {
					CreateArticleView::show ();
					exit ();
				} else {
					LoginController::run ();
					exit ();
				}
			}
		} elseif ($control == "edit") {
			if ($_SERVER ["REQUEST_METHOD"] == "POST") {
				// print_r($_POST);
				// echo file_get_contents ( 'php://input' );
				$article = new Article ( $_POST );
				ArticleDB::editArticle ( $article );
				HomeView::show ();
			}
		} elseif ($control == "search") {
			if ($_SERVER ["REQUEST_METHOD"] == "POST") {
				$article = ArticleDB::getArticleByTitle ( $_POST['search'] );
				if (empty ( $article )) { // no article found, show blank
					ArticleView::showBlank ( $article );
				} else {
					if ($action == "edit") { // edit article
						EditArticleView::show ( $article );
					} else { // open article
						ArticleView::show ( $article );
					}
				}
			}
		} else {
			$article = ArticleDB::getArticleByTitle ( $control );
			if (empty ( $article )) { // no article found, show blank
				ArticleView::showBlank ( $article );
			} else {
				if ($action == "edit") { // edit article
					EditArticleView::show ( $article );
				} else { // open article
					ArticleView::show ( $article );
				}
			}
		}
	}
}
?>