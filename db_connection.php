<?php
// Database connection settings
$servername = "localhost";
$username = "root"; //MySQL username
$password = ""; //MySQL password
$database = "resourcedb"; //MySQL database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
