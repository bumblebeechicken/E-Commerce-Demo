<?php 
	$title = "Register";
	$page = "register";
	require_once("header.php"); 
	
	//check to see if the user is already logged in
	//if they are, redirect them to the customerWelcome.php page
	if(isset($_SESSION["name"]))
	{
		header('Location: Welcome.php');
		exit;
	}
?>
  
	<h2>Customer Registration</h2>

	<article>
		<p>Welcome to Clover Art Gallery's customer registration page. Registering as a member 
		allows you to purchase prints from our art gallery. You will also be able to receive 
		updates on our latest artwork in our gallery as well as special offers sent only
		to our registered members.</p>
		<p><a href="Login.php">Already registered? Click here to login.</a></p>
	</article>
	
	<article id="userform">
		<h3>Registration Form:</h3>
		<form id="registerform" action="Confirmation.php" method="post">
			<p>
				<label for="firstname">First Name:</label>
				<input class="box" type="text" id="firstname" name="firstname" value="" size="25" />
				<span id="firstnameMsg">Enter your first name</span>
			</p>
			<p>
				<label for="lastname">Last Name:</label>
				<input class="box" type="text" id="lastname" name="lastname" value="" size="25" />
				<span id="lastnameMsg">Enter your last name</span>
			</p>
			<p>
				<label for="username">Username: </label>
				<input class="box" type="text" id="username" name="username" value="" size="25" />
				<span id="usernameMsg">Pick a username</span>
			</p>
			<p>
				<label for="password">Password: </label>
				<input class="box" type="password" id="password" name="password" value="" size="25"/>
				<span id="passwordMsg">Enter alphanumeric password</span>
			</p>
			<p>
				<label for="repassword">Re-enter Password: </label>
				<input class="box" type="password" id="repassword" name="repassword" value="" size="25" />
				<span id="repasswordMsg">Re-enter your password</span>
			</p>
			<p>
				<label for="email">Email: </label>
				<input class="box" type="text" id="email" name="email" value="" size="25"/>
				<span id="emailMsg">What is your email address?</span>
			</p>
			<p>
				<label for="newsletter">Subscribe to newsletter?</label>
				<input type="checkbox" id="newsletter" name="newsletter" value="yes" checked="checked" />
			</p>
			<p>
				<label for="referral">Referral: </label>
				<select name="referral" id="referral">
					<option value="None">None</option>
					<option value="Friend">Friend</option>
					<option value="Website">Website</option>
					<option value="Advertisement">Advertisement</option>
				</select>
				<span id="referralMsg"></span>
			</p>
			
			<p id="userform_button">
				<input id="submit" type="submit" value="Submit" />
				<input id="reset" type="reset" value="Reset" />
			</p>
			
		</form>
		
	</article>
					
<?php require_once("footer.php"); ?>


