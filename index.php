<!DOCTYPE html>
<html>
<head>
	<title>Employee Information</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php 

	session_start();

	if (!isset($_SESSION['login_id'])) {
        header ("Location: http://localhost/EMS/login.php");
    }
 ?>
 
<?php
    
    include 'db/db_connect.php';
?>

<?php

	include 'header.php';
?>

<div class="container">

	<h2>Employee Information</h2>

	<form id="search-form" class="form-inline">
		<input class="form-control" type="text" id="name" name="name" placeholder="Search by Name">
		<input class="form-control" type="department_name" id="department_name" name="department_name" placeholder="Search by Department">
		<input class="form-control" type="text" id="gender" name="gender" placeholder="Search by Gender">
		<input class="form-control" type="submit" id="search" name="submit" value="Search">

		<a href="add_employee.php" class="btn btn-primary pull-right">Add New Employee</a>

	</form>


	<div id="employee-table">
		
	</div>
	
</div>

</body>

<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/stupidtable.js"></script>

<script type="text/javascript">

	$("#search-form").submit(function(e){
		e.preventDefault();
		show_employee_list();
	});

	function show_employee_list(){

		var name = $("#name").val();
		var department_name = $("#department_name").val();
		var gender = $("#gender").val();

		$.post("backend/employee_table.php",{name:name, department_name:department_name, gender:gender},function(result){
			/*alert(result);*/
			$("#employee-table").html(result);

			$("#myTable").stupidtable();
		});
	}

	$(document).ready(function(){

		show_employee_list();

	});

	function edit_employee(employee_id){

		window.location.replace("http://localhost/EMS/employee_edit.php?employee_id="+employee_id);
	}

	function delete_employee(employee_id){

		$.post("backend/delete_employee.php",{employee_id:employee_id}, function(result){

			if (result=="Okay") {

				show_employee_list();
				alert("Employee deleted");
			}
		});
	}

</script>

</html>