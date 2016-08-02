<?php
class ArticleDB {
	public static function addArticle($article) {
		// Inserts the User object $user into the Users table and returns userId
		try {
			if (is_null ( $article ))
				return $article;
			$query = "INSERT INTO articles (editorID, articleTitle, retailers, videos, articles, others)
		                      VALUES(:editorID, :articleTitle, :retailers, :videos, :articles, :others)";
			$db = Database::getDB ();
			$statement = $db->prepare ( $query );
			$statement->bindValue ( ":editorID", $article->getEditorId () );
			$statement->bindValue ( ":articleTitle", $article->getDBArticleTitle () );
			$statement->bindValue ( ":retailers", $article->getSerializedRetailers () );
			$statement->bindValue ( ":videos", $article->getSerializedVideos () );
			$statement->bindValue ( ":articles", $article->getSerializedArticles () );
			$statement->bindValue ( ":others", $article->getSerializedOthers () );
			$statement->execute ();
			$article->setArticleId ( $db->lastInsertId ( "articleID" ) );
		} catch ( Exception $e ) {
			// error
		}
		// now use add the links so we can upvote/downvote them
		try {
			if (is_null ( $article ))
				return $article;
			$query = "INSERT IGNORE INTO votes (name) VALUES(:name)";
			$db = Database::getDB ();
			$statement = $db->prepare ( $query );
			$links = $article->getAllLinks ();
			foreach ( $links as $link ) {
				$statement->bindValue ( ":name", $link );
				$statement->execute ();
			}
			$statement->closeCursor ();
		} catch ( Exception $e ) {
			// error
			echo "<br>ERROR TRYING TO LOAD LINKS INTO DATABASE<br>";
		}
		
		return $article;
	}
	public static function editArticle($article) {
		$user = (array_key_exists ( 'user', $_SESSION )) ? $_SESSION ['user'] : null;
		// Inserts the User object $user into the Users table and returns userId
		try {
			if (is_null ( $article ))
				return $article;
			$query = "UPDATE articles SET editorID = :editorID, retailers = :retailers, videos = :videos, articles = :articles, others = :others WHERE articleTitle = :articleTitle";
			$db = Database::getDB ();
			$statement = $db->prepare ( $query );
			$statement->bindValue ( ":editorID", $user->getUserId () );
			$statement->bindValue ( ":retailers", $article->getSerializedRetailers () );
			$statement->bindValue ( ":videos", $article->getSerializedVideos () );
			$statement->bindValue ( ":articles", $article->getSerializedArticles () );
			$statement->bindValue ( ":others", $article->getSerializedOthers () );
			$statement->bindValue ( ":articleTitle", $article->getDBArticleTitle () );
			$statement->execute ();
		} catch ( Exception $e ) {
			// error
			echo "update error";
		}
		//add the new links
		try {
			if (is_null ( $article ))
				return $article;
			$query = "INSERT IGNORE INTO votes (name) VALUES(:name)";
			$db = Database::getDB ();
			$statement = $db->prepare ( $query );
			$links = $article->getAllLinks ();
			foreach ( $links as $link ) {
				$statement->bindValue ( ":name", $link );
				$statement->execute ();
			}
			$statement->closeCursor ();
		} catch ( Exception $e ) {
			// error
			echo "<br>ERROR TRYING TO LOAD LINKS INTO DATABASE<br>";
		}
	}
	
	// for now, title will be unique
	public static function getArticleByTitle($value) {
		$articleResult;
		try {
			if (! is_null ( $value )) {
				$db = Database::getDB ();
				$statement = $db->prepare ( "SELECT * FROM articles WHERE articleTitle = :value" );
				// $statement->bindValue ( ':type', $type );
				$statement->bindValue ( ':value', $value );
				$statement->execute ();
				$articleResult = $statement->fetch ( PDO::FETCH_ASSOC );
				$statement->closeCursor ();
			}
		} catch ( Exception $e ) { // Not permanent error handling
			echo "<p>Error getting aricles rows by $type </p>";
			print $e;
		}
		if (empty ( $articleResult )) {
			return null;
		} else {
			$article = new Article ( $articleResult );
			return $article;
		}
	}
}
