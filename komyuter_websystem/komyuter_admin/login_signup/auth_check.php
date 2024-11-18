<?php
session_start(); 

if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header("Location: /komyuter_admin/login_signup/log_in_up.php?login");
    exit; 
}
?>