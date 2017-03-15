<?php

	include '../db/db_connect.php';
	
	$employee_id = $_POST['employee_id'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$date_of_birth = $_POST['date_of_birth'];
	$department_id = $_POST['department_id'];
	$salary = $_POST['salary'];
	$role_id = $_POST['role_id'];
	

	$sql = "UPDATE employee SET name = '$name', email = '$email', date_of_birth='$date_of_birth', salary='$salary', department_id='$department_id', role_id='$role_id' WHERE employee_id='$employee_id'";

	$result = mysqli_query($connection, $sql);


	if ($result) {

	    echo "Okay";
	  } 

	else { 
	    
	    echo "Sorry";
	}

?>