<?php
include("db_connection.php");
$con=dbconnection();

$user_email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM app_user_tbl WHERE email = '".$user_email."' AND password = '".$password."'";

$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);

header('Content-Type: application/json');

if($count == 1){
    echo json_encode("Success");
}else{
    echo json_encode("Error");
}
?>