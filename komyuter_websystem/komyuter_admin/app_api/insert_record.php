<?php

include("db_connection.php");
$con = dbconnection();
echo "Connected to database: " . $con->query("SELECT DATABASE()")->fetch_row()[0];

// Set the header to JSON
if (isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "INSERT INTO `app_user_tbl`(`f_name`, `l_name`, `email`, `password`) VALUES ('$fname','$lname','$email','$password')";
    $exe = mysqli_query($con, $query);

    $arr = [];
    if ($exe) {
        $arr["success"] = "true";
    } else {
        $arr["success"] = "false";
        $arr["error"] = mysqli_error($con); // Include database error message
    }
} else {
    $arr["success"] = "false";
    $arr["error"] = "Missing required fields"; // Additional debugging information
}

header('Content-Type: application/json'); // Ensure JSON response
echo json_encode($arr);

?>