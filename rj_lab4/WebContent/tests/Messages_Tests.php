<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>Messages tests</h1>

<?php
include_once("../models/Messages.class.php");
?>

<h2>Set Errors Test</h2>
<?php 

Messages::setErrors("../resources/errors_English.txt");


echo "FIRST_NAME_TOO_SHORT: " .Messages::getError("FIRST_NAME_TOO_SHORT")."<br>";
echo "FIRST_NAME_EMPTY: " .Messages::getError("FIRST_NAME_EMPTY")."<br>";
echo "FIRST_NAME_HAS_INVALID_CHARS: " .Messages::getError("FIRST_NAME_HAS_INVALID_CHARS")."<br>";
echo "LAST_NAME_TOO_SHORT: " .Messages::getError("LAST_NAME_TOO_SHORT")."<br>";
echo "LAST_NAME_INVALID: " .Messages::getError("LAST_NAME_HAS_INVALID_CHARS")."<br>";
echo "LAST_NAME_EMPTY: " .Messages::getError("LAST_NAME_EMPTY")."<br>";
echo "USER_NAME_EMPTY: " .Messages::getError("USER_NAME_EMPTY")."<br>";
echo "USER_NAME_HAS_INVALID_CHARS: " .Messages::getError("USER_NAME_HAS_INVALID_CHARS")."<br>";
echo "PHONE_NUMBER_INVALID: " .Messages::getError("PHONE_NUMBER_INVALID")."<br>";
echo "EMAIL_INVALID: " .Messages::getError("EMAIL_INVALID")."<br>";
echo "GENDER_INVALID: " .Messages::getError("GENDER_INVALID")."<br>";
?>

<h2>Reset Errors Test</h2>
<?php 
Messages::reset();

echo "FIRST_NAME_TOO_SHORT: " .Messages::getError("FIRST_NAME_TOO_SHORT")."<br>";
echo "FIRST_NAME_EMPTY: " .Messages::getError("FIRST_NAME_EMPTY")."<br>";
echo "FIRST_NAME_HAS_INVALID_CHARS: " .Messages::getError("FIRST_NAME_HAS_INVALID_CHARS")."<br>";
echo "LAST_NAME_TOO_SHORT: " .Messages::getError("LAST_NAME_TOO_SHORT")."<br>";
echo "LAST_NAME_INVALID: " .Messages::getError("LAST_NAME_HAS_INVALID_CHARS")."<br>";
echo "LAST_NAME_EMPTY: " .Messages::getError("LAST_NAME_EMPTY")."<br>";
echo "USER_NAME_EMPTY: " .Messages::getError("USER_NAME_EMPTY")."<br>";
echo "USER_NAME_HAS_INVALID_CHARS: " .Messages::getError("USER_NAME_HAS_INVALID_CHARS")."<br>";
echo "PHONE_NUMBER_INVALID: " .Messages::getError("PHONE_NUMBER_INVALID")."<br>";
echo "EMAIL_INVALID: " .Messages::getError("EMAIL_INVALID")."<br>";
echo "GENDER_INVALID: " .Messages::getError("GENDER_INVALID")."<br>";

?>

<h2>Change Locale Test</h2>
<?php 
Messages::$locale = 'Spanish';
Messages::reset();

echo "FIRST_NAME_TOO_SHORT: " .Messages::getError("FIRST_NAME_TOO_SHORT")."<br>";
echo "FIRST_NAME_EMPTY: " .Messages::getError("FIRST_NAME_EMPTY")."<br>";
echo "FIRST_NAME_HAS_INVALID_CHARS: " .Messages::getError("FIRST_NAME_HAS_INVALID_CHARS")."<br>";
echo "LAST_NAME_TOO_SHORT: " .Messages::getError("LAST_NAME_TOO_SHORT")."<br>";
echo "LAST_NAME_INVALID: " .Messages::getError("LAST_NAME_HAS_INVALID_CHARS")."<br>";
echo "LAST_NAME_EMPTY: " .Messages::getError("LAST_NAME_EMPTY")."<br>";
echo "USER_NAME_EMPTY: " .Messages::getError("USER_NAME_EMPTY")."<br>";
echo "USER_NAME_HAS_INVALID_CHARS: " .Messages::getError("USER_NAME_HAS_INVALID_CHARS")."<br>";
echo "PHONE_NUMBER_INVALID: " .Messages::getError("PHONE_NUMBER_INVALID")."<br>";
echo "EMAIL_INVALID: " .Messages::getError("EMAIL_INVALID")."<br>";
echo "GENDER_INVALID: " .Messages::getError("GENDER_INVALID")."<br>";

?>
</body>
</html>

