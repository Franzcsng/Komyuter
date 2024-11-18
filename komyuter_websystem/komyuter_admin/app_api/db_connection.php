<?php

function dbconnection(){
    $con=mysqli_connect("localhost", "root", "","komyuter_db");
    return $con;
}

?>