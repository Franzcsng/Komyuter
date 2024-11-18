<div class="cooperative-nav">
    <a href="index.php?page=cooperatives&subpage=cooperatives">cooperatives</a>
    

    
<?php if($user_access === 2 || $user_access === 1){ ?>

    <div class="cooperative-nav-vl"></div>
    <a href="index.php?page=cooperatives&subpage=newcooperative">Add New cooperative</a>

<?php } else { } ?>

</div>

<div class="cooperative-page-container">

        <?php   
            switch ($subpage) {
            case 'cooperatives':
                require_once 'cooperatives_list.php';
                break;
            case 'newcooperative':
                require_once 'add_cooperative.php';
                break;
            case 'cooperativedetails':
                require_once 'cooperative_details.php';
                break;
            default:
                require_once 'cooperatives_list.php';
                break;
            }
        ?>

</div>