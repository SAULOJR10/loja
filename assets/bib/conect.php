<?php
$servername = "localhost";
$database = "ecommerce";
$username = "root";
$password = "MrLiP@5";
// Create connection
$connect = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
?>