<div class="add-vehicle-section">

<div class="vehicle-header-text-container">
    <h2 class="raleway-light">Add new vehicle</h2>
</div>

<form class="add-vehicle-form" method="POST" action="processes_actions/vehicle_actions.php?action=new">

    <div class="add-vehicle-form-container">

        <div class="vehicle-form-section">

            <div class="vehicle-select-options-section"> 

                <label class="select-label">Cooperative</label> </br>
                <select class="vehicle-level-options" name="cooperative">
                    <option value="">Select Cooperative</option>
                    <?php foreach ($cooperatives as $cooperative): ?>
                        <option value="<?php echo $cooperative['cooperative_id']; ?>">
                            <?php echo htmlspecialchars($cooperative['cooperative_name']); ?>
                        </option>
                    <?php endforeach; ?>
                    
                </select>

            </div>

            <label>Plate Number</label> </br>
            <input type="text" name="platenumber" placeholder="ABC 0000">

            <label>Route</label> </br>
            <select class="vehicle-level-options" name="route">

                <?php foreach ($routes as $route): ?>
                    <option value="<?php echo $route['route_id']; ?>">
                        <?php echo htmlspecialchars($route['route_name']); ?>
                    </option>
                <?php endforeach; ?>
                
            </select>


        </div>

        <div class="vehicle-form-section">

        <div class="vehicle-select-options-section"> 

        <label class="select-label">Vehicle Status</label> </br>

            <select class="vehicle-level-options" name="status">
                <option value="" disabled selected>Select Status</option>
                <option value="0">Active</option>
                <option value="1">Decomissioned</option>
                <option value="2">Maintenance</option>
            </select>

            <label class="select-label">GPS Device</label> </br>

            <select class="vehicle-level-options" name="gpsdevice">
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