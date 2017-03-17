<?php

	include '../db/db_connect.php';
	
	$employee_id = $_POST['employee_id'];

	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$date_of_birth = $_POST['date_of_birth'];
	$gender = $_POST['gender'];
	$department_id = $_POST['department_id'];
	$salary = $_POST['salary'];
	$role_id = $_POST['role_id'];
	$photo = $_FILES['photo']['name'];

	if(!empty($photo)){

		$targetdir = '../uploads/';   
		$targetfile = $targetdir.$_FILES['photo']['name'];
		$photo_upload_confirmation = move_uploaded_file($_FILES['photo']['tmp_name'], $targetfile);

		$sql = "UPDATE employee SET name = '$name', email = '$email', password = '$password',  date_of_birth='$date_of_birth', gender = '$gender', salary='$salary', department_id='$department_id', role_id='$role_id', photo = '$photo' WHERE employee_id='$employee_id'";

	}

	else{

		$sql = "UPDATE employee SET name = '$name', email = '$email', password = '$password',  date_of_birth='$date_of_birth', gender = '$gender', salary='$salary', department_id='$department_id', role_id='$role_id' WHERE employee_id='$employee_id'";
	}	

	$result = mysqli_query($connection, $sql);


	if ($result) {

	    echo "Okay";
	  } 

	else { 
	    
	    echo "Sorry";
	}

?>