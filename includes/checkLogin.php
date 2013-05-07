<?php
	session_start();
	require_once("global.php");
	require_once("functions.php");
	
	dbconnect($host, $user, $pw, $db);
	
	$salt = '8dn37dnsa9nd7012na';
	
	//login variables
	$username = $_POST['username'];
	$password = hash('md5',$_POST['password'] . $salt);
	
	$query = "SELECT id FROM prj_user WHERE username='".$username."'";
	
	$result = mysqli_query($dbc, $query)
		or die('Can not read username from database!');
		
	if (mysqli_num_rows($result) == 0)
	{
		header('Location: ../Login.php?lerror=1');
		session_start();
		unset($_SESSION["ckname"]);
		exit;
	}
	
	$_SESSION["ckname"] = $_POST['username'];
		
	$query = "SELECT * FROM prj_user WHERE username='".$username."' AND password='".$password."'";
	
	$result = mysqli_query($dbc, $query)
		or die('Can not read password from database!');
		
	if (mysqli_num_rows($result) == 0)
	{
		header('Location: ../Login.php?lerror=2');
		exit;
	}
	
	//session_start();
	$row = mysqli_fetch_array($result);
	$_SESSION['name'] = $row['firstname'] . ' ' . $row['lastname'];
	$_SESSION['username'] = $row['username'];
	$_SESSION['id'] = $row['id'];
	$_SESSION['type'] = $row['account_type'];
	
	
	//This checks your cart session to see if you have items, and if you do it will update the database after you log in
	if(isset($_SESSION['cart']))
	{
		
		$arraycount = count($_SESSION['cart']);
		for($i = 0; $i < $arraycount; $i++)
		{
			dbconnect($host, $user, $pw, $db);
		
			$query = "SELECT * FROM prj_cart_item WHERE user_id ='".$_SESSION['id']."' AND product_id='".$_SESSION['cart'][$i]['prodID']."'";
			$result = mysqli_query($dbc, $query)
				or die ('Cannot get cart items from database!');
			
			$row = mysqli_fetch_array($result);
				
			if($row != null)
			{
				$newQuantity = intval($row['quantity']) + intval($_SESSION['cart'][$i]['quantity']);
				$query = "UPDATE prj_cart_item SET quantity = ".$newQuantity." WHERE id = ".$row['id']."";
				$result = mysqli_query($dbc, $query)
					or die ('Cannot update database!');
			}
			else
			{
				$query = "INSERT INTO prj_cart_item (product_id, user_id, quantity) VALUES ('".$_SESSION['cart'][$i]['prodID']."', 
							'".$_SESSION["id"]."', '".$_SESSION['cart'][$i]['quantity']."')";
				$result = mysqli_query($dbc, $query)
					or die ('Cannot add item to cart!');
			}
		}
		
		unset($_SESSION['cart']);
	}
	
	header('Location: ../Welcome.php');
	exit;
	
?>