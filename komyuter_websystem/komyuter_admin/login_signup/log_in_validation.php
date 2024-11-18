<?php
session_start();

include '../classes/user_class.php';
$user = new User();

if (isset($_POST['email']) && isset($_POST['password'])) {

    function validateInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validateInput($_POST['email']);
    $password = validateInput($_POST['password']);

    error_log("Email: $email");
    error_log("Password: $password");

    if (empty($email) && empty($password)) {
        header("Location: log_in_up.php?login=error");
        exit();
    } else if (empty($email)) {
        header("Location: log_in_up.php?login=erroremail");
        exit();
    } else if (empty($password)) {
        header("Location: log_in_up.php?login=errorpass");
        exit();
    } else {
        if ($user->check_login($email, $password)) {
            header("Location: /komyuter_admin/index.php?page=dashboard");
            exit();
        } else {
            error_log("Login failed for email: " . $email);
            header("Location: log_in_up.php?login=error");
            exit();
        }
    }
} else {
    header("Location: log_in_up.php?login=error");
    exit();
}
?>