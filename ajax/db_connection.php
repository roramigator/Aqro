<?php

// Connection variables 
$host = "127.0.0.1"; // MySQL host name eg. localhost
$user = "root"; // MySQL user. eg. root ( if your on localserver)
$password = "rootdb"; // MySQL user password  (if password is not set for your root user then keep it empty )
$database = "aqro"; // MySQL Database name

$db = mysqli_connect($host, $user, $password, $database);

// Connect to MySQL Database 
//$db = mysql_connect($host, $user, $password) or die("Could not connect to database");

// Select MySQL Database 
//mysql_select_db($database, $db);

?>