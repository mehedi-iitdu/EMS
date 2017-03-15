<?php

	include '../db/db_connect.php';

	$role_name = $_POST['role_name'];

	$sql = "INSERT INTO role (role_name) VALUES ('$role_name')";
	$result = mysqli_query($connection, $sql);

	if ($result) {
		echo "Role added";
	}

	else{
		echo "Sorry";
	}

?>