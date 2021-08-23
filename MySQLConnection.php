<?php
	$severName = "165.22.14.77";
	$userName = "b27";
	$psw = "b27";
	$dbName = "Courses";
	$dbConn = mysqli_connect($severName, $userName, $psw, $dbName);
	if (!$dbConn) 
	{
		die("Connection failed: " . mysqli_connect_error());
	}	
?>