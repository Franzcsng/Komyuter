<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "komyuter_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);  // Will show connection error if any
}


return $conn;
?>