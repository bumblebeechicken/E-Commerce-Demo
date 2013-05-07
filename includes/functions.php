<?php

function dbconnect($host, $user, $pw, $db){
	
	global $dbc;
	if($dbc) {
		return $dbc;
	}
	
	$dbc = mysqli_connect($host, $user, $pw, $db)
		or die ('Cannot connect to the database!');
}

?>