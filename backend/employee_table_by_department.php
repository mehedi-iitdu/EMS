<?php

	include '../db/db_connect.php';

	$department_id = $_POST['department_id'];

	$list = '<h2>Employee List</h2>

			<table id="myTable" class="table">
				<thead>
				<tr>
					<th>Photo</th>
					<th data-sort="string">Name</th>
					<th data-sort="string">Email</th>
					<th data-sort="string">Gender</th>
					<th data-sort="int">Salary</th>
				</tr>
				</thead>

		<tbody>';

	$sql = "SELECT * FROM employee WHERE department_id = '$department_id'";
	$result = mysqli_query($connection, $sql);

	while ($row = mysqli_fetch_assoc($result)) {
		
		$list.= '<tr>
					<td><img src="uploads/'.$row['photo'].'" style="height: 50px; width: 50px"></td>
					<td>'.$row['name'].'</td>
		    		<td>'.$row['email'].'</td>
		    		<td>'.$row['gender'].'</td>
		    		<td>'.$row['salary'].'</td>
		    	</tr>';
	}

	$list .= '</tbody>
				</table>';

	echo $list;

?>