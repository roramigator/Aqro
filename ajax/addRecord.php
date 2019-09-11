<?php
	if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']))
	{
		// include Database connection file
		include("db_connection.php");

		// get values
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$sales = $_POST['sales'];
		$price = $_POST['price'];
		$barcode = $_POST['barcode'];

		$query = "INSERT INTO users(first_name, last_name, email, sales, price, barcode) VALUES('$first_name', '$last_name', '$email', '$sales', '$price', '$barcode')";

		if (!$result = mysqli_query($db, $query)) {
	        exit(mysqli_error());
	    }

	}
?>
