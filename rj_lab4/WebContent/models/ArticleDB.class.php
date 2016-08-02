<?php
class ArticleDB {
	public static function addArticle($article) {
		// Inserts the User object $user into the Users table and returns userId
		$query = "INSERT INTO articles (editorID, articleTitle, pageText)
		                      VALUES(:editorID, :articleTitle, :pageText)";
		try {
			if (is_null ( $article ))
				return $article;
			$db = Database::getDB ();
			$statement = $db->prepare ( $query );
			$statement->bindValue ( ":editorID", $article->getEditorId () );
			$statement->bindValue ( ":articleTitle", $article->getArticleTitle () );
			$statement->bindValue ( ":pageText", $article->getPageText () );
			$statement->execute ();
			$statement->closeCursor ();
			$article->setArticleId ( $db->lastInsertId ( "articleID" ) );
		} catch ( Exception $e ) {
			// error
		}
		return $article;
	}
	
	
	// for now, title will be unique
	public static function getArticle($type, $value) {
		$articleResult;		
		$allowedTypes = [ "articleID","articleTitle"];
		try {
			if (! is_null ( $type )) {
				if (! in_array ( $type, $allowedTypes ))
					throw new PDOException ( "$type not an allowed search criterion for articles" );
				$db = Database::getDB ();
				$query = "SELECT * FROM articles ";
				if (!strcmp ( $type, "articleID" )) {
					$query = $query . "WHERE :type = :value";
				} elseif (!strcmp ( $type, "articleTitle" )) {
					$query = $query . "WHERE :type = :value";
				} else {
					echo "Invalid Search";
					return null;
				}
				
				$statement = $db->prepare ( $query );
				$statement->bindValue ( ":type", $type );
				$statement->bindValue ( ":value", $value );
				$statement->execute ();			
				$articleResult = $statement->fetchAll ( PDO::FETCH_ASSOC );
				$statement->closeCursor ();
			}
		} catch ( Exception $e ) { // Not permanent error handling
			echo "<p>Error getting aricles rows by $type </p>";
			print $e;
		}
		if(empty($articleResult)){
			echo "no result found";
			return null;
		} else {
			echo "result found";
			$article = new Article ( $articleResult );
			return $article;
		}
		
	}
}
