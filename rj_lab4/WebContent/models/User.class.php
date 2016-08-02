<?php
include ("Messages.class.php");
class User {
	private $errorCount;
	private $errors;
	private $formInput;
	private $firstName;
	private $lastName;
	private $userName;
	private $userId;
	private $password;
	private $passwordSalt;
	private $email;
	private $gender;
	public function __construct($formInput = null) {
		$this->formInput = $formInput;
		Messages::reset ();
		$this->initialize ();
	}
	public function getError($errorName) {
		if (isset ( $this->errors [$errorName] ))
			return $this->errors [$errorName];
		else
			return "";
	}
	public function setError($errorName, $errorValue) {
		// Sets a particular error value and increments error count
		if (! isset ( $this->errors, $errorName )) {
			$this->errors [$errorName] = Messages::getError ( $errorValue );
			$this->errorCount ++;
		}
	}
	public function unsetError($errorName, $errorValue) {
		// Sets a particular error value and increments error count
		if (isset ( $this->errors, $errorName )) {
			$this->errors [$errorName] = null;
			$this->errorCount --;
		}
	}
	public function getErrorCount() {
		return $this->errorCount;
	}
	public function getErrors() {
		return $this->errors;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getUserId() {
		return $this->userId;
	}
	public function getFirstName() {
		return $this->firstName;
	}
	public function getGender() {
		return $this->gender;
	}
	public function getLastName() {
		return $this->lastName;
	}
	public function getUserName() {
		return $this->userName;
	}
	public function getPassword() {
		return $this->password;
	}
	public function getSalt() {
		return $this->passwordSalt;
	}
	public function getParameters() {
		// Return data fields as an associative array
		$paramArray = array ("firstName" => $this->firstName,
							"lastName" => $this->lastName,
							"userName" => $this->userName,
							"password" => $this->password,
							"email" => $this->email,"gender" => $this->gender 
		);
		return $paramArray;
	}
	public function __toString() {
		$str = "First name:[" . $this->firstName . "] lastName:[" .
			 $this->lastName . "] userId:[" . $this->userId . "] userName:[" .
			 $this->userName . "] password:[" . $this->password .
			 "] passwordSalt:[" . $this->passwordSalt . "] email:[" .
			 $this->email . "] gender:[" . $this->gender . "]  errors:[" .
			 $this->errorCount . "]";
		return $str;
	}
	private function extractForm($valueName) {
		$value = "";
		if (isset ( $this->formInput [$valueName] )) {
			$value = trim ( $this->formInput [$valueName] );
			$value = stripslashes ( $value );
			$value = htmlspecialchars ( $value );
			return $value;
		}
	}
	private function initialize() {
		$this->errorCount = 0;
		$errors = array ();
		if (is_null ( $this->formInput ))
			$this->initializeEmpty ();
		else {
			$this->validateFirstName ();
			$this->validateLastName ();
			$this->validateUserName ();
			$this->validatePassword ();
			$this->validateEmail ();
			$this->validateGender ();
		}
	}
	private function initializeEmpty() {
		$this->errorCount = 0;
		$errors = array ();
		$this->firstName = "";
		$this->lastName = "";
		$this->userName = "";
		$this->password = "";
		$this->email = "";
		$this->gender = "";
	}
	
	// need to make it so it checks datebase to make sure it is unique
	private function validateEmail() {
		// Email should not have quoted characters
		$this->email = $this->extractForm ( 'email' );
		// More validation goes here
		if (filter_var ( $this->email, FILTER_VALIDATE_EMAIL )) {
			$this->unsetError( 'email', 'EMAIL_INVALID' );
		} else { // fail
			$this->setError ( 'email', 'EMAIL_INVALID' );
		}
	}
	private function validateGender() {
		// Gender should not have quoted characters
		$this->gender = $this->extractForm ( 'gender' );
		// More validation goes here
		if (strcmp ( $this->gender, 'male' ) or
			 strcmp ( $this->gender, 'female' )) {
			// pass
		} else { // fail
			$this->setError ( 'gender', 'GENDER_INVALID' );
		}
	}
	private function validateFirstName() {
		// First name should not have quoted characters
		$this->firstName = $this->extractForm ( 'firstName' );
		if (strlen ( $this->firstName ) <= 1)
			$this->setError ( 'lastName', 'LAST_NAME_TOO_SHORT' );
		else
			$this->unsetError ( 'lastName', 'LAST_NAME_TOO_SHORT' );
		// More validation goes here
	}
	private function validateLastName() {
		// Last name should not have quoted characters
		$this->lastName = $this->extractForm ( 'lastName' );
		// Last name should be at least 2 characters
		if (strlen ( $this->lastName ) <= 1)
			$this->setError ( 'lastName', 'LAST_NAME_TOO_SHORT' );
		else
			$this->unsetError ( 'lastName', 'LAST_NAME_TOO_SHORT' );
	}
	
	// need to make it so it checks datebase to make sure it is unique
	private function validateUserName() {
		// UserName should not have quoted characters
		$this->userName = $this->extractForm ( 'userName' );
		// UserName should be at least 2 characters
		if (strlen ( $this->userName ) <= 1)
			$this->setError ( 'userName', 'USER_NAME_TOO_SHORT' );
		else
			$this->unsetError( 'userName', 'USER_NAME_TOO_SHORT' );
	}
	private function validatePassword() { // going to hash passwords, all is allowed
	                                      
		// make sure password is at least a min length
		if(isset($this->extractForm ['userPasswordSalt'])) {
			$this->password = $this->extractForm ('userPassword');
			break;
		}
		$rawPassword = $this->extractForm('userPassword');
		if (strlen ( $rawPassword ) >= 6) { // pass
		                                    // salt and hash password
			$this->passwordSalt = $this->generateSalt ();
			$this->password = $this->hashPassword ( $rawPassword, $this->passwordSalt );
		} else { // fail
			$this->setError ( 'password', 'PASSWORD_TOO_SHORT' );
		}
	}
	// make a salt from md5
	// md5 is weak for just hashing, but for salt it should be ok
	public function generateSalt() {
		$MAX_LENGHTH = 6;
		$intermediateSalt = md5 ( uniqid ( rand (), true ) );
		return substr ( $intermediateSalt, 0, $MAX_LENGHTH ); // the salt
	}
	
	// hash using sha256 and a salt
	public function hashPassword($rawPassword, $salt) {
		return hash ( "sha256", $rawPassword . $salt );
	}
	public function setUserId($id) {
		// Set the value of the userId to $id
		$this->userId = $id;
	}
	public function changeInfo($formInput = null) {
		$this->formInput = $formInput;
		$this->validateFirstName ();
		$this->validateLastName ();
		$this->validateUserName ();
		$this->validateEmail ();
	}
}
?>