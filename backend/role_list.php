<?php
	
	session_start();

	include '../db/db_connect.php';

	$list = '<table class="table">
		<tbody>
		<tr>
			<th>#</th>
			<th>Role Name</th>';

			if($_SESSION['login_role_id']==1){

				$list .= '<th>Actions</th>';
			}

		$list .='</tr>';

	$sql = "SELECT * FROM role";
	$result = mysqli_query($connection, $sql);

	$serial = 0;
	while ($row = mysqli_fetch_assoc($result)) {

		$serial = $serial+1;

		$list .= '<tr>
					<td>'.$serial.'</td>
					<td class="btn btn-default custom-button" onclick="employee_list_by_role('.$row['role_id'].')"><input type="hidden" id="role_id-'.$row['role_id'].'" value="'.$row['role_name'].'">'.$row['role_name'].'</td>';

					if($_SESSION['login_role_id']==1 && $row['role_id']!=1){

			    			$list .= '<td>

			    			<button class="btn btn-primary" onclick="edit_role('.$row['role_id'].')">Edit</button>
			    			<button class="btn btn-danger" onclick="delete_role('.$row['role_id'].')">Delete</button>

			    			</td>';
			    		}

			    	$list .='</tr>';

	}

	$list .= '</tbody>
				</table>';

	echo $list;

?>