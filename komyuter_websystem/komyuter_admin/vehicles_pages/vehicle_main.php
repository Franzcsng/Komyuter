<div class="vehicle-nav">
    <a href="index.php?page=vehicles&subpage=vehicles">Vehicles</a>
    

    
<?php if($user_access === 2 || $user_access === 1){ ?>

    <div class="vehicle-nav-vl"></div>
    <a href="index.php?page=vehicles&subpage=newvehicle">Add New Vehicle</a>

<?php } else { } ?>

</div>

<div class="vehicle-page-container">

        <?php   
            switch ($subpage) {
            case 'vehicles':
                require_once 'vehicle_list.php';
                break;
            case 'newvehicle':
                require_once 'add_vehicle.php';
                break;
            case 'vehicledetails':
                require_once 'vehicle_details.php';
                break;
            default:
                require_once 'vehicle_list.php';
                break;
            }
        ?>

</div>