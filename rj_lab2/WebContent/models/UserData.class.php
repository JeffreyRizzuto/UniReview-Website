<?php
include ("Messages.class.php");
class UserData {
	private $errorCount;
	private $errors;
	private $formInput;
	private $firstName;
	private $lastName;
	private $userName;
	private $password;
	private $telephone;
	private $website;
	private $state;
	private $color;
	private $email;
	private $gender;
	private $birthday;
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
	public function getErrorCount() {
		return $this->errorCount;
	}
	public function getErrors() {
		return $this->errors;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getFirstName() {
		return $this->firstName;
	}
	public function getGender() {
		return $this->gender;
	}
	public function getLastName() {
		return $this->lastname;
	}
	public function getUserName() {
		return $this->userName;
	}
	public function getTelephone() {
		return $this->telephone;
	}
	public function getPassword() {
		return $this->password;
	}
	public function getBirthday() {
		return $this->birthday;
	}
	public function getWebsite() {
		return $this->website;
	}
	public function getState() {
		return $this->state;
	}
	public function getColor() {
		return $this->color;
	}
	public function getParameters() {
		// Return data fields as an associative array
		$paramArray = array ("firstName" => $this->firstName,
							"lastName" => $this->lastName,
							"userName" => $this->userName,
							"password" => $this->password,
							"telephone" => $this->telephone,
							"website" => $this->website,"state" => $this->state,
							"color" => $this->color,"email" => $this->email,
							"gender" => $this->gender 
		);
		return $paramArray;
	}
	public function __toString() {
		$str = "First name:[" . $this->firstName . "] lastName:[" .
			 $this->lastName . "] userName:[" . $this->userName . "] password:[" .
			 $this->password . "] telephone:[" . $this->telephone . "] website:[" .
			 $this->website . "] state:[" . $this->state . "] color:[" .
			 $this->color . "]  email:[" . $this->email . "] gender:[" .
			 $this->gender . "]";
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
			$this->validateTelephone ();
			$this->validateState ();
			$this->validatePassword ();
			$this->validateColor ();
			$this->validateWebsite ();
			$this->validateUserName ();
			$this->validateBirthday();
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
		$this->telephone = "";
		$this->website = "";
		$this->state = "";
		$this->color = "";
		$this->email = "";
		$this->gender = "";
		$this->birthday = "";
	}
	private function validateEmail() {
		// Email should not have quoted characters
		$this->email = $this->extractForm ( 'email' );
		// More validation goes here
		if (filter_var ( $this->email, FILTER_VALIDATE_EMAIL )) {
			// pass
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
		if (strlen ( $this->lastName ) <= 1)
			$this->setError ( 'lastName', 'LAST_NAME_TOO_SHORT' );
		// More validation goes here
	}
	private function validateLastName() {
		// Last name should not have quoted characters
		$this->lastName = $this->extractForm ( 'lastName' );
		// Last name should be at least 2 characters
		if (strlen ( $this->lastName ) <= 1)
			$this->setError ( 'lastName', 'LAST_NAME_TOO_SHORT' );
	}
	private function validateUserName() {
		// UserName should not have quoted characters
		$this->userName = $this->extractForm ( 'userName' );
		// UserName should be at least 2 characters
		if (strlen ( $this->userName ) <= 1)
			$this->setError ( 'userName', 'USER_NAME_TOO_SHORT' );
	}
	private function validateTelephone() {
		// Telephone should be 7 or 10 digits long
		$this->telephone = $this->extractForm ( 'telephone' );
		$telephoneNumbers = ereg_replace ( "[^0-9]", "", $this->telephone );
		$numberOfDigits = strlen ( $telephoneNumbers );
		if ($numberOfDigits == 7 or $numberOfDigits == 10) {
			// pass
		} else {
			$this->setError ( 'telephone', 'PHONE_NUMBER_INVALID' );
		}
	}
	//eventually need to compare it to a list of states, 
	//hard coding it here would be messy
	private function validateState() {
		$this->state = $this->extractForm ( 'state' );
	}
	private function validatePassword() {//going to hash passwords, all is allowed
		$this->password = $this->formInput ['password'];
		if(strlen($this->password) >= 6){//pass
			
		} else {//fail
			$this->setError ( 'password', 'PASSWORD_TOO_SHORT' );
		}
	}
	private function validateColor() {
		$this->color = $this->extractForm ( 'color' );
		if($this->color){
			if(preg_match('/%[A-Za-z0-9]{7}/', $this->color)){//pass
			} else {//fail
				$this->setError ( 'color', 'COLOR_INCORRECT_FORMAT' );
			}
		}
	}
	private function validateBirthday() {
		$this->birthday = $this->extractForm ( 'birthday' );
	}
	private function validateWebsite() {
		$this->website = $this->extractForm ( 'website' );
	}
}
?>