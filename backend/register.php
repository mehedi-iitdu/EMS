<?php

	include '../db/db_connect.php';
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$date_of_birth = $_POST['date_of_birth'];
	$gender = $_POST['gender'];
	$photo = $_FILES['photo']['name'];

	$targetdir = '../uploads/';   
	$targetfile = $targetdir.$_FILES['photo']['name'];
	$photo_upload_confirmation = move_uploaded_file($_FILES['photo']['tmp_name'], $targetfile);


	$sql = "SELECT email FROM employee WHERE email='$email'";
	$result = mysqli_query($connection, $sql);

	if (mysqli_fetch_assoc($result)) {
		echo 'Sorry';
	}

	else{


		$sql = "INSERT INTO employee (email, name, date_of_birth, gender, photo) VALUES ('$email', '$name', '$date_of_birth', '$gender', '$photo')";
		$result = mysqli_query($connection, $sql);


		if ($photo_upload_confirmation && $result) {

	    	echo "Okay";
	  	} 

		else { 
	    
	   		echo "Sorry";
		}
	}

?>