<?php

	include '../db/db_connect.php';

	$employee_id = $_POST['employee_id'];

	$sql = "DELETE FROM employee WHERE employee_id = '$employee_id'";
	$result = mysqli_query($connection, $sql);

	if ($result) {
		echo "Okay";
	}

	else{
		echo "Sorry";
	}

?>