<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "kaspi";

$conn = mysqli_connect($servername, $username, $password, $database);



if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}





