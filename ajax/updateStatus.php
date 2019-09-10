<?php
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    include("db_connection.php");

    // get user id and status
    $user_id = $_POST['id'];
    $status = $_POST['status'];

    // update Status
    if ($status == 1) {
    	$query = "UPDATE users SET status = 0 WHERE id = '$user_id'";
    }else { 
    	$query = "UPDATE users SET status = 1 WHERE id = '$user_id'";
    }
    if (!$result = mysqli_query($db, $query)) {
        exit(mysqli_error());
    }
}
?>