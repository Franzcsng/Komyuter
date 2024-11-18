<?php
include '../classes/cooperative_class.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id= isset($_GET['id']) ? $_GET['id'] : '';
$status= isset($_GET['status']) ? $_GET['status'] : '';

switch($action){
	case 'new':
        create_new_cooperative();
	break;
    case 'updatestatus':
        update_status();
	break;
}

function create_new_cooperative(){
	$cooperative = new Cooperative();
   
    $name = ucwords($_POST['coopname']);
    $city = ucwords($_POST['city']);
    $address = ucwords($_POST['address']);
 
    $new_cooperative_id = $cooperative->add_cooperative($name, $city, $address);
    if($new_cooperative_id){
        header('location: ../index.php?page=cooperatives&subpage=cooperativedetails&id='.$new_cooperative_id);
    }
}


function update_status(){
	$cooperative = new Cooperative();
    $id = $_POST['coopid'];
    $status = ucwords($_POST['status']);

    $cooperative_id = $cooperative->update_status($id, $status);
    if($cooperative_id){
        header('location: ../index.php?page=cooperatives&subpage=cooperativedetails&id='.$cooperative_id);
    }
}