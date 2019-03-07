<?php session_start(); ?>
<!-- 
// Östhammars Kommun - Färdtjänst
// hantera användare
// Author: Albin Rönnkvist
 -->

<!-- Header -->
<?php 
    // Logged in as admin
    if($_SESSION['user_type'] == 'admin') :
        $page_title = "Hantera användare";
    endif;

    //Logged in as employee
    if($_SESSION['user_type'] == 'employee') :
        $page_title = "Hantera kunder";
    endif;

    include("includes/header.php");
?>  
    <!-- Sidebar -->
    <?php include("includes/sidebar.php") ?>

    <!-- Content -->
    <div id="content">

        <!-- Breadcrumbs -->
        <ul class="breadcrumbs">
            <li><a href="index.php">Start</a></li>

            <!-- Logged in as admin-->
            <?php
            if($_SESSION['user_type'] == 'admin') :
            ?>
                <li>Hantera användare</li>
            <?php
            endif;
            ?>

            <!-- Logged in as employee -->
            <?php
            if($_SESSION['user_type'] == 'employee') :
            ?>  
                <li>Hantera kunder</li>
            <?php
            endif;
            ?>
        </ul>

        <!-- Page title -->
        <h1><i class="fas fa-user-edit"></i> <?php echo $page_title; ?></h1> 
        <hr>

<!-- Logged in as admin-->
<?php
if($_SESSION['user_type'] == 'admin') :
?>
    <h2>Hantera användare:</h2>
    <p><a href="register.php" title="Registrera ny användare"><i class="fas fa-user-plus"></i> Skapa ny användare</a></p>
    <p><a href="userlist.php" title="Redigera användare"><i class="fas fa-user-edit"></i> Redigera användare</a></p>
<?php 
endif; 
?>



<!-- Logged in as employee -->
<?php
if($_SESSION['user_type'] == 'employee') :
?>
    <h2>Hantera kunder:</h2>
    <p><a href="register.php" title="Registrera ny kund"><i class="fas fa-user-plus"></i> Skapa ny kund</a></p>
    <p><a href="userlist.php" title="Redigera kunder"><i class="fas fa-user-edit"></i> Redigera kunder</a></p>
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



<!-- If they user is not logged in -->
<?php 
if(!isset($_SESSION["myUsername"])) : 
?>  
    <script>
        window.location = 'index.php';
    </script>
<?php 
endif; 
?>

    </div><!-- end of #content -->
    <div style="clear: both;"></div>

<!-- Footer -->
<?php include("includes/footer.php"); ?>