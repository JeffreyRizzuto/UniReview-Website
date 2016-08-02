<?php
class UsersDB {
	public static function addUser($user) {
		// Inserts the User object $user into the Users table and returns userId
		$query = "INSERT INTO Users (firstName, lastName, userName, userPassword, userPasswordSalt, email, gender)
		                      VALUES(:firstName, :lastName, :userName, :userPassword, :userPasswordSalt, :email, :gender)";
		try {
			if (is_null ( $user ) || $user->getErrorCount () > 0)
				return $user;
			$db = Database::getDB ();
			$statement = $db->prepare ( $query );
			$statement->bindValue ( ":firstName", $user->getFirstName () );
			$statement->bindValue ( ":lastName", $user->getLastName () );
			$statement->bindValue ( ":userName", $user->getUserName () );
			$statement->bindValue ( ":userPassword", $user->getPassword () );
			$statement->bindValue ( ":userPasswordSalt", $user->getSalt () );
			$statement->bindValue ( ":email", $user->getEmail () );
			$statement->bindValue ( ":gender", $user->getGender () );
			$statement->execute ();
			$statement->closeCursor ();
			$user->setUserId ( $db->lastInsertId ( "userId" ) );
		} catch ( Exception $e ) {
			$user->setError ( 'userId', 'USER_INVALID' );
		}
		return $user;
	}
	public static function editUser($user) {
		// Edits $user into the Users table
		$query = "UPDATE Users SET firstName = :firstName, lastName = :lastName, userName = :userName, email = :email WHERE userId = :userId";
		try {
			if (is_null ( $user ) || $user->getErrorCount () > 0)
				return $user;
			$db = Database::getDB ();
			$statement = $db->prepare ( $query );
			$statement->bindValue ( ":firstName", $user->getFirstName () );
			$statement->bindValue ( ":lastName", $user->getLastName () );
			$statement->bindValue ( ":userName", $user->getUserName () );
			$statement->bindValue ( ":email", $user->getEmail () );
			$statement->bindValue ( ":userId", $user->getUserId () );
			$statement->execute ();
			$statement->closeCursor ();
		} catch ( Exception $e ) {
			$user->setError ( 'userId', 'USER_INVALID' );
			echo $e;
		}
		return $user;
	}
	
	public static function loginUser($username, $password) {
		// get salt first
		$userSalt = "";
		try {
			$db = Database::getDB ();
			$query = "SELECT userPasswordSalt FROM Users WHERE userName=:username";
			$statement = $db->prepare ( $query );
			$statement->bindParam ( ":username", $username );
			$statement->execute ();
			$userSalt = $statement->fetch ();
			$statement->closeCursor ();
		} catch ( Exception $e ) { // Not permanent error handling
			echo "<p>Error getting user salt</p>";
		}
		//salt password
		$saltedPassword =  hash ( "sha256", $password . $userSalt['userPasswordSalt'] );
	
		// check password
		$foundUser = null;
		try {
			$db = Database::getDB ();
			$query = "SELECT * FROM Users WHERE userName=:username AND userPassword=:password";
			$statement = $db->prepare ( $query );	
			$statement->bindParam ( ":username", $username);
			$statement->bindParam ( ":password", $saltedPassword);
			$statement->execute ();
			$foundUser = $statement->fetch(PDO::FETCH_ASSOC);
			$statement->closeCursor ();
		} catch ( Exception $e ) { // Not permanent error handling
			echo "<p>Error getting user rows by $type: " . $e->getMessage () . "</p>";
		}
		if(empty($foundUser))
		{
			return null;		
		}
		$loggedInUser = new User($foundUser);
		$_SESSION ['user'] = $loggedInUser;
		return $loggedInUser;
	}
	
	public static function getUserRowSetsBy($type = null, $value = null) {
		// Returns the rows of Users whose $type field has value $value
		$allowedTypes = [ "userId","userName" 
		];
		$userRowSets = array ();
		try {
			$db = Database::getDB ();
			$query = "SELECT userId, userName, userPassword FROM Users";
			if (! is_null ( $type )) {
				if (! in_array ( $type, $allowedTypes ))
					throw new PDOException ( "$type not an allowed search criterion for Users" );
				$query = $query . " WHERE ($type = :$type)";
				$statement = $db->prepare ( $query );
				$statement->bindParam ( ":$type", $value );
			} else
				$statement = $db->prepare ( $query );
			$statement->execute ();
			$userRowSets = $statement->fetchAll ( PDO::FETCH_ASSOC );
			$statement->closeCursor ();
		} catch ( Exception $e ) { // Not permanent error handling
			echo "<p>Error getting user rows by $type: " . $e->getMessage () . "</p>";
		}
		return $userRowSets;
	}
	
	public static function getUsersArray($rowSets) {
		// Returns an array of User objects extracted from $rowSets
		$users = array ();
		if (! empty ( $rowSets )) {
			foreach ( $rowSets as $userRow ) {
				$user = new User ( $userRow );
				$user->setUserId ( $userRow ['userId'] );
				array_push ( $users, $user );
			}
		}
		return $users;
	}
	public static function getUsersBy($type = null, $value = null) {
		// Returns User objects whose $type field has value $value
		$userRows = UsersDB::getUserRowSetsBy ( $type, $value );
		return UsersDB::getUsersArray ( $userRows );
	}
	public static function getUserValues($rowSets, $column) {
		// Returns an array of values from $column extracted from $rowSets
		$userValues = array ();
		foreach ( $rowSets as $userRow ) {
			$userValue = $userRow [$column];
			array_push ( $userValues, $userValue );
		}
		return $userValues;
	}
	public static function getUserValuesBy($column, $type = null, $value = null) {
		// Returns the $column of Users whose $type field has value $value
		$userRows = UsersDB::getUserRowSetsBy ( $type, $value );
		return UsersDB::getUserValues ( $userRows, $column );
	}
}
?>