<?php

	include '../db/db_connect.php';

	$department_name = $_POST['department_name'];

	$sql = "INSERT INTO department (department_name) VALUES ('$department_name')";
	$result = mysqli_query($connection, $sql);

	if ($result) {
		echo "Department added";
	}

	else{
		echo "Sorry";
	}

?>