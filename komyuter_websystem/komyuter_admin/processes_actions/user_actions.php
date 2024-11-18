<?php
include '../classes/user_class.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id= isset($_GET['id']) ? $_GET['id'] : '';
$status= isset($_GET['status']) ? $_GET['status'] : '';

switch($action){
	case 'new':
        create_new_user();
	break;
    case 'update':
        update_user();
	break;
    case 'deactivate':
        deactivate_user();
	break;
    case 'status':
        change_user_status();
	break;
    case 'updatepassword':
        change_user_password();
	break;
    case 'updateemail':
        change_user_email();
	break;
}

function create_new_user(){
	$user = new User();
   
    $firstname = ucwords($_POST['fname']);
    $lastname = ucwords($_POST['lname']);
    $email = $_POST['email'];
    $contactno = ucwords($_POST['contactno']);
    $password = ($_POST['password']);
    $confirmpassword = $_POST['confpassword'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $access = $_POST['access'];
    $status = $_POST['status'];
    $result = $user->add_new_user($firstname,$lastname,$email, $password, $contactno, $city, $address, $access, $status);
    if($result){
        $id = $user->get_user_id($email);
        //header('location: ../index.php?page=settings&subpage=profile&id='.$id);
    }
}