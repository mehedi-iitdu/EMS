<?php 
	
	session_start();

	include '../db/db_connect.php';

	if(session_status()!=NULL){
		session_destroy();
		echo "Okay";
	}

 ?>