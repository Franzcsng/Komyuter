<?php
    include '../classes/user_class.php';
    $user = new User();

    if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['con_password'])){

        function validateInput($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $fname = validateInput($_POST['fname']);
        $lname = validateInput($_POST['lname']);
        $email = validateInput($_POST['email']);
        $password = validateInput($_POST['password']);
        $con_password = validateInput($_POST['con_password']);
    

        if(empty($fname) || empty($lname) || empty($email) || empty($password) || empty($con_password)){
            header("Location: log_in_up.php?signup=error");
        } else if ($password !== $con_password){
            header("Location: log_in_up.php?signup=mismatch");
        } else {
            $user->new_user($fname, $lname, $email, $password);
            header("Location: log_in_up.php?login");
        }

    } else {
        header("Location: log_in_up.php?signup=error");
    }

?>