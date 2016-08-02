<!DOCTYPE html>
<html>
<head>
<title>Basic tests for UserData</title>
</head>
<body>
	<h1>UserData tests</h1>

<?php
include_once ("../models/UserData.class.php");
?>
<h2>Create a valid user object</h2>
<?php

$validTest = array (
		"firstName" => "Barry",
		"lastName" => "Allen",
		"userName" => "Flash",
		"password" => "hunter2",
		"telephone" => "(555)123-4567",
		"website" => "http://www.cwtv.com/shows/the-flash/",
		"state" => "NY",
		"color" => "%23c01f23",
		"email" => "barryallen@gmail.com",
		"gender" => "male" 
);
$s1 = new UserData ( $validTest );
echo "$s1";
?>

<h2>It should extract the parameters that went in</h2>
<?php
$props = $s1->getParameters ();
print_r ( $props );
?>
