<?php
class RegisterView {
	public static function show() {
		$_SESSION ['headertitle'] = "Register Account";
		MasterView::showHeader ();
		MasterView::showNavbar ();
		RegisterView::showDetails ();
		$_SESSION ['footertitle'] = "<h3>Made by Jeff</h3>";
		MasterView::showFooter ();
	}
	public static function showDetails() {
		$user = (array_key_exists ( 'user', $_SESSION )) ? $_SESSION ['user'] : null;
		?>
<section>

	<!--  maybe should post errors from inputs here? -->
	<!--  would need to make a function for getting all errors -->
	<form action="account/create" method="post">

		First Name: <input type="text" name="firstName"
			value="<?php if($user) echo $user->getFirstName();?>" required> Last
		Name: <input type="text" name="lastName"
			value="<?php if($user) echo $user->getLastName();?>" required> <br> <br>
		User Name: <input type="text" name="userName"
			value="<?php if($user) echo $user->getUserName();?>" required> <br> <br>
		Password: <input type="password" name="password" value="" required> <br>
		<br> <br> Contact Info: <br> <br> Email: <input type="email"
			name="email" value="<?php if($user) echo $user->getEmail();?>"
			required> <br> Gender: <input type="radio" name="gender" value="male"
			checked>Male <input type="radio" name="gender" value="female">Female<br>
		<input type="submit" value="Submit">
	</form>
</section>
<?php
	}
}
?>