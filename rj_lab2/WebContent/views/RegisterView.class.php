<?php
class RegisterView {
	public static function show($user) {
		?>

<!DOCTYPE html>
<html>
<head>
<title>UniReview Account</title>
</head>
<body>

	<section>
	
	<!--  maybe should post errors from inputs here? -->
	<!--  would need to make a function for getting all errors -->
	
		<form action="simpleEcho.php" method="post">

			First Name: <input type="text" name="firstname"
				value="<?php if($user) echo $user->getFirstName()?>" required> Last
			Name: <input type="text" name="lastname"
				value="<?php if($user) echo $user->getLastName()?>" required> <br> <br>
			User Name: <input type="text" name="username"
				value="<?php if($user) echo $user->getUserName()?>" required> <br> <br>
			Password: <input type="password" name="password" value="" required> <br>
			<br> <br> Contact Info: <br> <br> Email: <input type="email"
				name="email" value="<?php if($user) echo $user->getEmail()?>"
				required> <br> Telephone: <input type="tel" name="telephone"
				value="<?php if($user) echo $user->getTelephone()?>" required> <br>
			Gender: <input type="radio" name="gender" value="male" checked>Male <input
				type="radio" name="gender" value="female">Female <br> <br> <br>
			Account Information: Picture: <input type="file" name="file"> <br>
			Website: <input type="url" name="website"
				value="<?php if($user) echo $user->getWebsite()?>"> <br> State: <input
				list="states" value="<?php if($user) echo $user->getState()?>"> <br>
			Favorite Color: <input type="color" name="color"
				value="<?php if($user) echo $user->getColor()?>"> <br> Birthday: <input
				type="month" name="month" value="getBirthday()"> <br> <br> <input
				type="submit" value="Submit">
		</form>

		<!--  going to create this differently later -->
		<datalist id="states">
			<option value="AL"></option>
			<option value="AK"></option>
			<option value="AZ"></option>
			<option value="AR"></option>
			<option value="CA"></option>
			<option value="CO"></option>
			<option value="CT"></option>
			<option value="DE"></option>
			<option value="FL"></option>
			<option value="GA"></option>
			<option value="HI"></option>
			<option value="ID"></option>
			<option value="IL"></option>
			<option value="IN"></option>
			<option value="IA"></option>
			<option value="KS"></option>
			<option value="KY"></option>
			<option value="LA"></option>
			<option value="ME"></option>
			<option value="MD"></option>
			<option value="MA"></option>
			<option value="MI"></option>
			<option value="MN"></option>
			<option value="MS"></option>
			<option value="MO"></option>
			<option value="MT"></option>
			<option value="NE"></option>
			<option value="NV"></option>
			<option value="NH"></option>
			<option value="NJ"></option>
			<option value="NM"></option>
			<option value="NY"></option>
			<option value="NC"></option>
			<option value="ND"></option>
			<option value="OH"></option>
			<option value="OK"></option>
			<option value="OR"></option>
			<option value="PA"></option>
			<option value="RI"></option>
			<option value="SC"></option>
			<option value="SD"></option>
			<option value="TN"></option>
			<option value="TX"></option>
			<option value="UT"></option>
			<option value="VT"></option>
			<option value="VA"></option>
			<option value="WA"></option>
			<option value="WV"></option>
			<option value="WI"></option>
			<option value="WY"></option>
		</datalist>

	</section>
</body>
</html>
<?php
	}
}
?>