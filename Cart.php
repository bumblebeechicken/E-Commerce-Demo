<?php 
	$title = "Shopping Cart";
	$page = "cart";
	require_once("header.php"); 

	echo '	<h2>Shopping Cart</h2>';
	
	echo '	<article id="cartheader">
				<span class="imagespace"></span>
				<span class="productheader">Product</span>
				<span class="quantityheader">Quantity</span>
				<span class="priceheader">Price</span>
			</article>';
	//Check if user is logged in
	$subtotal = 0;
	
	if (isset($_SESSION['id']))
	{
		//Get cart items from database if user is logged in
		dbconnect($host, $user, $pw, $db);
		
		//Pull the product information from the database
		$query = "SELECT * FROM prj_cart_item WHERE user_id ='".$_SESSION['id']."'";
		$result = mysqli_query($dbc, $query)
			or die ('Cannot get cart items from database!');
			
		$rows =  mysqli_num_rows($result);
		if($rows == null)
		{
			echo '<article><p>There are no items in your cart!</p></article>';
		}
			
		
		while($cartitem = mysqli_fetch_array($result))
		{
			$query = 'SELECT * FROM prj_product WHERE id = '.$cartitem['product_id'] ;
			$resultproduct = mysqli_query($dbc, $query)
				or die ('Cannot get product from database!');
			
			$row = mysqli_fetch_array($resultproduct);
			
			echo '	<article class="cartitem">
						<a href="./Product.php?pid='.$row['id'].'"><img class="cartlist" alt="'.$row['title'].'" src="./gallery/'.$row['image'].'_sm.png" /></a>
						<div class="itemtitle"><p><a href="./Product.php?pid='.$row['id'].'">'.$row['title'].'</a></p></div>
						<div class="itemquantity"><p>'.$cartitem['quantity'].'</p></div>';
					if($row['discount'] > 0)
					{
						$quantity = intval($cartitem['quantity']);
						$new_price = $row['price'] - ($row['price'] * $row['discount']);
						$subtotal += ($new_price * $quantity);
						echo '	<div class="itemprice">
									<p class="originalprice">$'.number_format($row['price'] * $quantity,2,'.',',').'</p>
									<p class="discount"> - $'.number_format(($row['price'] * $row['discount']) * $quantity,2,'.',',').' ('.($row['discount'] * 100).'% Discount)</p>
									<p class="discountprice">$'.number_format($new_price * $quantity,2,'.',',').'</p>
								</div>';
					}
					else
					{
						$quantity = intval($cartitem['quantity']);
						$price = $row['price'];
						$subtotal += ($price * $quantity);
						echo '<div class="itemprice"><p>$'.number_format($price * $quantity,2,'.',',').'</p></div>';
					}
			echo '		<div class="itemtrash"><p><a href="./includes/removeCart.php?cid='.$cartitem['id'].'">Remove</a></p></div>
					</article>';
		}
		
		echo '	<article class="subtotal">
					<p class="subtotal">Total: $'.number_format($subtotal,2,'.',',').'</p>
				</article>';
	}
	else if(isset($_SESSION['cart']))
	{
		dbconnect($host, $user, $pw, $db);
		
		//Get cart items from cart session
		$arraycount = count($_SESSION['cart']);
		for($i = 0; $i < $arraycount; $i++)
		{
			//Pull the product information from the database
			$query = 'SELECT * FROM prj_product WHERE id = '.($_SESSION['cart'][$i]['prodID']) ;
			$result = mysqli_query($dbc, $query)
				or die ('Cannot get product from database!');
			
			$row = mysqli_fetch_array($result);			
			
			echo '	<article class="cartitem">
						<a href="./Product.php?pid='.$row['id'].'"><img class="cartlist" alt="'.$row['title'].'" src="./gallery/'.$row['image'].'_sm.png" /></a>
						<div class="itemtitle"><p><a href="./Product.php?pid='.$row['id'].'">'.$row['title'].'</a></p></div>
						<div class="itemquantity"><p>'.($_SESSION['cart'][$i]['quantity']).'</p></div>';
					if($row['discount'] > 0)
					{
						$quantity = intval($_SESSION['cart'][$i]['quantity']);
						$new_price = $row['price'] - ($row['price'] * $row['discount']);
						$subtotal += ($new_price * $quantity);
						echo '	<div class="itemprice">
									<p>$'.number_format($row['price'] * $quantity,2,'.',',').'</p>
									<p class="discount"> - $'.number_format(($row['price'] * $row['discount']) * $quantity,2,'.',',').' ('.($row['discount'] * 100).'% Discount)</p>
									<p class="discountprice">$'.number_format($new_price * $quantity,2,'.',',').'</p>
								</div>';
					}
					else
					{
						$quantity = intval($_SESSION['cart'][$i]['quantity']);
						$price = $row['price'];
						$subtotal += ($price * $quantity);
						echo '<div class="itemprice"><p>$'.number_format($price * $quantity,2,'.',',').'</p></div>';
					}
			echo '		<div class="itemtrash"><p><a href="./includes/removeCart.php?cid='.$i.'">Remove</a></p></div>
					</article>';
		}
		
		echo '	<article class="subtotal">
					<p class="subtotal">Total: $'.number_format($subtotal,2,'.',',').'</p>
				</article>';
	}
	else
	{
		//No cart items
		echo '<article><p>There are no items in your cart!</p></article>';
		
		echo '	<article class="subtotal">
					<p class="subtotal">Total: $0.00</p>
				</article>';
	}
?>


<?php require_once("footer.php"); ?>