
<?php if($user_access == 2 || $user_access == 1){ ?>
    <div class="map-add-stop">
    <div class="add-stop-header">
        <h2 class="raleway-light">Add Bus Stop</h2>
    </div>

    <form class="add-stop-form">

        <div class="add-stop-form-container">

            <div class="add-stop-section">
                <label>Stop Name</label> </br>
                <input type="text" name="stopname" placeholder="Stop name">
                <hr class="stop-divider-1">
                <button type="submit" class="add-stop-button">ADD STOP</button>
            </div>

            <div class="add-stop-section">
                <label>Longitude</label> </br>
                <input type="text" name="longitude" placeholder="X 00.00000">

                <label>Latitude</label> </br>
                <input type="text" name="latitude" placeholder="Y 00.00000">
            </div>

        </div>

      

    </form>
</div>
<?php } else { ?>




<?php } ?>
