<?php

	include '../db/db_connect.php';

	$department_id = $_POST['department_id'];

	$sql = "DELETE FROM department WHERE department_id = '$department_id'";
	$result = mysqli_query($connection, $sql);

	if ($result) {
		echo "Okay";
	}

	else{
		echo "Sorry";
	}

?>