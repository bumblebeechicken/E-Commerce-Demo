<?php
	//Start Session
	session_start();
	//Inlcude global variables and functions
	//I won't need to copy and paste this code everywhere!
	require_once("./includes/global.php");
	require_once("./includes/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	
	<?php
		//Check to see what page we are on. The confirm page redirects so we have to check for it!
		if ($page == "confirm")
		{
			echo '<meta http-equiv="refresh" content="5; Login.php" />';
		}
		else
		{
			echo '<meta charset="utf-8" />';
		}
	?>

    <title><?php echo 'Clover - '.$title; ?></title>
	<link type="text/css" rel="stylesheet" href="style/styles.css" />
	
	<!-- Script that allows IE8 and lower to render HTML5 specific tags -->
	<script src="js/html5.js" type="text/javascript"></script>
		
	<!-- jQuery script library included -->
	<script type="text/javascript" src="js/jquery.js"></script> 
	
	<!-- My validation.js file re-written in jQuery -->
	<?php 
		
		/*Only include this javascript file for the Register and gallery pages.*/
		/*No need for validation on other pages!*/
		if ($page == 'register')
		{
			echo '<script type="text/javascript" src="js/jq-validation.js"></script>';
		}
		else if ($page == 'gallery')
		{
			echo '<script type="text/javascript" src="js/jq-cartval.js"></script>';
		}
	?>
	
  </head>
  
  <body>
  
	<!-- This link just gets me back to the top of the page -->
	<a href="#top"></a>
	<!-- This is a background gradient! -->
	<div id="fancypants">
		<!--The main wrapper I use for the entire site. This allows me to center the entire page and set a specific width.-->
		<div id="page_wrapper">

			<header id="page_heading">
				<h1>Clover Art Gallery</h1>
			</header>
			
			<!-- Site logo -->
			<img id="clover" src="img/clover.png" alt="An image of Clover Art Gallery's blue clover logo.">
			
			<header id="user_message">
				<?php
					if(isset($_SESSION["name"]))
					{
						echo '<div >Welcome back ' . $_SESSION["name"] . ' ' . $_SESSION['type'].'</div>';
					}
				?>
			</header>
			
			<?php require_once("top_nav.php"); ?>
			
			<div id="content_wrapper">
			
				<aside id="updates">
					<h3>Updates</h3>
					
					<article>
						<h4>New Print Available</h4>
						<p>- A new art print is available in our <a href="./Gallery.php">Gallery</a></p>
					</article>
					
					<article>
						<h4>Clover Art Gallery Exhibition</h4>
						<p>- Clover Art Gallery is going to attend a local art exhibit.
						See <a href="./About.php">About</a> page for further details.</p>
					</article>
				</aside>
				
				<section id="main">
				
				
<!-- End Header -->