<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root"; // MySQL username
$password = ""; // MySQL password
$dbname = "komyuter_db";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if latitude, longitude, speed, and gps_id are received
if (isset($_POST['gps_id']) && isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['speed'])) {
    $gps_id = $_POST['gps_id']; // Get GPS ID from the request
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $speed = $_POST['speed'];
    $date_added = date("Y-m-d H:i:s");

    // Prepare statements
    $stmt1 = $conn->prepare("INSERT INTO gps_live_tbl (gps_id, coordinate, speed, date_added) 
                              VALUES (?, POINT(?, ?), ?, ?)");
    $stmt1->bind_param("sssss", $gps_id, $latitude, $longitude, $speed, $date_added);

    $stmt2 = $conn->prepare("INSERT INTO gps_device_tbl (gps_id, status, date_added) 
                              VALUES (?, 1, ?) ON DUPLICATE KEY UPDATE status = 1");
    $stmt2->bind_param("ss", $gps_id, $date_added);

    // Execute statements
    if ($stmt1->execute() && $stmt2->execute()) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    // Close statements
    $stmt1->close();
    $stmt2->close();
} else {
    echo "No GPS data received";
}

$conn->close();
?>