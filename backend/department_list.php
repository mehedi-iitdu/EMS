<?php

	session_start();

	include '../db/db_connect.php';

	$list = '<table class="table">
		<tbody>
		<tr>
			<th>#</th>
			<th>Department Name</th>';

			if($_SESSION['login_role_id']==1){

				$list .= '<th>Actions</th>';
			}

		$list .='</tr>';

	$sql = "SELECT * FROM department";
	$result = mysqli_query($connection, $sql);

	$serial = 0;
	while ($row = mysqli_fetch_assoc($result)) {

		$serial = $serial+1;

		$list .= '<tr>
					<td>'.$serial.'</td>
					<td><input type="hidden" id="department_id-'.$row['department_id'].'" value="'.$row['department_name'].'">'.$row['department_name'].'</td>';

				if($_SESSION['login_role_id']==1){

		    			$list .= '<td>

		    			<button class="btn btn-primary" onclick="edit_department('.$row['department_id'].')">Edit</button>
		    			<button class="btn btn-danger" onclick="delete_department('.$row['department_id'].')">Delete</button>

		    			</td>';
		    		}

		    	$list .='</tr>';

	}



	$list .= '</tbody>
				</table>';

	echo $list;

?>