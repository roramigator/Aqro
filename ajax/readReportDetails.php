<?php
// include Database connection file
include("db_connection.php");

// check request
if(isset($_POST['email']) && isset($_POST['email']) != "")
{
    // get User ID
    $email_user = $_POST['email'];

    // Get User Details
    $query = "SELECT * FROM reports WHERE email_user = '$email_user'";
    if (!$result = mysqli_query($db, $query)) {
        exit(mysqli_error());
    }
    $response = array();
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response = $row;
        }
    }
    else
    {
        $response['status'] = 200;
        $response['message'] = "Datos no encontrados!";
    }
    // display JSON data
    echo json_encode($response);
}
else
{
    $response['status'] = 200;
    $response['message'] = "Peticion Erronea!";
}