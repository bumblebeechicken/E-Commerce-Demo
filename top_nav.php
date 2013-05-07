<!-- Begin Top Navigation -->

<?php 
	
	/*Arrays for navigation menus. 
	Allows me to easily add more items to the menu and to dynamically
	generate the navigation as I wish. */
	$left_nav = array
		(
			array("home" , "Home" , "index.php"),
			array("gallery" , "Gallery" , "Gallery.php"),
			array("about" , "About" , "About.php"),
			array("contact" , "Contact" , "Contact.php")
		);
					
	$right_nav_guest = array
		(
			array("login" , "Login" , "Login.php"),
			array("register" , "Register" , "Register.php")
		);
	
	$right_nav_user = array
		(
			array("logout" , "Logout" , "Logout.php"),
			array("profile" , "My Profile" , "Profile.php")
		);
	
?>

<nav id="head_nav">
	<ul>
		<?php
			//Loop through the left nav array
			for ($row =0; $row < count($left_nav); $row++)
			{
				//This checks the page variable set in each page to determine which page is selected
				if ($left_nav[$row][0] == $page)
				{
					echo '<li class="selected"><a href="'.$left_nav[$row][2].'">'.$left_nav[$row][1].'</a></li>';
				}
				else
				{
					echo '<li><a href="'.$left_nav[$row][2].'">'.$left_nav[$row][1].'</a></li>';
				}
			}
		?>
	</ul>
</nav>

<nav id="login_nav">
	<ul>
		<?php 
			//Check to see if user is logged in and display user navigations.
			//Otherwise display guest navigation.
			
			$cartitems = 0;
			//Get the number of items in your cart if you are logged in
			if (isset($_SESSION['id']))
			{
				dbconnect($host, $user, $pw, $db);
				
				$query = "SELECT * FROM prj_cart_item WHERE user_id ='".$_SESSION['id']."'";
				$result = mysqli_query($dbc, $query)
					or die ('Cannot get cart items from database!');
				
				while ($row = mysqli_fetch_array($result))
				{
					$cartitems += intval($row['quantity']);
				}
				
				if(intval($cartitems) > 99)
				{
					$cartitems = '99+';
				}
				
			}
			else //Get the number of items in your cart if you aren't logged in
			{
				if(isset($_SESSION['cart']))
				{
					$arraycount = count($_SESSION['cart']);
					for($i = 0; $i < $arraycount; $i++)
					{
						$cartitems += intval($_SESSION['cart'][$i]['quantity']);
					}
					
					if(intval($cartitems) > 99)
					{
						$cartitems = '99+';
					}
				}
			}
			
			
			//Display shopping cart link. This gets special treatment because it uses an image
			if ($page == 'cart')
			{
				echo '<li class="selected"><a href="Cart.php"><img class="cart" alt="Shopping Cart Items is '.(string)$cartitems.'" src="./img/cart.png" /><span>'.(string)$cartitems.'</span></a></li>';
			}
			else
			{
				echo '<li><a href="Cart.php"><img class="cart" alt="Shopping Cart Items is '.(string)$cartitems.'" src="./img/cart.png" /><span>'.(string)$cartitems.'</span></a></li>';
			}
			
			if(isset($_SESSION["name"]))
			{
				//Loop through the right nav user array
				for ($row =0; $row < count($right_nav_user); $row++)
				{
					if ($right_nav_user[$row][0] == $page)
					{
						echo '<li class="selected"><a href="'.$right_nav_user[$row][2].'">'.$right_nav_user[$row][1].'</a></li>';
					}
					else
					{
						echo '<li><a href="'.$right_nav_user[$row][2].'">'.$right_nav_user[$row][1].'</a></li>';
					}
				}
			}
			else
			{
				//Loop through the right nav guest array
				for ($row =0; $row < count($right_nav_guest); $row++)
				{
					if ($right_nav_guest[$row][0] == $page)
					{
						echo '<li class="selected"><a href="'.$right_nav_guest[$row][2].'">'.$right_nav_guest[$row][1].'</a></li>';
					}
					else
					{
						echo '<li><a href="'.$right_nav_guest[$row][2].'">'.$right_nav_guest[$row][1].'</a></li>';
					}
				}
			}
			
			/* DO AN IF STATEMENT HERE TO CHECK FOR ADMIN ACCOUNT */
			//If I have time!
			//I will add in a link to an admin page that allows you to add products, view orders, cart items, etc..
			
		?>
	</ul>
</nav>

<!-- End Top Navigation -->