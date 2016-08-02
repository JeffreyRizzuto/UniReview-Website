<?php
class AccountView {
	public static function show() {
		$_SESSION ['headertitle'] = "UniReview Home Page";
		MasterView::showHeader ();
		MasterView::showNavbar ();
		AccountView::showDetails ();
		$_SESSION ['footertitle'] = "";
		MasterView::showFooter ();
	}
	public static function showDetails() {
	$user = $_SESSION ['user'];
	$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";	
	if ($user->getErrorCount() != 0)
		echo"Your account has errors, please click the link to fix them"
	?>
	<h4><a href="/<?php echo "$base"?>/account/modify">Edit Account Info</a></h4>
	<h2>Account Information</h2>

	<h3>Name</h3>
	<?php echo $user->getFirstName() . " " . $user->getLastName()?>

	<h3>User Name</h3>
	<?php echo $user->getUserName()?>

	<h3>Email</h3>
	<?php echo $user->getEmail()?>
	
	<h3>Gender</h3>
	<?php echo $user->getGender()?>
	
	
<?php
  }
}
?>