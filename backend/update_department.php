<?php

	include '../db/db_connect.php';
	
	$edited_department_id = $_POST['edited_department_id'];
	$edited_department_name = $_POST['edited_department_name'];
	

	$sql = "UPDATE department SET department_name = '$edited_department_name' WHERE department_id='$edited_department_id'";

	$result = mysqli_query($connection, $sql);


	if ($result) {

	    echo "Okay";
	  } 

	else { 
	    
	    echo "Sorry";
	}

?>