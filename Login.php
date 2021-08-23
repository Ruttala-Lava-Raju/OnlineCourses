<?php
	session_start();
	include "MySQLConnection.php";
	$jsonString = file_get_contents('php://input');
	$newJsonString = json_decode($jsonString, true);
	$uname = $newJsonString["uname"];
	$psw = $newJsonString["password"];
	$selectQuery = "SELECT uId, name, uEmail from users where uEmail = '$uname' and uPwd = '$psw'";
	$result = $dbConn -> query($selectQuery);
	if($result -> num_rows != 0)
	{
		$row = $result -> fetch_assoc();
		$userId =  $row["uId"];
		$userName = $row["name"];
		$userMail = $row["uEmail"];
		$_SESSION['userId'] = $userId;
		$_SESSION['userName'] = $userName;
		$_SESSION['userMail'] = $userMail;
		echo "$userId";
	}
	else
	{
		http_response_code(400);
		session_destroy();
	}
	$dbConn -> close();
?>

