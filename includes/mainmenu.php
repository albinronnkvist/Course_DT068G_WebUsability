<!-- Mobile main menu -->
<!-- Author: Albin Rönnkvist -->



    <div class="smallmenu" id="myTopnav">

        <a class="<?php echo ($page_title == "Färdtjänst" ? "activelink" : "")?>" href="index.php" title="Startsida"><i class="fas fa-home"></i> Start</a>
        <a class="<?php echo ($page_title == "Mina sidor" ? "activelink" : "")?>" href="login.php" title="Din personliga sida"><i class="fas fa-user-circle"></i> Mina sidor</a>

        <!-- If the user is not logged in OR is logged in as a customer - order trip -->
        <?php
        if(!isset($_SESSION['myUsername']) || (isset($_SESSION["myUsername"]) && ($_SESSION['user_type'] == 'customer'))) : 
        ?> 
        <a class="<?php echo ($page_title == "Beställ resa" ? "activelink" : "")?>" href="orderinfo.php" title="Beställ resa"><i class="fas fa-taxi"></i> Beställ resa</a>
        <?php 
        endif; 
        ?>

        <!-- If the user is not logged in - Apply for an account -->
        <?php
        if(!isset($_SESSION["myUsername"])) : 
        ?> 
        <a class="<?php echo ($page_title == "Ansök" ? "activelink" : "")?>" href="ansok.php" title="Ansök om färdtjänst"><i class="fas fa-arrow-circle-right"></i> Ansök</a>
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

        <!-- Logged in as admin - Handle user -->
        <?php
        if(isset($_SESSION["myUsername"]) && ($_SESSION['user_type'] == 'admin')) : 
        ?> 
            <a class="<?php echo ($page_title == "Hantera användare" ? "activelink" : "")?>" href="users.php" title="Hantera användare"><i class="fas fa-user-edit"></i> Hantera användare</a>
        <?php 
        endif; 
        ?>

        <!-- Logged in as employee - Handle user -->
        <?php
        if(isset($_SESSION["myUsername"]) && ($_SESSION['user_type'] == 'employee')) : 
        ?> 
            <a class="<?php echo ($page_title == "Hantera kunder" ? "activelink" : "")?>" href="users.php" title="Hantera kunder"><i class="fas fa-user-edit"></i> Hantera kunder</a>
        <?php 
        endif; 
        ?>
        <a href="javascript:void(0);" class="icon" onclick="foldMenu()">
        </a>
        
    </div>