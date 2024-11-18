<div class="user-nav">
    <a href="index.php?page=users&subpage=users">Users</a>
    <div class="user-nav-vl"></div>
    <a href="index.php?page=users&subpage=newuser">Add New User</a>
</div>

<div class="user-page-container">

        <?php   
            switch ($subpage) {
            case 'users':
                require_once 'user_list.php';
                break;
            case 'newuser':
                require_once 'add_user.php';
                break;
            case 'userprofile':
                require_once 'user_profile.php';
                break;
            default:
                require_once 'user_list.php';
                break;
            }
        ?>

</div>