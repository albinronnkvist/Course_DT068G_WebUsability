<?php session_start(); ?>
<!-- 
// Östhammars Kommun - Färdtjänst
// Redigera användare
// Author: Albin Rönnkvist
 -->

<!-- Header -->
<?php 
    
    // Logged in as admin
    if($_SESSION['user_type'] == 'admin') :
        $page_title = "Redigera";
    endif;

    //Logged in as employee
    if($_SESSION['user_type'] == 'employee') :
        $page_title = "Redigera";
    endif;

    include("includes/header.php");
?>  

    <!-- Sidebar -->
    <?php include("includes/sidebar.php") ?>

    <!-- Content  -->
    <div id="content">
        
        <!-- Breadcrumbs -->
        <ul class="breadcrumbs">
            <li><a href="index.php">Start</a></li>

            <!-- Logged in as admin-->
            <?php
            if($_SESSION['user_type'] == 'admin') :
            ?>
                <li><a href="users.php">Hantera användare</a></li>
                <li>Redigera</li>
            <?php
            endif;
            ?>

            <!-- Logged in as employee -->
            <?php
            if($_SESSION['user_type'] == 'employee') :
            ?>  
                <li><a href="users.php">Hantera kunder</a></li>
                <li>Redigera</li>
            <?php
            endif;
            ?>
        </ul>

        <!-- Page title -->
        <h1><i class="fas fa-user-edit"></i> <?php echo $page_title; ?></h1> 
        <hr>

        <!-- Logged in as admin -->
        <?php
        if($_SESSION['user_type'] == 'admin') :
        ?>

        <!-- List of all users -->
        <h2>Användare:</h2>
        <p>Välj en användare nedan för att redigera dess profil. (sökfunktion under konstruktion).</p>
        <br>

        <?php

            $allUsers = new Users();

            //get all users
            $userlist = $allUsers->getUsers();

            //Print names
            echo "<div>";
            foreach($userlist as $u){
            echo "<a href='update-user.php?updateID=" . $u['username'] . "'>" . "<i class='fas fa-user'></i> " . $u['firstname'] . " " .  $u['lastname'] . "</a>" . "<hr>";
            }
            echo "</div>";

        ?>
        <?php
        endif;
        ?>



        <!-- Logged in as employee -->
        <?php
        if($_SESSION['user_type'] == 'employee') :
        ?>

        <!-- List of all customers -->
        <h2>Kunder:</h2>
        <p>Välj en kund nedan för att redigera dess profil. (sökfunktion under konstruktion).</p>
        <br>

        <?php

            $allCustomers = new Users();

            //get all customers
            $customerList = $allCustomers->getCustomers();

            //Print names
            echo "<div>";
            foreach($customerList as $u){
            echo "<a href='update-user.php?updateID=" . $u['username'] . "'>" . "<i class='fas fa-user'></i> " . $u['firstname'] . " " .  $u['lastname'] . "</a>" . "<hr>";
            }
            echo "</div>";

        ?>
        <?php
        endif;
        ?>



        <!-- If the user is not logged in -->
        <?php 
        if(!isset($_SESSION["myUsername"])) : 
        ?>  
            <script>
                window.location = 'index.php';
            </script>
        <?php
        endif;
        ?>



        <!-- Logged in as customer -->
        <?php
        if(isset($_SESSION['myUsername']) && ($_SESSION['user_type'] == 'customer')) :
        ?>
            <script>
                window.location = 'index.php';
            </script>
        <?php
        endif;
        ?>


    <div style="clear: both;"></div>
    </div><!-- end of #content -->
    <div style="clear: both;"></div>

<!-- Footer -->
<?php include("includes/footer.php"); ?>