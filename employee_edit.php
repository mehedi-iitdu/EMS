<!DOCTYPE html>
<html>
<head>
	<title>Employee Edit</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php 
	session_start();

	$employee_id = $_GET['employee_id'];

	if (!isset($_SESSION['login_id'])) {
        header ("Location: http://localhost/EMS/login.php");
    }
 ?>

<?php

	include 'header.php';
?>
 
<?php
    
    include 'db/db_connect.php';

    $sql = "SELECT * FROM employee WHERE employee_id = '$employee_id'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);

?>

<div class="container">

	<h2>Edit Employee</h2>

	<form class="form-horizontal" id="edit-employee-form">

	<input type="hidden" name="employee_id" value="<?php echo $row['employee_id'];?>">

		<div class="form-group">
			<label for="name" class="control-label col-sm-2">Name</label>
			<div class="col-sm-4">
				<input class="form-control" type="text" name="name" id="name" value="<?php echo $row['name'];?>">
			</div>
		</div>

		<div class="form-group">
			<label for="email" class="control-label col-sm-2">Email</label>
			<div class="col-sm-4">
				<input class="form-control" type="email" name="email" id="email" value="<?php echo $row['email'];?>">
			</div>
		</div>

		<div class="form-group">
			<label for="password" class="control-label col-sm-2">Password</label>
			<div class="col-sm-4">
				<input class="form-control" type="password" name="password" id="password" value="<?php echo $row['password'];?>">
			</div>
		</div>

		<div class="form-group">
			<label for="date_of_birth" class="control-label col-sm-2">Date of Birth</label>
			<div class="col-sm-4">
				<input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="<?php echo $row['date_of_birth'];?>">
			</div>
		</div>


		<div class="form-group">
		    <label class="control-label col-sm-2">Gender</label>
		    <div class="col-sm-6">
		        <div class="row">
		            <div class="col-sm-2">
		                <label class="radio-inline">
		                    <input type="radio" id="gender" name="gender" value="Female" <?php if($row['gender']=="Female"){echo "checked";}?> >Female
		                </label>
		            </div>
		            <div class="col-sm-2">
		                <label class="radio-inline">
		                    <input type="radio" id="gender" name="gender" value="Male" <?php if($row['gender']=="Male"){echo "checked";}?>  >Male
		                </label>
		            </div>
		            <div class="col-sm-2">
		                <label class="radio-inline">
		                    <input type="radio" id="gender" name="gender" value="Others" <?php if($row['gender']=="Others"){echo "checked";}?> >Others
		                </label>
		            </div>
		        </div>
		    </div>
		</div>

		<div class="form-group">
			<label for="department_id" class="control-label col-sm-2">Department</label>
			<div class="col-sm-4">
				<select class="form-control" id="department_id" name="department_id">

							<?php
								$department_id = $row['department_id'];
								$sql2 = "SELECT * FROM department WHERE department_id = '$department_id'";
								$result2 = mysqli_query($connection, $sql2);
								$row2 = mysqli_fetch_assoc($result2);

								echo '<option value="'.$row2['department_id'].'">'.$row2['department_name'].'</option>';

								$sql2 = "SELECT * FROM department WHERE department_id <> '$department_id'";
								$result2 = mysqli_query($connection, $sql2);
								while ($row2 = mysqli_fetch_assoc($result2)) {
									echo '<option value="'.$row2['department_id'].'">'.$row2['department_name'].'</option>';
								}

							?>

						</select>
			</div>
		</div>


		<div class="form-group">
			<label for="salary" class="control-label col-sm-2">Salary</label>
			<div class="col-sm-4">
				<input type="number" class="form-control" name="salary" id="salary" value="<?php echo $row['salary'];?>">
			</div>
		</div>


		<div class="form-group">
			<label for="role_id" class="control-label col-sm-2">Role</label>
			<div class="col-sm-4">
				<select class="form-control" id="role_id" name="role_id">

			<?php
				$role_id = $row['role_id'];
				$sql2 = "SELECT * FROM role WHERE role_id = '$role_id'";
				$result2 = mysqli_query($connection, $sql2);
				$row2 = mysqli_fetch_assoc($result2);

				echo '<option value="'.$row2['role_id'].'">'.$row2['role_name'].'</option>';

				$sql2 = "SELECT * FROM role WHERE role_id <> '$role_id'";
				$result2 = mysqli_query($connection, $sql2);
				while ($row2 = mysqli_fetch_assoc($result2)) {
					echo '<option value="'.$row2['role_id'].'">'.$row2['role_name'].'</option>';
				}

			?>
		</select>
			</div>
		</div>

		<div class="form-group">
		    <label for="photo" class="col-sm-2 control-label">Change Photo</label>
		    <div class="col-sm-4">
		        <input type="file" id="photo" name="photo" class="form-control">
		    </div>
		</div>

		<div class="form-group">
			<div class="col-sm-6" align="right">
				<input class="btn btn-success" type="submit" name="submit" value="Save Employee Information">
			</div>
		</div>

	</form>
	
</div>
</body>

<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>


<script type="text/javascript">

	$("#edit-employee-form").submit(function(e){
	    e.preventDefault();  
	    proceed = true; 
	    

	    if(proceed){ 

	        $.ajax({

	        		url: "backend/update_employee.php",
	        		type: "POST",
	        		data:  new FormData(this),
	        		contentType: false,
	        		cache: false,
	        		processData:false,
	        		success: function(data){

	        			if (data=="Okay") {
	        				alert("Employee Information Updated");
	        				window.location.replace("http://localhost/EMS/index.php");
	        			}
	        			else{
	        				alert("Sorry");
	        			}
	        		}	        
	        		
	        });
	    }
	});


</script>

</html>