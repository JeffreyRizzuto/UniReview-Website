<?php
class EditAccountView {
	public static function show() {
		$_SESSION ['headertitle'] = "Edit Account";
		MasterView::showHeader ();
		MasterView::showNavbar ();
		EditAccountView::showDetails ();
		$_SESSION ['footertitle'] = "<h3>Made by Jeff</h3>";
		MasterView::showFooter ();
	}
	public static function showDetails() {
		$user = $_SESSION ['user'];
		$base = $base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
		?>
<section>

	<!--  maybe should post errors from inputs here? -->
	<!--  would need to make a function for getting all errors -->
	<form action="/<?php echo $base?>/account/edit" method="post">

		First Name: <input type="text" name="firstName"
			value="<?php echo $user->getFIrstName()?>" required> Last
		Name: <input type="text" name="lastName"
			value="<?php echo $user->getLastName()?>" required> <br> <br>
		User Name: <input type="text" name="userName"
			value="<?php echo $user->getUserName()?>" required> <br> <br>
		<br> <br> Contact Info: <br> <br> Email: <input type="email"
			name="email" value="<?php echo $user->getEmail()?>" required> <br>
			<input type="submit" value="Submit">
	</form>
</section>
<?php
	}
}
?>