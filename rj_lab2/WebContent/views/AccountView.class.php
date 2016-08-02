<?php
class AccountView {
	public static function show($user) {
?>

<!DOCTYPE html>
<html>
<head>
<title>UniReview Account</title>
</head>
<body>

	<h1><a href="home">UniReview</a></h1>
	<img src="" alt="Profile Picture" style="width: 304px; height: 228px;">
	<br>

	<h2>Account Information</h2>

	<h3>Name</h3>
	<?php echo $user->getFirstName . " " . $user->getLastName?>

	<h3>User Name</h3>
	<?php echo $user->getUserName?>

	<h3>Email</h3>
	<?php echo $user->getEmail?>

	<h3>Telephone</h3>
	<?php echo $user->getTelephone?>

	<h2>Profile Information</h2>

	<h3>Birthday</h3>
	<?php echo $user->getBirthday?>

	<h3>Favrorite Color</h3>
	<?php echo $user->getColor?>

	<h3>State</h3>
	<?php echo $user->getState?>

	<h3>Website</h3>
	<?php echo $user->getWebsite?>

</body>
</html>
<?php
  }
}
?>