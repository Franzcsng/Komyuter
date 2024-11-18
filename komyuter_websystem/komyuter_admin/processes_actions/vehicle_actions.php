<?php
include '../classes/vehicle_class.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id= isset($_GET['id']) ? $_GET['id'] : '';
$status= isset($_GET['status']) ? $_GET['status'] : '';

switch($action){
	case 'new':
        create_new_vehicle();
	break;
}

function create_new_vehicle(){
	$vehicle = new Vehicle();
   
    $cooperative = ucwords($_POST['cooperative']);
    $platenumber = ucwords($_POST['platenumber']);
    $route = $_POST['route'];
    $status = $_POST['status'];
    $gpsdevice = $_POST['gpsdevice'];
    $new_vehicle_id = $vehicle->add_vehicle($cooperative, $gpsdevice, $route, $platenumber, $status);
    if($new_vehicle_id){
        header('location: ../index.php?page=vehicles&subpage=vehicledetails&id='.$new_vehicle_id);
    }
}