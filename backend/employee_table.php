<?php

	session_start();

	include '../db/db_connect.php';

	$name = $_POST['name'];
	$department_name = $_POST['department_name'];
	$gender = $_POST['gender'];

	$list = '<table id="myTable" class="table">
		<thead>
		<tr>
			<th>Photo</th>
			<th data-sort="string">Name</th>
			<th data-sort="string">Email</th>
			<th data-sort="string">Gender</th>
			<th data-sort="int">Salary</th>
			<th data-sort="string">Department</th>
			<th data-sort="string">Role</th>';

		if($_SESSION['login_role_id']==1){
			$list .= '<th>Actions</th>';
		}
		
		$list .= '</tr>
					</thead>

					<tbody>';


	$sql = "SELECT * FROM employee WHERE name LIKE '%$name%' AND gender LIKE '$gender%'";

	if(!empty($department_name)){

		$sql3 = "SELECT department_id FROM department WHERE department_name LIKE '$department_name%' LIMIT 1";
		$result3 = mysqli_query($connection, $sql3);
		$row3 = mysqli_fetch_assoc($result3);

		if (!empty($row3['department_id'])) {

			$department_id = $row3['department_id'];
			$sql .= "AND department_id = '$department_id'";
		}
		
	}

	$result = mysqli_query($connection, $sql);
	while ($row = mysqli_fetch_assoc($result)) {
		    
		$list.= '<tr>
					<td><img src="uploads/'.$row['photo'].'" style="height: 50px; width: 50px"></td>
					<td>'.$row['name'].'</td>
		    		<td>'.$row['email'].'</td>
		    		<td>'.$row['gender'].'</td>
		    		<td>'.$row['salary'].'</td>';

		    		$department_id = $row['department_id'];

		    		$sql2 = "SELECT * FROM department WHERE department_id='$department_id'";
		    		$result2 = mysqli_query($connection, $sql2);
		    		$row2 = mysqli_fetch_assoc($result2);

		    		$list .= '<td>'.$row2['department_name'].'</td>';

		    		$role_id = $row['role_id'];

		    		$sql2 = "SELECT * FROM role WHERE role_id='$role_id'";
		    		$result2 = mysqli_query($connection, $sql2);
		    		$row2 = mysqli_fetch_assoc($result2);

		    		$list .= '<td>'.$row2['role_name'].'</td>';

		    		if($_SESSION['login_role_id']==1){

		    			$list .= '<td>

		    			<button class="btn btn-primary" onclick="edit_employee('.$row['employee_id'].')">Edit</button>';
		    			
		    			if($row['role_id']!=1){

		    				$list .= '<button class="btn btn-danger" onclick="delete_employee('.$row['employee_id'].')">Delete</button>';
		    			}

		    			$list .= '</td>';
		    		}

		    		$list .= '</tr>';                                   
	}

	$list .= '</tbody>
				</table>';

	echo $list;



?>