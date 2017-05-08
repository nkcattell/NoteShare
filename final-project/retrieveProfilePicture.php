<?php
	require_once "userAuth.php";
	session_start();

	$db_connection = new mysqli($host, $user, $password, $database);
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	}

	$username = $_SESSION["user"];
	$query = "select picture from users where name = '{$username}'";
	$result = mysqli_query($db_connection, $query);
	if ($result) {
		$resultArray = mysqli_fetch_assoc($result);
		header("Content-type: image/jpeg");
		echo $resultArray['picture'];
		mysqli_free_result($result);
	}

	mysqli_close($db_connection);
?>