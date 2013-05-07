<?php

if(isset($_POST['username']))
{
	$username = $_POST['username'];

	require_once("global.php");
	require_once("functions.php");
	
	dbconnect($host, $user, $pw, $db);
		
	$query = "SELECT id FROM prj_user WHERE username='".$username."'";
	
	$result = mysqli_query($dbc, $query)
		or die('Can not read database!');

	echo mysqli_num_rows($result);

	mysqli_close($dbc);
}
?>