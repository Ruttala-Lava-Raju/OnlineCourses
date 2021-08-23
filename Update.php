<?php
include 'MySQLConnection.php';
header('Content-Type: application/json');
$jsonString = file_get_contents('php://input');
$newJsonString = json_decode($jsonString, true);
$syllabusId = $newJsonString["syllabusId"];
$title = $newJsonString["title"];
$description = $newJsonString["description"];
$objective = $newJsonString["objective"];
$searchQuery = "SELECT syllabusID FROM Syllabuses WHERE syllabusID = $syllabusId AND status = 1";
$result = $dbConn -> query($searchQuery);
$numberfRows = $result -> num_rows;
if($numberfRows != 0)
{

	$updateQuery = "UPDATE Syllabuses SET title = '$title', description = '$description', objectives = '$objective' WHERE syllabusID = $syllabusId";
	if($dbConn->query($updateQuery) === TRUE)
	{
		http_response_code(202);
		$selectQuery = "select * from Syllabuses where syllabusID = $syllabusId AND status = 1";
		$result = $dbConn -> query($selectQuery);
		$row = $result -> fetch_assoc();
		$syllabusItem = new stdClass();
		$syllabusItem = $row;
		$syllabusItem = json_encode($syllabusItem);
		echo($syllabusItem);
	}
	else {
		http_response_code(500);
	}
}
else
{
	http_response_code(404);
}

$dbConn -> close();
?>