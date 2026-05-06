<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$dbname = "drivehub";


$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>