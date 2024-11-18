<?php
    $vehicle_data = $vehicleObj->get_vehicle($page_id);
    $cooperative_data = $cooperativeObj->get_cooperative($vehicle_data['cooperative_id']);
    $route_data = $routeObj->get_route($vehicle_data['route_id']);
?>

<div class="add-vehicle-section">

<div class="vehicle-header-text-container">
    <h2>
    Vehicle ID: <?php echo $page_id?> 
    </h2>
</div>

<form class="add-vehicle-form" method="POST" action="processes_actions/vehicle_actions.php?action=new">

    <div class="add-vehicle-form-container">

        <div class="vehicle-form-section">

            <div class="vehicle-select-options-section"> 

                <label class="select-label">Cooperative</label> </br>
                <select class="vehicle-level-options" disabled>
                    <option value=""><?php echo $cooperative_data['cooperative_name'];?></option >                  
                </select>

            </div>

            <label>Plate Number</label> </br>
            <input type="text" value="<?php echo $vehicle_data['license_num'];?> " disabled>

            <label>Route</label> </br>
            <select class="vehicle-level-options" disabled>
            <option value=""><?php echo $route_data['route_name'];?></option >
                
            </select>


        </div>

        <div class="vehicle-form-section">

        <div class="vehicle-select-options-section"> 

        <label class="select-label">Vehicle Status</label> </br>

            <select class="vehicle-level-options" name="status">
                <option value="<?php echo $vehicle_data['status'];?>" selected>
                    
                    <?php if($vehicle_data['status'] === 0){
                        echo "Active";
                    } else if ($vehicle_data['status'] === 1){
                        echo "Decomissioned";
                    } else if ($vehicle_data['status'] === 2){
                        echo "Maintenance";
                    }
                    
                    ?>

                </option>

                <option value="0">Active</option>
                <option value="1">Decomissioned</option>
                <option value="2">Maintenance</option>
            </select>

            <label class="select-label">GPS Device</label> </br>

            <select class="vehicle-level-options" name="gpsdevice">
            <option value="<?php echo $vehicle_data['gps_id'];?>" selected>
            <?php foreach ($unassignedDevices as $device): ?>
                <option value="<?php echo $device['gps_id']; ?>">
                    <?php echo htmlspecialchars($device['gps_id']); ?>
                </option>
            <?php endforeach; ?>
            </select>

        </div>


        </div>

    </div>

    <hr class="nav-divider-1">
    
    <button type="submit" class="create-vehicle-button">ADD NEW VEHICLE</button>
    <button type="reset" class="create-vehicle-button">CLEAR</button>

</form>

 
</div>