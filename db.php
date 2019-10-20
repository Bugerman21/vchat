<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vchat";

// Create connection
$mysql = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$mysql) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
