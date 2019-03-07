<!-- Sidebar -->
<!-- Author: Albin Rönnkvist -->



<div id="sidebar">

    <!-- Menu -->
    <h1>Meny</h1>
    <hr>
    <ul class="ulNodots">
        <li><a class="<?php echo ($page_title == "Färdtjänst" ? "activelink" : "")?>" href="index.php" title="Startsida"><i class="fas fa-home"></i> Start</a></li>
        <li><a class="<?php echo ($page_title == "Mina sidor" ? "activelink" : "")?>" href="login.php" title="Din personliga sida"><i class="fas fa-user-circle"></i> Mina sidor</a></li>

        <!-- If the user is not logged in OR is logged in as a customer - order trip -->
        <?php
        if(!isset($_SESSION['myUsername']) || (isset($_SESSION["myUsername"]) && ($_SESSION['user_type'] == 'customer'))) : 
        ?> 
            <li><a class="<?php echo ($page_title == "Beställ resa" ? "activelink" : "")?>" href="orderinfo.php" title="Beställ resa"><i class="fas fa-taxi"></i> Beställ resa</a></li>
        <?php 
        endif; 
        ?>

        <!-- If the user is not logged in - Apply for an account -->
        <?php
        if(!isset($_SESSION["myUsername"])) : 
        ?> 
            <li><a class="<?php echo ($page_title == "Ansök" ? "activelink" : "")?>" href="ansok.php" title="Ansök om färdtjänst"><i class="fas fa-arrow-circle-right"></i> Ansök</a></li>
        <?php 
        endif; 
        ?>

        <!-- Empty user_type if the visitor is not logged in -->
        <?php
        if(empty($_SESSION['user_type'])) : 
            $_SESSION['user_type'] = "";
        ?> 
        <?php 
        endif; 
        ?>

        <!-- Logged in as admin - Handle users-->
        <?php
        if(isset($_SESSION["myUsername"]) && ($_SESSION['user_type'] == 'admin')) : 
        ?> 
            <li><a class="<?php echo ($page_title == "Hantera användare" ? "activelink" : "")?>" href="users.php" title="Hantera användare"><i class="fas fa-user-edit"></i> Hantera användare</a></li>
        <?php 
        endif; 
        ?>

        <!-- Logged in as employee - Handle customers -->
        <?php
        if(isset($_SESSION["myUsername"]) && ($_SESSION['user_type'] == 'employee')) : 
        ?> 
            <li><a class="<?php echo ($page_title == "Hantera kunder" ? "activelink" : "")?>" href="users.php" title="Hantera kunder"><i class="fas fa-user-edit"></i> Hantera kunder</a></li>
        <?php 
        endif; 
        ?>

    </ul>

    <!-- Log out -->
    <?php
        if(isset($_SESSION["myUsername"])) : 
            $loginFromDB = new Users();

            if(isset($_GET['logOut'])){
                $loginFromDB->logOutUser($username);
                echo "<script> window.location.href = 'index.php'; </script>";
            }
    ?> 
        <br>
        <a class="aButton" href="?logOut">Logga ut <i class="fas fa-sign-out-alt"></i></a>
    <?php 
    endif; 
    ?>
    
</div>