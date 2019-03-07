<?php session_start(); ?>
<!-- 
// Östhammars Kommun - Färdtjänst
// Uppdatera användare - lagring lyckades
// Author: Albin Rönnkvist
 -->

<!-- Header -->
<?php 
    $page_title = "Uppdateringsbekräftelse";
    include("includes/header.php");

    if(isset($_GET['updatedID'])){
        $id = $_GET['updatedID'];
    }

    $user = new Users();

    $usernameFullname = $user->getFullname($id);

    $updated_Name = $usernameFullname['firstname'] . " " . $usernameFullname['lastname'];
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
                <li><a href="userlist.php">Redigera</a></li>
                <li><a href="update-user.php?userID='<?php echo $id; ?>'"><?php echo $updated_Name ?></a></li>
                <li>Användare uppdaterad!</li>
            <?php
            endif;
            ?>

            <!-- Logged in as employee -->
            <?php
            if($_SESSION['user_type'] == 'employee') :
            ?>  
                <li><a href="users.php">Hantera kunder</a></li>
                <li><a href="userlist.php">Redigera</a></li>
                <li><a href="update-user.php?userID='<?php echo $id; ?>'"><?php echo $updated_Name ?></a></li>
                <li>Kund uppdaterad!</li>
            <?php
            endif;
            ?>
        </ul>

        <!-- Logged in as admin-->
        <?php
        if($_SESSION['user_type'] == 'admin') :
        ?>
            <!-- User updated. Confirm -->
            <h1 style='color: #5cb85c;' class='pSuccess'><i class='fas fa-user-check'></i> Användare Uppdaterad!</h1>
            <hr>
            <p><?php echo $updated_Name ?>s profil är nu uppdaterad.</p> 
            <p><a href="userlist.php"><i class="fas fa-user-edit"></i> Redigera en annan användare</a></p>
        <?php
        endif;
        ?>

        <!-- Logged in as employee -->
        <?php
        if($_SESSION['user_type'] == 'employee') :
        ?>  
            <!-- Customer updated. Confirm -->
            <h1 style='color: #5cb85c;' class='pSuccess'><i class='fas fa-user-check'></i> Kund Uppdaterad!</h1>
            <hr>
            <p><?php echo $updated_Name ?>s profil är nu uppdaterad.</p> 
            <p><a href="userlist.php"><i class="fas fa-user-edit"></i> Redigera en annan kund</a></p>
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