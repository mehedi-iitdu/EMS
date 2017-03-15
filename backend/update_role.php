<?php

	include '../db/db_connect.php';
	
	$edited_role_id = $_POST['edited_role_id'];
	$edited_role_name = $_POST['edited_role_name'];
	

	$sql = "UPDATE role SET role_name = '$edited_role_name' WHERE role_id='$edited_role_id'";

	$result = mysqli_query($connection, $sql);


	if ($result) {

	    echo "Okay";
	  } 

	else { 
	    
	    echo "Sorry";
	}

?>