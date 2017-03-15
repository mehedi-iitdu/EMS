<!DOCTYPE html>
<html>
<head>
	<title>Department</title>
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

 <div class="container">


 		<div class="col-sm-6">
 			<h2>Department List</h2>
 			<span id="department-list"></span>
 		</div>

 		<?php

 			if($_SESSION['login_role_id']==1){

 		 	echo '<div class="col-sm-6 add-deparment">
 			 		<h2>Add Department</h2>
 			 		<form id="add-deparment-form">
 			 			<label for="deparment-name">Department Name</label>
 			 			<input type="text" name="deparment-name" id="deparment-name">
 			 			<input type="submit" name="submit" value="Save">
 			 		</form>
 		 		</div>';
 			}
 		?>

 	<!-- Modal -->
 	  <div class="modal fade" id="department_edit_modal" role="dialog">
 	    <div class="modal-dialog">
 	    
 	      <!-- Modal content-->
 	      <div class="modal-content">
 	        <div class="modal-header">
 	          <button type="button" class="close" data-dismiss="modal">&times;</button>
 	          <h4 class="modal-title">Edit Department Name</h4>
 	        </div>
 	        <div class="modal-body">
 	          <div class="form-group">
 	          	<label for="edited_department_name" class="control-label"></label>
 	          	<input id="edited_department_name" type="text" name="edited_department_name" class="form-control" value="">
 	          	<input id="edited_department_id" type="hidden" name="edited_department_id" value="">
 	          </div>
 	        </div>
 	        <div class="modal-footer">
 	          <button type="button" onclick="save_edited_department_name()" class="btn btn-success" data-dismiss="modal">Save</button>
 	          <button type="button" onclick="hide_modal()" class="btn btn-danger" data-dismiss="modal">Cancel</button>
 	        </div>
 	      </div>
 	      
 	    </div>
 	  </div>

 </div>

</body>

<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<script type="text/javascript">
	
	$(document).ready(function(){
		show_department_list();
	});

	$("#add-deparment-form").submit(function(e){
		e.preventDefault();

		var department_name = $("#deparment-name").val();

		if(department_name.length !=0 ){
			
			$.post("backend/save_department.php",{department_name:department_name}, function(result){
				alert(result);
				show_department_list();
			});
		}

	});

	function show_department_list() {
		$.post("backend/department_list.php",{},function(result){
			$("#department-list").html(result);
		});
	}

	function edit_department(department_id){

		var department_name = $("#department_id-"+department_id).val();

		$("#edited_department_name").val(department_name);
		$("#edited_department_id").val(department_id);

		$("#department_edit_modal").modal('show');
	}

	function save_edited_department_name(){

		var edited_department_id = $("#edited_department_id").val();
		var edited_department_name = $("#edited_department_name").val();

		$.post("backend/update_department.php",{edited_department_id:edited_department_id, edited_department_name:edited_department_name}, function(result){
				if(result=="Okay"){
					alert("Department Name Edited");
					show_department_list();
				}
		});
	}

	function hide_modal(){

		$("#edited_department_name").val("");
		$("#edited_department_id").val("");
		$("#department_edit_modal").modal('hide');
	}

	function delete_department(department_id){

		$.post("backend/delete_department.php",{department_id:department_id}, function(result){

			if (result=="Okay") {
				show_department_list();
				alert("Department deleted");
			}
		});
	}

	function employee_list_by_department(department_id){

		alert(department_id);
	}

</script>

</html>