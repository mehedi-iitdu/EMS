<!DOCTYPE html>
<html>
<head>
	<title>Add Employee</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<?php

		include 'header.php';

		include 'db/db_connect.php';
	?>

	<div class="container">

		<div id="registration">

	            <form id="registration-form" class="form-horizontal" role="form">

	                <h2>Add New Employee</h2>
	                <div class="form-group">
	                    <label for="name" class="col-sm-3 control-label">Full Name</label>
	                    <div class="col-sm-9">
	                        <input type="text" id="name" name="name" placeholder="Full Name" class="form-control" autofocus data-required="true">
	                    </div>
	                </div>

	                <div class="form-group">
	                    <label for="email" class="col-sm-3 control-label">Email</label>
	                    <div class="col-sm-9">
	                        <input type="email" id="email" name="email" placeholder="Email" class="form-control" data-required="true">
	                    </div>
	                </div>

	                <div class="form-group">
	                    <label for="password" class="col-sm-3 control-label">Password</label>
	                    <div class="col-sm-9">
	                        <input type="password" id="password" name="password" placeholder="Password" class="form-control" data-required="true">
	                    </div>
	                </div>

	                <div class="form-group">
	                    <label for="date_of_birth" class="col-sm-3 control-label">Date of Birth</label>
	                    <div class="col-sm-9">
	                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" data-required="true" data-required="true">
	                    </div>
	                </div>
	                
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Gender</label>
	                    <div class="col-sm-6">
	                        <div class="row">
	                            <div class="col-sm-4">
	                                <label class="radio-inline">
	                                    <input type="radio" id="gender" name="gender" value="Female">Female
	                                </label>
	                            </div>
	                            <div class="col-sm-4">
	                                <label class="radio-inline">
	                                    <input type="radio" id="gender" name="gender" value="Male">Male
	                                </label>
	                            </div>
	                            <div class="col-sm-4">
	                                <label class="radio-inline">
	                                    <input type="radio" id="gender" name="gender" value="Others">Others
	                                </label>
	                            </div>
	                        </div>
	                    </div>
	                </div>

	                <div class="form-group">
	                	<label for="department_id" class="control-label col-sm-3">Department</label>
	                	<div class="col-sm-9">
	                		<select class="form-control" id="department_id" name="department_id" data-required="true">

	                					<option value="">---Select Department---</option>

	                					<?php

	                						$sql = "SELECT * FROM department";
	                						$result = mysqli_query($connection, $sql);
	                						while ($row = mysqli_fetch_assoc($result)) {
	                							echo '<option value="'.$row['department_id'].'">'.$row['department_name'].'</option>';
	                						}

	                					?>

	                				</select>
	                	</div>
	                </div>


	                <div class="form-group">
	                    <label for="salary" class="col-sm-3 control-label">Salary</label>
	                    <div class="col-sm-9">
	                        <input type="number" id="salary" name="salary" class="form-control" data-required="true">
	                    </div>
	                </div>


	                <div class="form-group">
	                	<label for="role_id" class="control-label col-sm-3">Role</label>
	                	<div class="col-sm-9">
	                		<select class="form-control" id="role_id" name="role_id" data-required="true">

	                					<option value="">---Select Role---</option>

	                					<?php

	                						$sql = "SELECT * FROM role";
	                						$result = mysqli_query($connection, $sql);
	                						while ($row = mysqli_fetch_assoc($result)) {
	                							echo '<option value="'.$row['role_id'].'">'.$row['role_name'].'</option>';
	                						}

	                					?>

	                				</select>
	                	</div>
	                </div>

	                <div class="form-group">
	                    <label for="photo" class="col-sm-3 control-label">Photo</label>
	                    <div class="col-sm-9">
	                        <input type="file" id="photo" name="photo" class="form-control">
	                    </div>
	                </div>

	                <div class="form-group">
	                    <div class="col-sm-9 col-sm-offset-3">
	                        <button type="submit" class="btn btn-primary btn-block">Confirm</button>
	                    </div>
	                </div>

	            </form> 

	            </div>

	        </div> 

</body>

<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<script type="text/javascript">

	var allowed_file_size = "1048576"; 
	var allowed_files = ['image/png', 'image/gif', 'image/jpeg', 'image/pjpeg'];
	var border_color = "#C2C2C2";

	$("#registration-form").submit(function(e){
	    e.preventDefault();  
	    proceed = true; 
	    
	    $($(this).find("input[data-required=true], textarea[data-required=true]")).each(function(){
	            if(!$.trim($(this).val())){ 
	                $(this).css('border-color','red');    
	                proceed = false; 
	            }

	            var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
	            if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
	                $(this).css('border-color','red');   
	                proceed = false;              
	            }

	    }).on("input", function(){ 
	         $(this).css('border-color', border_color);
	    });
	    

	    if(window.File && window.FileReader && window.FileList && window.Blob){
	        var total_files_size = 0;
	        $(this.elements['photo'].files).each(function(i, ifile){
	            if(ifile.value !== ""){ 
	                if(allowed_files.indexOf(ifile.type) === -1){ 
	                    alert( ifile.name + " is unsupported file type!");
	                    proceed = false;
	                }
	             total_files_size = total_files_size + ifile.size; 
	            }
	            else{
	            	alert("Please select an image file");
	            }
	        }); 
	       if(total_files_size > allowed_file_size){ 
	            alert( "Make sure total file size is less than 1 MB!");
	            proceed = false;
	        }
	    }
	    
	    
	    if(proceed){

	        $.ajax({

	        		url: "backend/register.php",
	        		type: "POST",
	        		data:  new FormData(this),
	        		contentType: false,
	        		cache: false,
	        		processData:false,
	        		success: function(data){

	        			if(data=="Okay"){
	        				alert("Employee Added!");
	        				window.location.replace("http://localhost/EMS/index.php");
	        			}

	        			else{
	        				
	        				alert("Sorry. Try With another Email...!");
	        			}

	        		}	        
	        		
	        });
	    }
	});


</script>

</html>