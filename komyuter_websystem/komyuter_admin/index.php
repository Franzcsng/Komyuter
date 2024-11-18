 <?php
    include 'login_signup/auth_check.php';
    include 'classes/user_class.php';
   include 'classes/cooperative_class.php';
   include 'classes/route_class.php';
   include 'classes/gps_device_class.php';
   include 'classes/vehicle_class.php';
   

    $email = $_SESSION['email'];
    $user = new User();
    $id = $user->get_user_id($email);
    $cooperativeObj = new Cooperative();
    $cooperatives = $cooperativeObj->getAllCooperatives();
    $routeObj = new Route();
    $routes = $routeObj->get_all_routes();
    $gpsObj = new GPSDevice();
    $vehicleObj = new Vehicle();
    $all_vehicles = $vehicleObj->get_all_vehicles();

    $unassignedDevices = $gpsObj->get_unassigned_devices();
    $page_id= isset($_GET['id']) ? $_GET['id'] : '';

    $user_access = $user->get_access($id);

    $page = isset($_GET['page']) ? $_GET['page'] : ''; 
    $subpage = (isset($_GET['subpage']) && $_GET['subpage'] !='') ? $_GET['subpage'] : '';
    $action = (isset($_GET['action']) && $_GET['action'] !='') ? $_GET['action'] : '';

    switch($page){
        case 'logout':
            session_destroy();
            header("Location: login_signup/log_in_up.php?login");
            exit();
    }
?> 

<!DOCTYPe html>
<html>
<head>
    <title>Komyuter</title>
    <link rel="stylesheet" type="text/css" href="style/master.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>
<body>
    <div class="main-header">

        <div class="home-logo-container">
            <img id ="header-logo" src="images/Komyuter.svg" alt="komyuter">
            <img src="images/komyuter_text.svg" alt="komyuter">
        </div>
       
        <div class="home-search-container">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="home_search" placeholder="Search..">

        </div>
        
        <div class="home-profile-container">
            <i class="fa-solid fa-bell"></i>
            <img src="images/Komyuter.svg" alt="user">
            <p>
                <span>
                <?php if($user->get_access($id) === 0){
                    echo 'Staff';
                }else if($user->get_access($id) === 1){
                    echo 'Manager';
                }else if($user->get_access($id) === 3){
                    echo 'Administrator';
                }?>
                </span> 
                <br/>
                <?php echo $user->get_first_name($id).' '.$user->get_last_name($id); ?>
            </p>
                <i id="home-profile-logout"class="fa-solid fa-right-from-bracket"></i>
        </div>
        
    </div>

    <hr class="home-divider">

    <div class="home-container">
        <nav class="main-nav">
            

            <div class="nav-header-info">
                <img src="images/Komyuter.svg" alt="co-op">
                <p><span class="raleway-bold">Cooperative</span><br/>Komyuter Transport Co-op<br/>Bacolod City, 6100</p>
            </div>

            <hr class="nav-divider-1">

            <div>
            
            <div class="nav-text-divider">
                <h2 class="raleway-bold"> MAIN <h2>
                <i class="fa-solid fa-ellipsis"></i>
            </div>
            <ul class="nav-home-section">
            
                <a href="index.php?page=dashboard">
                    <li>
                        <i class="fa-solid fa-border-all"></i>
                        <h2 class="raleway-light">dashboard</h2>
                        <i class="fa-solid fa-caret-right nav-arrow"></i>
                    </li>
                </a>

            </ul>

            <hr class="nav-divider-1">

            <div class="nav-text-divider">
                <h2 class="raleway-bold"> PAGES <h2>
                <i class="fa-solid fa-ellipsis"></i>
            </div>

            <ul class="nav-home-section">

                <a href="index.php?page=vehicles">
                    <li>
                        <i class="fa-solid fa-bus-simple"></i>
                        <h2 class="raleway-light">vehicles</h2>
                        <i class="fa-solid fa-caret-right nav-arrow"></i>
                    </li>
                </a>

                <a href="index.php?page=map">
                    <li>
                        <i class="fa-solid fa-map-location"></i>
                        <h2 class="raleway-light">live map</h2>
                        <i class="fa-solid fa-caret-right nav-arrow"></i>
                    </li>
                </a>

                <a href="index.php?page=cooperatives">
                    <li>
                        <i class="fa-solid fa-users-rectangle"></i>
                        <h2 class="raleway-light">cooperatives</h2>
                        <i class="fa-solid fa-caret-right nav-arrow"></i>
                    </li>
                </a>

                <a href="index.php?page=drivers">
                    <li>
                        <i class="fa-regular fa-id-card"></i>
                        <h2 class="raleway-light">drivers</h2>
                        <i class="fa-solid fa-caret-right nav-arrow"></i>
                    </li>
                </a>

                <a href="index.php?page=conductors">
                    <li>
                        <i class="fa-solid fa-user-group"></i>
                        <h2 class="raleway-light">conductors</h2>
                        <i class="fa-solid fa-caret-right nav-arrow"></i>
                    </li>
                </a>
                
                <?php if($user_access !== 2){

                } else { ?>

                <a href="index.php?page=users">
                    <li>
                        <i class="fa-solid fa-user"></i>
                        <h2 class="raleway-light">users</h2>
                        <i class="fa-solid fa-caret-right nav-arrow"></i>
                    </li>
                </a>

                <?php } ?>

                <a href="index.php?page=reports">
                    <li>
                        <i class="fa-solid fa-clipboard"></i>
                        <h2 class="raleway-light">reports</h2>
                        <i class="fa-solid fa-caret-right nav-arrow"></i>
                    </li>
                </a>

                <a href="index.php?page=routes">
                    <li>
                        <i class="fa-solid fa-route"></i>
                        <h2 class="raleway-light">routes</h2>
                        <i class="fa-solid fa-caret-right nav-arrow"></i>
                    </li>
                </a>

            </ul>

            <hr class="nav-divider-1">

            <div class="nav-text-divider">
                <h2 class="raleway-bold"> SETTINGS <h2>
                <i class="fa-solid fa-ellipsis"></i>
            </div>

            <ul class="nav-home-section">

            <a href="index.php?page=settings">
                <li>
                    <i class="fa-solid fa-gear"></i>
                    <h2 class="raleway-light">settings</h2>
                    <i class="fa-solid fa-caret-right nav-arrow"></i>
                </li>
            </a>

            </ul>

            <hr class="nav-divider-1">
        </nav>        

        <div class="home-container-child">

        <?php
            switch ($page) {
            case 'dashboard':
                require_once 'dashboard.php';
                break;
            case 'vehicles':
                require_once 'vehicles_pages/vehicle_main.php';
                break;
            case 'map':
                require_once 'map_pages/map.php';
                break;
            case 'cooperatives':
                require_once 'cooperative_pages/cooperative_main.php';
                break;
            case 'drivers':
                require_once 'dashboard.php';
                break;
            case 'conductors':
                require_once 'dashboard.php';
                break;
            case 'users':
                require_once 'user_pages/user_main.php';
                break;
            case 'reports':
                require_once 'dashboard.php';
                break;
            case 'settings':
                require_once 'dashboard.php';
                break;
            default:
                require_once 'dashboard.php';
                break;
            }
        ?>

        </div>

    </div>

<div id="log-out-modal" class="modal-background">

    <div class="log-out-modal-container">
            <h2 class="raleway-light">Are you sure you want to <span>logout</span>?</h2>
            
            <div class="log-out-btn-container">
                <a class="logout-btns logoutbtn" href="index.php?page=logout">Logout</a>
                <a class="logout-btns cancelbtn">Cancel</a>

            </div>
    </div>

</div> 
<script src="javascript/map.js"></script>
<script src="javascript/navigation.js"></script>
</body>
</html>