<?php
	session_start();
	require_once("global.php");
	require_once("functions.php");
	
	dbconnect($host, $user, $pw, $db);
	
	if(empty($_GET)) /*This runs when there are no parameters in the URL otherwise you return PHP errors*/
	{
		echo '<p>Cannot find cart item!</p>';
	}
	else
	{
		if(isset($_SESSION['id']))
		{
			dbconnect($host, $user, $pw, $db);
			
			$query = 'DELETE FROM prj_cart_item WHERE id = '.($_GET["cid"]) ;
			$result = mysqli_query($dbc, $query)
				or die ('Cannot remove cart item from database!');
		}
		else
		{
			$i = $_GET["cid"];
			unset($_SESSION['cart'][$i]);
			$_SESSION['cart'] = array_values($_SESSION['cart']);
			if(count($_SESSION['cart']) <= 0)
			{
				unset($_SESSION['cart']);
			}
		}
	}
	
	header("Location: ../Cart.php");
	exit;

?>