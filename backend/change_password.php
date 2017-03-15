<?php
	
	session_start();

	include '../db/db_connect.php';

	$old_password = $_POST['old_password'];
	$confirm_password = $_POST['confirm_password'];
	$employee_id = $_SESSION['login_id'];

	$sql = "UPDATE employee SET password='$confirm_password' WHERE employee_id='$employee_id' AND password='$old_password'";
	$result = mysqli_query($connection, $sql);

	$mysqli_affected_rows = mysqli_affected_rows($connection);

	if ($mysqli_affected_rows > 0) {
			
		echo "Okay";
	}
	else {
		echo "Sorry";	
	}

?>