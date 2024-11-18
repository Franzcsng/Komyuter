<?php
    $cooperative_data = $cooperativeObj->get_cooperative($page_id);
?>

<div class="add-cooperative-section">

<div class="cooperative-header-text-container">
    <h2>
    Cooperative ID: <?php echo $page_id?> 
    </h2>
</div>

<form class="add-cooperative-form" method="POST" action="processes_actions/cooperative_actions.php?action=updatestatus">

    <div class="add-cooperative-form-container">

        <div class="cooperative-form-section">

            <input type="hidden" name="coopid" value="<?php echo $cooperative_data['cooperative_id'];?> " name="id">


            <label class="select-label">Cooperative</label> </br>
            <input type="text" value="<?php echo $cooperative_data['cooperative_name'];?> " disabled>

            <label>City</label> </br>
            <input type="text" value="<?php echo $cooperative_data['city'];?> " disabled>

        </div>

        <div class="cooperative-form-section">

            <label>Address</label> </br>
            <textarea name="address" rows="4" placeholder="Enter cooperative's full address" disabled>
                <?php echo  $cooperative_data['address'];?>
            </textarea>
      
        <div class="cooperative-select-options-section"> 
            

        <label class="select-label">Vehicle Status</label> </br>

            <select class="cooperative-level-options" name="status">
                <option value="<?php echo $cooperative_data['status'];?>" selected>
                    
                    <?php if($cooperative_data['status'] === 0){
                        echo "Unavailable";
                    } else if ($cooperative_data['status'] === 1){
                        echo "Active";
                    } 
                    
                    ?>

                </option>

                <option value="0">Unavailable</option>
                <option value="1">Active</option>
            </select>

        </div>


        </div>

    </div>

    <hr class="nav-divider-1">
    
    <button type="submit" class="create-cooperative-button">UPDATE STATUS</button>

</form>

 
</div>