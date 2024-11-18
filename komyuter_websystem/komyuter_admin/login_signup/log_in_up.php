<?php

$page = isset($_GET['page']) ? $_GET['page'] : 'login';

?>

<!DOCTYPe html>
<html>
<head>
    <title>Komyuter Log-in</title>
    <link rel="stylesheet" type="text/css" href="../style/master.css">
    
</head>
<body>
    <div class="log-in-up-container">

    <!-- Design only elements -->
    <div id="circle1" class="log-in-up-container-circle"></div>
    <div id="circle2" class="log-in-up-container-circle"></div>
    <div id="circle3" class="log-in-up-container-circle"></div>
    
    <img id ="log-in-up-background-img" src="../images/Komyuter.svg" alt="Komyuter Logo"/>

     <?php
        if (isset($_GET['signup'])) { ?>

        <form class="log-in-up-form log-in-up-form2" action="sign_up_validation.php" method="post">
            <div class="logo-container logo-container2">
                <img src="../images/Komyuter.svg" alt="Komyuter Logo"/>
                <h1 class="raleway-light">-admin</h1>
            </div>
            <h2 class="raleway-light">Join us now!</h2>
                
            <?php if ($_GET['signup'] === 'error' || $_GET['signup'] === 'error'){ ?>
                <span id="error2">*Please fill up all fields</span>
            <?php } else if ($_GET['signup'] === 'error' || $_GET['signup'] === 'mismatch'){ ?>
                <span id="error2">*Passwords does not match</span>
            <?php } ?>

            <label>first name</label>           
            <input type="text" name="fname" placeholder="First name">

            <label>last name</label>
            <input type="text" name="lname" placeholder="Last name">

            <label>email</label>
            <input type="text" name="email" placeholder="User email">

            <label>password</label>
            <input type="password" name="password" placeholder="Password">

            <label>confirm password</label>
            <input type="password" name="con_password" placeholder="Confirm password">

            <hr class="divider"></hr>

            <button>REGISTER</button>

            <p>Already have an account? <a href="log_in_up.php?login">Log-in here</a></p>

        </form>

    <?php
    } else {
    ?>

        <form class="log-in-up-form" action="log_in_validation.php" method="post">
            <div class="logo-container">
                <img src="../images/Komyuter.svg" alt="Komyuter Logo"/>
                <h1 class="raleway-light">-admin</h1>
            </div>
            <h2 class="raleway-light">Log-in</h2>

            <label>email</label> 

            <?php
                if ($_GET['login'] === 'error' || $_GET['login'] === 'erroremail'){ ?>
                 <label id="error">*enter your email address</label> 
            <?php
                }
            ?>
            <input type="text" name="email" placeholder="User email">

            <label>password</label>

            <?php
                if ($_GET['login'] === 'error' || $_GET['login'] === 'errorpass'){ ?>
                 <label id="error">*enter your password</label> 
            <?php } ?>
            <input type="password" name="password" placeholder="Password">

            <hr class="divider"></hr>

            <button>LOGIN</button>

            <p>Don't have an account? <a href="log_in_up.php?signup">Sign-up here</a></p>

        </form>

        <?php } ?>

       
        <div class="log-in-up-section">
            <div>
                <img src="../images/intro_page/track.svg" alt="track icon"/>
                <p class="raleway-light">With our GPS tracking feature, users can effortlessly locate nearby jeepneys in real time. No more guessing when your ride will arrive! The intuitive interface provides live updates on vehicle locations, allowing you to plan your travels with confidence and convenience.</p>
            
            </div>

            <hr class="divider2"></hr>

            <div>
                <img src="../images/intro_page/bus-alt.svg" alt="track icon"/>
                <p class="raleway-light">Our comprehensive monitoring capabilities go beyond simple tracking. Users can access detailed insights into jeepney routes and expected arrival times. This empowers you to make informed decisions about your commute, reducing wait times and enhancing overall travel efficiency.</p>
            </div>

            <hr class="divider2"></hr>

            <div>
                <img src="../images/intro_page/users.svg" alt="track icon"/>
                <p class="raleway-light">Navigating the Komyuter application is a breeze! With an intuitive interface, users can easily access essential features with just a few taps. Whether you're a tech-savvy commuter or new to mobile apps, our streamlined design ensures a hassle-free experience for everyone.</p>
            </div>

        </div>

    </div>
    
</body>

</html>