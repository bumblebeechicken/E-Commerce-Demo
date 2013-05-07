<?php 
	$title = "Login";
	$page = "login";
	require_once("header.php"); 
	
	//check to see if the user is already logged in
	//if they are, redirect them to the customerWelcome.php page
	
	if(isset($_SESSION["name"]))
	{
		header('Location: Welcome.php');
		exit;
	}
	
	$lerror = 0;
?>

	<h2>Customer Login</h2>
	
	<article id="userform">
		<p>Not registered? <a href="Register.php">Register now!</a></p>
		<form id="loginform" action="includes/checkLogin.php" method="post">
			<!-- Check error codes returned from "checkLogin.php" -->
			
			<?php
				if(empty($_GET)) /*This runs when there are no parameters in the URL otherwise you return PHP errors*/
				{
					echo '<p class="error">&nbsp;</p>';
				} 
				else if($_GET["lerror"] == 1)
				{
					echo '<p class="error">User name not found!</p>';
				}
				else if($_GET["lerror"] == 2)
				{
					echo '<p class="error">Invalid password!</p>';
				}
				
			?>
			
			<p>
				<label for="username">Username: </label>
				<input class="box" type="text" id="username" name="username" value="<?php if(isset($_SESSION['ckname'])){echo $_SESSION['ckname'];} ?>" size="25"
				required autofocus />
				
			</p>
			<p>
				<label for="password">Password: </label>
				<input class="box" type="password" id="password" name="password" value="" size="25"
				required />
				
			</p>
			
			<p id="userform_button">
				<input id="submit" type="submit" value="Login" />
			</p>
			
		</form>
		
	</article>
	
	
<?php require_once("footer.php"); ?>
					
				