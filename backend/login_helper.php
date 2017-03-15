<?php
	
	session_start();
	
	include '../db/db_connect.php';

	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM employee WHERE email='$email'";
	$result = mysqli_query($connection, $sql);
	$row = mysqli_fetch_assoc($result);

	if ($row['password']==$password){

		$_SESSION['login_id']=$row['employee_id'];
		$_SESSION['login_email']=$row['email'];
		$_SESSION['login_role_id']=$row['role_id'];
		$_SESSION['login_department_id']=$row['department_id'];

		echo "Okay";
	}

	else{

		echo "Sorry";
	}

?>