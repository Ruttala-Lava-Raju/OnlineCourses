<?php
session_start();
include 'MySQLConnection.php';
header('Content-Type: application/json');
$jsonString = file_get_contents('php://input');
$newJsonString = json_decode($jsonString, true);
$title = $newJsonString["title"];
$description = $newJsonString["description"];
$objective = $newJsonString["objective"];
$userId = $_SESSION['userId'];
$insertQuery = "insert into Syllabuses values(DEFAULT, '$title', '$description', '$objective', 1, $userId)";
if($dbConn->query($insertQuery) === TRUE)
{
	$lastId = $dbConn -> insert_id;
	$selectQuery = "select * from Syllabuses where syllabusID = $lastId AND status = 1 AND userId = $userId";
	$result = $dbConn -> query($selectQuery);
	$row = $result -> fetch_assoc();
	$syllabusItem = new stdClass();
	$syllabusItem = $row;
	$syllabusItem = json_encode($syllabusItem);
	echo($syllabusItem);
	http_response_code(201);
}
else {
	http_response_code(400);
}

$dbConn -> close();
?>