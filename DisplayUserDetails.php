<?php
	session_start();
	$userDetails = array();
	if ($_SESSION != null) {
		$userDetails = $_SESSION;
		$userDetails = json_encode($userDetails);
		echo "$userDetails";
	}
	else
	{
		http_response_code(400);
	}
?>