<?php 
	$title = "Gallery";
	$page = "gallery";
	require_once("header.php"); 
?>
  
	<h2>Gallery</h2>
	
<?php
	dbconnect($host, $user, $pw, $db);
	
	$query = 'SELECT * FROM prj_product';
	$result = mysqli_query($dbc, $query)
		or die ('Cannot get products from database!');
	
	$colcount = 1;
	
	while ($row = mysqli_fetch_array($result))
	{
		if ($colcount == 1)
		{
			echo '<article class="gal_left">';
		}
		else if ($colcount == 2)
		{
			echo '<article class="gal_center">';
		}
		else if ($colcount == 3)
		{
			echo '<article class="gal_right">';
		}
		echo '	<a href="Product.php?pid='.$row['id'].'"><img alt="'.$row['title'].'" class="prod_sm" src="./gallery/'.$row['image'].'_sm.png" /></a>';
		echo '	<p><a href="Product.php?pid='.$row['id'].'">'.$row['title'].'</a></p>';
		if ($row['discount'] > 0)
			{	
				$new_price = $row['price'] - ($row['price'] * $row['discount']);
				echo '	<p><span class="old_price">$'.number_format($row['price'],2,'.',',').'</span> 
					&nbsp;&nbsp;<span class="discount">$'.number_format($new_price,2,'.',',').'</span></p>';
			}
			else
			{
				echo '	<p class="product_price">$'.number_format($row['price'],2,'.',',').'</p>';
			}
		echo '</article>';
		
		$colcount++;
		if ($colcount > 3){$colcount = 1;}
	}
	
	
	mysqli_close($dbc);
?>
					
<?php require_once("footer.php"); ?>


