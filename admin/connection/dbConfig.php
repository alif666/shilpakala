<?php
//db details



//for localhost

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'shilpakaladb';


//for server



//for demos
/*
$dbHost = "localhost";
$dbUsername = "ctrlnweb_kala ";
$dbPassword = "T@uhed_controlN";
$dbName = "ctrlnweb_shilpakaladb";
*/





//Connect and select the database
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>