<?php session_start(); ?>
<!-- 
// Östhammars Kommun - Färdtjänst
// Mina sidor / inloggningssida
// Author: Albin Rönnkvist
 -->

<!-- Header -->
<?php 
    $page_title = "Mina sidor";
    include("includes/header.php");
?> 

    <!-- Sidebar -->
    <?php include("includes/sidebar.php") ?>
    
    <!-- Content -->
    <div id="content">

        <!-- Breadcrumbs -->
        <ul class="breadcrumbs">
            <li><a href="index.php">Start</a></li>
            <li>Mina sidor</li>
        </ul>

        <!-- Page title -->
        <h1><i class="fas fa-user-circle"></i> <?php echo $page_title; ?></h1> 
        <hr>



<!-- If the user is not logged in -->
<?php 
if(!isset($_SESSION["myUsername"])) : 
?>  
    <!-- Form to log in -->
    <h2>Logga in:</h2>
    <form class="order-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="popup" onclick="myPopupp()"><i class="fas fa-info-circle"></i>
            <span class="popuptext" id="myPopup">Endast siffrorna 0-9. Inga bokstäver, tecken eller mellanslag.<br> Exempel: 199712240084</span>
    </div>
    Personnummer:<br>
    <input type="text" name="myUsername" pattern="[0-9]{12}" placeholder="ååååmmddxxxx" required>
    <br>
    Lösenord:<br>
    <input type="password" name="password" required>
    <br>
    <input type="submit" name="logIn" value="Logga in">
    </form>
    <?php
    // Log in with user from database
        $loginFromDB = new Users();

        if(isset($_POST['logIn'])){
            $username = $_POST['myUsername'];
            $password = $_POST['password'];
        
            if($loginFromDB->loginUser($username, $password)){
                echo "<meta http-equiv='refresh' content='0'>";
            }
            else{
                echo "<p class='pError'>" . "Fel lösenord eller användarnamn!" . "</p>";
            }
        }
    ?>
    <div style="clear: both;"></div>

    <!-- If the user can't log in -->
    <h2>Kan du inte logga in?</h2>
    <h3>Har du glömt ditt lösenord?</h3>
    <p>Kontakta din färdtjänsthandläggare via mail eller telefon för att ändra lösenord!</p>

    <h3>Har du inget konto?</h3>
    <p>Du måste vara beviljad färdtjänst för att få ett konto. <a href="ansok.php">Ansök om färdtjänst <i class="fas fa-arrow-right"></i></a>.</p><br>
    <p>Om du redan är beviljad färdtjänst och inte har ett konto så bör du kontakta din färdtjänsthandläggare.</p>

<?php 
// End - if they user is not logged in.
endif; 
?>



<!-- If the user is logged in -->
<?php
if(isset($_SESSION["myUsername"])) :
    $loginFromDB = new Users();
?>
    <!-- Log out -->
    <?php
        if(isset($_GET['logOut'])){
            $loginFromDB->logOutUser($username);
            echo "<script> window.location.href = 'index.php'; </script>";
        }
    ?>

    <!-- Confirm login -->
    <h2>Du är inloggad!</h2>
    <?php echo "<p>" . "<b>Inloggad som:</b> " . $_SESSION['firstname'] . " " . $_SESSION['lastname'] . ".</p>"; ?>
    <br>
    <a class="aButton" href="?logOut">Logga ut <i class="fas fa-sign-out-alt"></i></a>
    <br>

    <!-- customer - order trip -->
    <?php if($_SESSION['user_type'] == 'customer') : ?>
    <h2>Beställ färdtjänstresa:</h2>
        <ul>
            <li>Beställ en färdtjänstresa online via webbtjänsten. <a href="order.php">Beställ resa online <i class="fas fa-arrow-right"></i></a></li>
            <li>Eller ring färdtjänstväxeln på <a href="tel:+0173-74-74-10"><i class="fas fa-phone"></i> 0173-74 74 10</a>.</li>
        </ul>
        <p><a href="orderinfo.php">Mer information om beställning av färdtjänstresa <i class="fas fa-arrow-right"></i></a></p>
    <?php endif; ?>

    <!-- Profile -->
    <h2>Profil:</h2>
    <ul style="list-style-type: none; margin-left: 0;">
        <li><b><i class="fas fa-envelope"></i> E-postadress:</b> <i><?php echo $_SESSION['email']; ?></i></li>
        <li><b><i class="fas fa-phone"></i> Telefonnummer:</b> <i><?php echo $_SESSION['phonenumber']; ?></i></li>
        <li><b>Måste bli kontaktad via telefon?</b> <i><?php echo $_SESSION['contactvia']; ?></i></li>
    </ul>

        <!-- Admin -->
        <?php if($_SESSION['user_type'] == 'admin') : ?>
        
        <?php endif; ?>

        <!-- Employee -->
        <?php if($_SESSION['user_type'] == 'employee') : ?>

        <?php endif; ?>

        <!-- Customer -->
        <?php if($_SESSION['user_type'] == 'customer') : ?>
            <h2>Beviljade färdtjänstmedel:</h2>

            <ul>
                <!-- Vanlig resa -->
                <li>Vanlig resa</li>

                <!-- Ledsagare - yes -->
                <?php if ($_SESSION['ledsagare'] === 'yes' && isset($_SESSION['ledsagare'])) : ?>
                    <li>Ledsagare</li> 
                <?php else : ?>
                <?php endif; ?>

                <!-- Trappklättrare - yes -->
                <?php if ($_SESSION['trappklattrare'] === 'yes' && isset($_SESSION['trappklattrare'])) : ?>
                    <li>Trappklättrare</li>
                <?php else : ?>
                <?php endif; ?>

                <!-- Specialfordon - yes -->
                <?php if ($_SESSION['specialfordon'] === 'yes' && isset($_SESSION['specialfordon'])) : ?>
                    <li>Specialfordon</li> 
                <?php else : ?>
                <?php endif; ?>

                <!-- Arbetsresa - yes -->
                <?php if ($_SESSION['arbetsresa'] === 'yes' && isset($_SESSION['arbetsresa'])) : ?>
                    <li>arbetsresa</li> 
                <?php else : ?>
                <?php endif; ?>
            </ul>

        <?php endif; ?>
<?php 
// End - if the user is logged in.
endif; 
?>

    <div style="clear: both;"></div>
    </div><!-- end of #content -->
    <div style="clear: both;"></div>

<!-- Footer -->
<?php include("includes/footer.php"); ?>