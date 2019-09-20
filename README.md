# Aqro: CRUD in PHP & MariaDB
Save client-service information:
- Name & last name
- Email
- Description of the service given
- Price for service

## Configure DB
1. Create the database **aqro**.
```
MariaDB [(none)]> CREATE DATABASE aqro;
```
2. Generate table **users** using the `aqro.sql` file.
```
MariaDB [(none)]> USE aqro;
MariaDB [(aqro)]> SOURCE <path_to_Aqro>/db/aqro.sql
```
3. Modify file `db_connection.php`.
```
<?php
[...]
$user = "root";       //Modify the variable to match DB username
$password = "rootdb"; //Modify the variable to match DB password
[...]
?>
```

## Credits
* Johan Lindell: [JsBarcode](https://lindell.me/JsBarcode)
* @MrRio: [jsPDF](http://rawgit.com/MrRio/jsPDF/master/docs)