<!DOCTYPE html>
<html>
<head>
	<title>Employee Profile</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php 

	session_start();

	if (!isset($_SESSION['login_id'])) {
        header ("Location: http://localhost/project/login.php");
    }
 ?>

<?php

  include 'header.php';
?>

<?php
    
    include 'db/db_connect.php';
?>

<div class="container">

	<?php

		$employee_id = $_SESSION['login_id'];
		
    $sql = "SELECT * FROM employee WHERE employee_id = '$employee_id'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);

	?>

  <div class="col-sm-6">

    <table class="table">

      <tr>
        <th>Photo</th>
        <td><img style="height: 50px; width: 50px;" src="uploads/<?php echo $row['photo'];?>"></td>  
      </tr>    

      <tr>
        <th>Name</th>
        <td><?php echo $row['name'];?></td>  
      </tr>

      <tr>
        <th>Email</th>
        <td><?php echo $row['email'];?></td>  
      </tr>

      <tr>
        <th>Date of Birth</th>
        <td><?php echo $row['date_of_birth'];?></td>  
      </tr>

      <tr>
        <th>Gender</th>
        <td><?php echo $row['gender'];?></td>  
      </tr>

      <tr>
        <th>Salary</th>
        <td><?php echo $row['salary'];?></td>  
      </tr>

      <tr>
        <th>Department</th>

        <?php
                $department_id = $row['department_id'];
                $sql2 = "SELECT * FROM department WHERE department_id = '$department_id'";
                $result2 = mysqli_query($connection, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
        ?>

        <td><?php echo $row2['department_name'];?></td>  
      </tr>

  </table>

  <button onclick="show_modal()" class="btn btn-primary pull-right">Change Password</button>

  </div>


  <div class="modal fade" id="change_password_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Change Password</h4>
            </div>

            <div class="modal-body">

              <div class="form-group">
                <label for="old_password" class="control-label">Old Password</label>
                <input id="old_password" type="password" name="old_password" class="form-control" value="">
              </div>

              <div>
                <label for="new_password" class="control-label">New Password</label>
                <input id="new_password" type="password" name="new_password" class="form-control">
              </div>

              <div>
                <label for="confirm_password" class="control-label">Confirm Password</label>
                <input id="confirm_password" type="password" name="confirm_password" class="form-control">
              </div>

            </div>

            <div class="modal-footer">

              <button type="button" onclick="save_password()" class="btn btn-success" data-dismiss="modal">Save</button>
              <button type="button" onclick="hide_modal()" class="btn btn-danger" data-dismiss="modal">Cancel</button>

            </div>
          </div>
          
        </div>
      </div>
    <!-- Modal End -->
	
</div>

</body>

<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<script type="text/javascript">
  
function show_modal(){

    $("#change_password_modal").modal("show");

}

function hide_modal(){

  $("#change_password_modal").modal("hide");
}

function save_password(){

  var old_password = $("#old_password").val();
  var new_password = $("#new_password").val();
  var confirm_password = $("#confirm_password").val();

  var proceed = true;

  if (old_password.length==0 || new_password.length==0 || confirm_password.length==0) {

    alert("Password can't be empty!");

    proceed = false;
  }

  if(new_password != confirm_password){

    alert("New Password and Confirm Password didn't match...");

    proceed = false;
  }

  if (proceed) {

      $.post("backend/change_password.php",{old_password:old_password, confirm_password:confirm_password}, function(result){

          if (result == "Okay") {

              alert("Password changed successfully");
          }

          else{

            alert("Something is wrong...");
          }
      });
  }
}

</script>

</html>