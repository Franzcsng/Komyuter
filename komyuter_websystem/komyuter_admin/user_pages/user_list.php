<div class="user-list-section">

    <div class="user-list-header">
        <div class="user-search-container">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="user_search" placeholder="Search..">
        </div>
    </div>

    <div class="table-scroll-wrapper">
        <table class="user-list-table">

            <tr>
                <th></th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact No.</th>
                <th>Level</th>
                <th>Status</th>
            </tr>

    <?php
        if($user->get_access($id) != "2"){
        $count = 1;
        if($user->get_user($id) != false){
        foreach($user->get_user($id) as $value){
        extract($value);
    ?>
            <tr>
                <td> <?php echo $count; ?> </td>
                <td> <a href="index.php?page=users&subpage=userprofile"> <?php echo $f_name.' '.$l_name; ?> </a> </td>
                <td> <?php echo $email; ?> </td>
                <td> <?php echo $contact_no; ?> </td>
                <td> 
                    <?php if($status === "0"){ 
                    echo "Staff";
                    } else if($status === "1"){
                    echo "Manager";
                    }else if($status === "2"){
                    echo "Administrator";
                    }?>         
                </td>
                <td>
                    <?php if($status === "0"){?>
                        <p class="user-list-active">Active</p>
                    <?php } else if($status === "1"){ ?>
                        <p id="user-deact" class="user-list-active">Deactivated</p>
                    <?php }else if($status === "2"){ ?>
                        <p id="user-terminated" class="user-list-active">Terminated</p>
                    <?php } ?> 
                </td>
            </tr>
    <?php
      $count++;
        } 
    } else { ?>
        <p class="user-empty-record"> No Record Found </p>
    <?php }
    } else {
        $count = 1;
        if($user->get_all_users() != false){
        foreach($user->get_all_users() as $value){
        extract($value);
    ?>
            <tr>
                <td> <?php echo $count; ?> </td>
                <td> <a href="index.php?page=users&subpage=userprofile"> <?php echo $f_name.' '.$l_name; ?> </a> </td>
                <td> <?php echo $email; ?> </td>
                <td> <?php echo $contact_no; ?> </td>
                <td> 
                    <?php if($status === "0"){ 
                    echo "Staff";
                    } else if($status === "1"){
                    echo "Manager";
                    }else if($status === "2"){
                    echo "Administrator";
                    }?>         
                </td>
                <td>
                    <?php if($status === "0"){?>
                        <p class="user-list-active">Active</p>
                    <?php } else if($status === "1"){ ?>
                        <p id="user-deact" class="user-list-active">Deactivated</p>
                    <?php }else if($status === "2"){ ?>
                        <p id="user-terminated" class="user-list-active">Terminated</p>
                    <?php } ?> 
                </td>
            </tr>
    <?php
     $count++;
            }
        } else { ?>
        <p class="user-empty-record">No Record Found</p>
    <?php
        }
    }
    ?>
        </table>
    </div>
</div>