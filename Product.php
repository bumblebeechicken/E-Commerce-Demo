<?php 
	$title = "Gallery";
	$page = "gallery";
	require_once("header.php"); 
	

	if(empty($_GET)) /*This runs when there are no parameters in the URL otherwise you return PHP errors*/
	{
		echo '<p>Cannot find product!</p>';
	} 
	else
	{
		dbconnect($host, $user, $pw, $db);
	
		$query = 'SELECT * FROM prj_product WHERE id = '.($_GET["pid"]) ;
		$result = mysqli_query($dbc, $query)
			or die ('Cannot get products from database!');
			
		$row = mysqli_fetch_array($result);
		
		//If query is null then no products were found
		if ($row == null)
		{	
			echo '<p>No product found!</p>';
		}
		else
		{
			//Display the product information
			echo '	<img alt="'.$row['title'].'" id="prod_md" src="./gallery/'.$row['image'].'_md.png" />
					<article class="product">
						<h2>'.$row['title'].'</h2>
						<p id="product_desc">'.$row['description'].'</p>';
			
			//Check if the product contains a discount and format the discount to be obvious
			if ($row['discount'] > 0)
			{	
				$new_price = $row['price'] - ($row['price'] * $row['discount']);
				echo '	<p><span class="old_price">$'.number_format($row['price'],2,'.',',').'</span>
					&nbsp;&nbsp;<span class="discount">$'.number_format($new_price,2,'.',',').'</span></p>';
			}
			else
			{
				echo '	<p id="pnroduct_price">$'.number_format($row['price'],2,'.',',').'</p>';
			}
			
			echo '		<p id="product_dim">'.$row['dimensions'].'</p>
					</article>';
			
			//Display the Add To Cart form
			echo '	<article class="cartform">
						<form id="productAdd" action="./includes/addCart.php" method="post">
							<p>
								<label class="product" for="quantity">Quantity: </label>
								<input class="quantity" type="text" id="quantity" name="quantity" value="1" size="1" />
								<input type="hidden" name="productid" value="'.$row['id'].'" />
								<span id="quantityMsg">Enter a quantity</span>
							</p>
							<p id="cartform_button">
								<input id="add" type="submit" value="Add to Cart" />
							</p>
						</form>
					</article>';
		}
	
		mysqli_close($dbc);
	}

	require_once("footer.php"); 
?>