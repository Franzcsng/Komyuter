<div class="map-page-container">

    <div id="map">
       
    </div>

    <div class="map-navigation">
        <a onclick="showAll(); return false;">Live Map</a>
        <a href="#" onclick="showVehicles(); return false;">Vehicles</a>    
        <a href="index.php?page=map&subpage=addstop" onclick="showStops(); return false;">Bus Stops</a>    
    </div>

    <div class="map-page-section"> 
        <?php
         include "add_stop.php";
        ?>     
    </div>

</div>  