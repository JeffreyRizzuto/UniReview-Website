<!DOCTYPE html>
<html>
<head>
<title>Basic tests for UserData</title>
</head>
<body>
	<h1>UserData tests</h1>

<?php
include_once ("../models/User.class.php");
?>
<h2>Create a valid user object</h2>
<?php

$validTest = array (
		"firstName" => "Barry",
		"lastName" => "Allen",
		"userName" => "Flash",
		"password" => "hunter2",
		"email" => "barryallen@gmail.com",
		"gender" => "male" 
);
$s1 = new User ( $validTest );
echo "$s1";
?>

<h2>It should extract the parameters that went in</h2>
<?php
$props = $s1->getParameters ();
print_r ( $props );
?>
