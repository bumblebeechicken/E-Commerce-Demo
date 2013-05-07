<?php
	session_start();
	require_once("global.php");
	require_once("functions.php");
	
	dbconnect($host, $user, $pw, $db);
	
	$quantity = $_POST['quantity'];
	$prodID = $_POST['productid'];
	
	//Check to see if the user is logged in
	if(isset($_SESSION['id']))
	{
		//Get item in the cart table where the userid equals the id of the user logged in
		$query = "SELECT * FROM prj_cart_item WHERE user_id ='".$_SESSION['id']."' AND product_id='".$prodID."'";
		$result = mysqli_query($dbc, $query)
			or die ('Cannot get cart items from database!');
		
		$row = mysqli_fetch_array($result);
		
		if ($row == null)
		{
			//Insert new row if product is not in user's cart
			$query = "INSERT INTO prj_cart_item (product_id, user_id, quantity) VALUES ('".$prodID."', '".$_SESSION["id"]."', '".$quantity."')";
			$result = mysqli_query($dbc, $query)
				or die ('Cannot add item to cart!');
		}
		else
		{
			//Update item in cart if product is in user's cart
			$newQuantity = intval($row['quantity']) + intval($quantity);
			$query = "UPDATE prj_cart_item SET quantity = ".$newQuantity." WHERE id = ".$row['id']."";
			$result = mysqli_query($dbc, $query)
				or die ('Cannot update database!');
			
		}
		
		mysqli_close($dbc);
	}
	else //If the user is not logged in store the cart into a session
	{
		//check to see if the cart session exits
		if(isset($_SESSION['cart']))
		{
			$exists = false;
			$arraycount = count($_SESSION['cart']);
			//Loop through the cart array to check if the product is already in your cart
			for ($i = 0; $i < $arraycount; $i++)
			{
				if ($_SESSION['cart'][$i]['prodID'] == $prodID)
				{
					$exists = true;
					break;
				}
			}
			
			if ($exists == true)
			{
				//Add the quantity entered to the quantity into the array if the product exists
				$_SESSION['cart'][$i]['quantity'] = intval($_SESSION['cart'][$i]['quantity']) + intval($quantity);
			}
			else
			{
				//Create a new item in the array if product isn't already stored
				$newIndex = count($_SESSION['cart']);
				$_SESSION['cart'][$newIndex]['prodID'] = $prodID;
				$_SESSION['cart'][$newIndex]['quantity'] = $quantity;
			}
		}
		else //create the session if it does not
		{
			$_SESSION['cart'] = array();
			$_SESSION['cart'][0]['prodID'] = $prodID;
			$_SESSION['cart'][0]['quantity'] = $quantity;
		}
	}
	
	header("Location: ../Cart.php");
	exit;

?>