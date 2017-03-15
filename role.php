<!DOCTYPE html>
<html>
<head>
	<title>Role</title>
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
 			<h2>Role List</h2>
 			<span id="role-list"></span>
 		</div>

 		<?php

 			if($_SESSION['login_role_id']==1){

 		 	echo '<div class="col-sm-6 add-role">
	 				<h2>Add Role</h2>
	 					<form id="add-role-form">
	 					<label for="role-name">Role Name</label>
	 					<input type="text" name="role-name" id="role-name">
	 					<input type="submit" name="submit" value="Save">
	 				</form>
 				</div>';
 			}
 		?>

 	<!-- Modal -->
 	  <div class="modal fade" id="role_edit_modal" role="dialog">
 	    <div class="modal-dialog">
 	    
 	      <!-- Modal content-->
 	      <div class="modal-content">
 	        <div class="modal-header">
 	          <button type="button" class="close" data-dismiss="modal">&times;</button>
 	          <h4 class="modal-title">Edit Role Name</h4>
 	        </div>
 	        <div class="modal-body">
 	          <div class="form-group">
 	          	<label for="edited_role_name" class="control-label"></label>
 	          	<input id="edited_role_name" type="text" name="edited_role_name" class="form-control" value="">
 	          	<input id="edited_role_id" type="hidden" name="edited_role_id" value="">
 	          </div>
 	        </div>
 	        <div class="modal-footer">
 	          <button type="button" onclick="save_edited_role_name()" class="btn btn-success" data-dismiss="modal">Save</button>
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
		show_role_list();
	});

	$("#add-role-form").submit(function(e){
		e.preventDefault();

		var role_name = $("#role-name").val();

		if(role_name.length !=0 ){
			
			$.post("backend/save_role.php",{role_name:role_name}, function(result){
				alert(result);
				show_role_list();
			});
		}

	});

	function show_role_list() {
		$.post("backend/role_list.php",{},function(result){
			$("#role-list").html(result);
		});
	}

	function edit_role(role_id){

		var role_name = $("#role_id-"+role_id).val();

		$("#edited_role_name").val(role_name);
		$("#edited_role_id").val(role_id);

		$("#role_edit_modal").modal('show');
	}

	function save_edited_role_name(){

		var edited_role_id = $("#edited_role_id").val();
		var edited_role_name = $("#edited_role_name").val();

		$.post("backend/update_role.php",{edited_role_id:edited_role_id, edited_role_name:edited_role_name}, function(result){
				if(result=="Okay"){
					alert("Role Name Edited");
					show_role_list();
				}
		});
	}

	function hide_modal(){

		$("#edited_role_name").val("");
		$("#edited_role_id").val("");
		$("#role_edit_modal").modal('hide');
	}

	function delete_role(role_id){

		$.post("backend/delete_role.php",{role_id:role_id}, function(result){

			if (result=="Okay") {
				show_role_list();
				alert("Role deleted");
			}
		});
	}

</script>

</html>