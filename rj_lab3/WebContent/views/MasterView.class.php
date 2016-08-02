<?php
class MasterView {
	public static function showHeader() {
		$title = (array_key_exists ( 'headertitle', $_SESSION )) ? $_SESSION ['headertitle'] : "";
		?>
<!DOCTYPE html>
<html>
<head>
<title><?php $title ?></title>
</head>
<body>
        <?php
	}
	public static function showNavBar() {
		// Show the navbar
		$user = (array_key_exists ( 'user', $_SESSION )) ? $_SESSION ['user'] : null;
		if (! is_null ( $user ))
			echo "Hello " . $user->getUserName () . " <br>";
?>
<nav>
	<a href="home">Home</a>
	<a href="register">Sign-up</a>
	<a href="account">Account(temp)</a>
	<a href="tests.html">Tests</a>
	<a href="login">Login</a>
</nav>
	<?php
	}
	public static function showFooter() {
		$footer = (array_key_exists ( 'footertitle', $_SESSION )) ? $_SESSION ['footertitle'] : "";
		echo $footer;
		?>
		
</body>
</html>
		<?php
	}
}
?>