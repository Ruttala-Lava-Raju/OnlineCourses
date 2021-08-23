<?php
	include "MySQLConnection.php";
	$jsonString = file_get_contents('php://input');
	$newJsonString = json_decode($jsonString, true);
	$syllabusNumber = $newJsonString["syllabusNumber"];
	$searchQuery = "SELECT syllabusID FROM Syllabuses WHERE syllabusID = $syllabusNumber AND status = 1";
	$result = $dbConn -> query($searchQuery);
	$numberOfRows = $result -> num_rows;
	if ($numberOfRows == 0) 
	{
		http_response_code(404);	
	}
	else
	{
		$updateQuery = "UPDATE Syllabuses SET status = 0 where syllabusID = $syllabusNumber";
		if($dbConn -> query($updateQuery) === TRUE)
		{
			http_response_code(204);
		}
		else 
		{
			http_response_code(400);
		}
	}

?>