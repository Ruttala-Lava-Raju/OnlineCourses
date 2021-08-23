<?php
	session_start();
	include "MySQLConnection.php";
	$userId = $_SESSION['userId'];
	if ($userId != null) 
	{
		$SelectQuery = "SELECT * FROM Syllabuses where userId = $userId";
		$result = $dbConn->query($SelectQuery);
		$syllabusItems = array();
		if ($result -> num_rows != 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				$syllabusItems[] = $row;
			}
			$syllabusItems = json_encode($syllabusItems);
			echo $syllabusItems;
		}
		$dbConn -> close();
	}
	else
	{
		http_response_code(500);
	}
	
?>