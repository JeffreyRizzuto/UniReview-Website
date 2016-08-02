<?php
include_once ("../models/Database.class.php");

echo "Showing all users";

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th><th>User Name</th><th>Password</th><th>Salt</th><th>Email</th><th>Gender</th><th>Account Created</th></tr>";

$_SESSION ['headertitle'] = "users";
$query = "SELECT * FROM users";
try {
	$db = Database::getDB ();
	
	$statement = $db->prepare ( $query );
	$statement->execute ();
	$result = $statement->setFetchMode ( PDO::FETCH_ASSOC );
	foreach ( new TableRows ( new RecursiveArrayIterator ( $statement->fetchAll () ) ) as $k => $v ) {
		echo $v;
	}
	
	$statement->closeCursor ();
} catch ( Exception $e ) {
	echo "there is an error";
	echo $e;
}

class TableRows extends RecursiveIteratorIterator {
	function __construct($it) {
		parent::__construct($it, self::LEAVES_ONLY);
	}

	function current() {
		return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
	}

	function beginChildren() {
		echo "<tr>";
	}

	function endChildren() {
		echo "</tr>" . "\n";
	}
}

$conn = null;
echo "</table>";
?>