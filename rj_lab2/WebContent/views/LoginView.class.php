<?php  
class LoginView {
	
  public static function show($user) {  	
?>

<!DOCTYPE html>
<html>
<head>
<title>UniReview Login</title>
<meta name="keywords" content=" UniReview login">
<meta name="description" content="Login for UniReview">
</head>
<body>

	<h1>UniReview</h1>
	<!-- eventually will be replaced with logo -->

	<form action="login" method="Post">
		<p>
			User name: <input type="text" name="userName"
				<?php if (!is_null($user)) {echo 'value = "'. $user->getUserName() .'"';}?>>
			<span class="error">
	   <?php if (!is_null($user)) {echo $user->getError('userName');}?>
	</span>
		</p>
		
		<!--  Password input for the form will go here -->
		
		<p>
			<input type="submit" name="submit" value="Submit">
		</p>
	</form>

	<p>
		<a href="register">Create a Account</a>
	</p>
	<!-- Account recovery can go here -->
</body>
</html>
</body>
</html>
<?php 
  }
}
?>