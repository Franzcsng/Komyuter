<?php

?>

<div class="vehicle-list-section">

    <div class="vehicle-list-header">
        <div class="vehicle-search-container">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="user_search" placeholder="Search..">
        </div>
    </div>

    <div class="table-scroll-wrapper">
        <table class="vehicle-list-table">

            <tr>
                <th></th>
                <th>Plate No.</th>
                <th>Cooperative</th>
                <th>Status</th>
            </tr>

            <?php
                if ($all_vehicles) {
                    $count = 1;
                    foreach ($all_vehicles as $vehicle) {
                        extract($vehicle); 
            ?>
            <tr>
                <td> <?php echo $count; ?> </td>
                <td> <a href="index.php?page=vehicles&subpage=vehicledetails&id=<?php echo $vehicle_id; ?>"> <?php echo $license_num ?> </a> </td>
                <td> <?php echo $cooperativeObj->get_cooperative_name($cooperative_id); ?> </td>
                <td>
                    <?php if($status === "0"){?>
                        <p class="vehicle-list-active">Active</p>
                    <?php } else if($status === "1"){ ?>
                        <p id="vehicle-deact" class="vehicle-list-active">Deactivated</p>
                    <?php }else if($status === "2"){ ?>
                        <p id="vehicle-terminated" class="vehicle-list-active">Terminated</p>
                    <?php } ?> 
                </td>
            </tr>
    <?php
      $count++;
    }
    } else {
        ?>
            <p class="vehicle-empty-record"> No Record Found </p>
        <?php } ?>
          
        </table>
    </div>
</div>