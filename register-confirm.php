<?php session_start(); ?>
<!-- 
// Östhammars Kommun - Färdtjänst
// Registrera användare - lagring lyckades
// Author: Albin Rönnkvist
 -->

<!-- Header -->
<?php 
    $page_title = "Registreringsbekräftelse";
    include("includes/header.php");
?> 



<!-- If the user is not logged in or does not have authority -->
<?php
if(!isset($_SESSION["myUsername"]) || $_SESSION['user_type'] != 'employee' && $_SESSION['user_type'] != 'admin') : 
?> 
    <script>
        window.location = 'index.php';
    </script>
<?php 
endif; 
?> 




<!-- If the user has authority -->
<?php
if ($_SESSION['user_type'] == 'admin' || $_SESSION['user_type'] == 'employee') :
?>

    <!-- Sidebar -->
    <?php include("includes/sidebar.php") ?>

    <!-- Content -->
    <div id="content">
        <ul class="breadcrumbs">
            <li><a href="index.php">Start</a></li>
            <!-- Logged in as admin-->
            <?php
            if($_SESSION['user_type'] == 'admin') :
            ?>
                <li><a href="users.php">Hantera användare</a></li>
                <li><a href="register.php">Skapa</a></li>
                <li>Användare skapad!</li>
            <?php
            endif;
            ?>

            <!-- Logged in as employee -->
            <?php
            if($_SESSION['user_type'] == 'employee') :
            ?>  
                <li><a href="users.php">Hantera kunder</a></li>
                <li><a href="register.php">Skapa</a></li>
                <li>Kund skapad!</li>
            <?php
            endif;
            ?>
        </ul>

        <!-- Logged in as admin-->
        <?php
        if($_SESSION['user_type'] == 'admin') :
        ?>
            <!-- User created. Confirm -->
            <h1 style='color: #5cb85c;' class='pSuccess'><i class='fas fa-user-check'></i> Användare skapad!</h1>
            <p>Användarens profil är nu skapad. Vänligen skicka inloggningsuppgifter till användaren!(automatiskt utskick under konstruktion).</p>
            <hr>
            <!-- Register another user -->
            <p><a href="register.php"><i class="fas fa-user-plus"></i> Skapa ny användare</a></p>
        <?php
        endif;
        ?>

        <!-- Logged in as employee -->
        <?php
        if($_SESSION['user_type'] == 'employee') :
        ?>  
            <!-- Customer created. Confirm -->
            <h1 style='color: #5cb85c;' class='pSuccess'><i class='fas fa-user-check'></i> Kund skapad!</h1>
            <hr>
            <p>Kundens profil är nu skapad. Vänligen skicka inloggningsuppgifter till kunden!(automatiskt utskick under konstruktion).</p>
            <!-- Register another customer -->
            <p><a href="register.php"><i class="fas fa-user-plus"></i> Skapa ny kund</a></p>
        <?php
        endif;
        ?>
        <br>

        </div><!-- end of #content -->
        <div style="clear: both;"></div>

<?php
// End - If the user has authority.
endif; 
?> 

<!-- Footer -->
<?php include("includes/footer.php"); ?>