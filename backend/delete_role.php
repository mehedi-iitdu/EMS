<?php

	include '../db/db_connect.php';

	$role_id = $_POST['role_id'];

	$sql = "DELETE FROM role WHERE role_id = '$role_id'";
	$result = mysqli_query($connection, $sql);

	if ($result) {
		echo "Okay";
	}

	else{
		echo "Sorry";
	}

?>