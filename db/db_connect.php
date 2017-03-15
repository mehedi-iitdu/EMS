<?php

	$host = "127.0.0.1";
	$username = "root";
	$password = "";
	$db_name = "ems";
	$connection = mysqli_connect($host, $username, $password) or die("Host not connected");
	mysqli_select_db($connection, $db_name) or die("DB not selected");
	
?>