
<div class="cooperative-list-section">

    <div class="cooperative-list-header">
        <div class="cooperative-search-container">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="user_search" placeholder="Search..">
        </div>
    </div>

    <div class="table-scroll-wrapper">
        <table class="cooperative-list-table">

            <tr>
                <th></th>
                <th>Cooperative</th>
                <th>Address</th>
                <th>Status</th>
                
            </tr>

            <?php
                if ($cooperatives) {
                    $count = 1;
                    foreach ($cooperatives as $cooperative) {
                        extract($cooperative); 
            ?>
            <tr>
                <td> <?php echo $count; ?> </td>
                <td> <a href="index.php?page=cooperatives&subpage=cooperativedetails&id=<?php echo $cooperative_id; ?>"> <?php echo $cooperative_name ?> </a> </td>
                <td> <?php echo $address; ?> </td>
                <td>
                    <?php if($status == "0"){?>
                        <p id="cooperative-deact" class="cooperative-list-active">Unavailable</p>
                    <?php } else if($status == "1"){ ?>
                        <p  class="cooperative-list-active">Active</p>
                    <?php }?>
                </td>
            </tr>
    <?php
      $count++;
    }
    } else {
        ?>
            <p class="cooperative-empty-record"> No Record Found </p>
        <?php } ?>
          
        </table>
    </div>
</div>