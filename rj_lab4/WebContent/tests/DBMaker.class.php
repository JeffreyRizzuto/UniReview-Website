<?php
class DBMaker {
	public static function create($dbName) {
		// Creates a database named $dbName for testing and returns connection
		$db = null;
		try {
			$db = Database::getDB ();
			$st = $db->prepare ( "DROP DATABASE if EXISTS $dbName" );
			$st->execute ();
			$st = $db->prepare ( "CREATE DATABASE $dbName" );
			$st->execute ();
			$st = $db->prepare ( "USE $dbName" );
			$st->execute ();
			
			// create users table
			$st = $db->prepare ( "DROP TABLE if EXISTS users" );
			$st->execute ();
			
			$st = $db->prepare ( "CREATE TABLE users (
								userId BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
	firstName TINYTEXT NOT NULL,
	lastName TINYTEXT NOT NULL,
	userName VARCHAR(20) UNIQUE NOT NULL, 
	userPassword VARCHAR(128) NOT NULL,
	userPasswordSalt VARCHAR(128) NOT NULL,
	email VARCHAR(254) UNIQUE NOT NULL, 
	gender ENUM('male', 'female'), 
	creationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
			)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci" );
			$st->execute ();
			
			echo "Created users success<br>";
			
			// create articles table
			$st = $db->prepare ( "DROP TABLE if EXISTS articles" );
			$st->execute ();
			
			$st = $db->prepare ( "CREATE TABLE articles (
		  			            articleID BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, 
	editorID BIGINT UNSIGNED,
	articleTitle VARCHAR(255) NOT NULL,
	submissionDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
	pageText BLOB
			                 )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;" );
			$st->execute ();
			
			echo "Created articles success<br>";
			
			// create revisions table
			$st = $db->prepare ( "DROP TABLE if EXISTS revisions" );
			$st->execute ();
			
			$st = $db->prepare ( "CREATE TABLE revisions (
		  			          revisionID BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, 
	editorID BIGINT UNSIGNED,
	articleTitle VARCHAR(255) NOT NULL,
	submissionDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
	pageText BLOB
			                 )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;" );
			$st->execute ();
			
			echo "Created revisions success<br>";
			
			$sql = "INSERT INTO users (firstName, lastName, userName, userPassword, userPasswordSalt, email, gender) VALUES
		                              (:firstName, :lastName, :userName, :userPassword, :userPasswordSalt, :email, :gender)";
			$st = $db->prepare ( $sql );
			$st->execute ( array (':firstName' => 'Barry',
									':lastName' => 'Allen',
									':userName' => 'theflash',
									':userPassword' => '864728c4ff48de92531492d24ea3d8ffd87461d27857e73718cdaf215886f2cf',
									':userPasswordSalt' => '7eb517',
									':email' => 'flash@dc.com',
									':gender' => 'male' 
			) );
			$st->execute ( array (':firstName' => 'Clark',
									':lastName' => 'Kent',
									':userName' => 'superman',
									':userPassword' => 'd82943e58e1b1b892ee7f3d398098d9dffc9cbaf2f968a3f70b2a6c401227ca3',
									':userPasswordSalt' => 'f6c370',
									':email' => 'superman@dc.com',
									':gender' => 'male' 
			) );
			$st->execute ( array (':firstName' => 'bruce',
									':lastName' => 'wayne',
									':userName' => 'thedarkknight',
									':userPassword' => 'd7955b0e04f8c191dee34468390c1a73db3740aab42bed4e67b5d7c1006a891d',
									':userPasswordSalt' => 'd7955b0e04f8c191dee34468390c1a73db3740aab42bed4e67b5d7c1006a891d',
									':email' => 'batman@dc.com',
									':gender' => 'male' 
			) );
			$st->execute ( array (':firstName' => 'Oliver',
									':lastName' => 'Queen',
									':userName' => 'greenarrow',
									':userPassword' => 'efb7b0446999d58971e4a97eb42bfa1ee13d2b6bf0705f906231e52dce0eecb8',
									'userPasswordSalt' => '66a528',
									':email' => 'arrow@dc.com',
									':gender' => 'male' 
			) );
			
			echo "Filled users success<br>";
			
			$sql = "INSERT INTO articles (articleID, editorID, articleTitle, pageText) VALUES
		                          (:articleID, :editorID, :articleTitle, :pageText)";
			$st = $db->prepare ( $sql );
			$st->execute ( array (':articleID' => '0001',
									':editorID' => '1111',
									':articleTitle' => 'Apple_iPad_with_Retina_Display_',
									':pageText' => 'test page for apple ipad' 
			) );
			$st->execute ( array (':articleID' => '0002',
									':editorID' => '2222',
									':articleTitle' => 'Microsoft_Surface_3_Tablet',
									':pageText' => 'test page for microsoft surface' 
			) );
			$st->execute ( array (':articleID' => '0003',
									':editorID' => '3333',
									':articleTitle' => 'Logitech_HD_Pro_Webcam_C920',
									':pageText' => 'test page for logitech webcam' 
			) );
			$st->execute ( array (':articleID' => '0004',
									':editorID' => '4444',
									':articleTitle' => 'Sennheiser_HD_598_Over-Ear_Headphones',
									':pageText' => 'test page for headphones' 
			) );
			$st->execute ( array (':articleID' => '0005',
									':editorID' => '5555',
									':articleTitle' => 'television',
									':pageText' => 'this is a generic page to for url' 
			) );
			
			echo "Filled articles success<br>";
		} catch ( PDOException $e ) {
			echo $e; // not final error handling
		}
		
		return $db;
	}
	public static function delete($dbName) {
		// Delete a database named $dbName
		try {
			$dbspec = 'mysql:host=localhost;dbname=' . $dbName . ";charset=utf8";
			$username = 'root';
			$password = '';
			$options = array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
			);
			$db = new PDO ( $dbspec, $username, $password, $options );
			$st = $db->prepare ( "DROP DATABASE if EXISTS $dbName" );
			$st->execute ();
		} catch ( PDOException $e ) {
			echo $e->getMessage (); // not final error handling
		}
	}
}
?>