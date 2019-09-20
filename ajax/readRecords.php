<?php
	// include Database connection file
	include("db_connection.php");

	// Design initial table header
	$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Last name</th>
							<th>Email</th>
							<th>Status</th>
							<th>Options</th>
						</tr>';

	$query = "SELECT * FROM users";

	if (!$result = mysqli_query($db, $query)) {
        exit(mysqli_error());
    }

    // if query results contains rows then featch those rows
    if(mysqli_num_rows($result) > 0)
    {
    	while($row = mysqli_fetch_assoc($result))
    	{
    		$data .= '<tr>
				<td>'.$row['barcode'].'</td>
				<td>'.$row['first_name'].'</td>
				<td>'.$row['last_name'].'</td>
				<td>'.$row['email'].'</td>
				<td>';

			if ($row['status'] == 1) {
    			$data .= '<button onclick="UpdateStatus('.$row['id'].', 1)" class="btn btn-warning">Pending</button>';
    			$data .= '<button onclick="PrintTicket('.$row['id'].')" class="btn"><span class="glyphicon glyphicon-info-sign"></span></button>';
    		}else{
    			$data .= '<button onclick="UpdateStatus('.$row['id'].', 0)" class="btn btn-primary">Completed</button>';
    		}

			$data .= '</td>
				<td>
					<button onclick="PrintTicket('.$row['id'].')" class="btn btn-default"><span class="glyphicon glyphicon-print"></span></button>
					<button onclick="GetUserDetails('.$row['id'].')" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></button>
					<button onclick="DeleteUser('.$row['id'].')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
				</td>
    		</tr>';
    	}
    }
    else
    {
    	// records now found
    	$data .= '<tr><td colspan="6">No record were found!</td></tr>';
    }

    $data .= '</table>';

    echo $data;
?>
