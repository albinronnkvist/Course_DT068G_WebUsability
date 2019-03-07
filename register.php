<?php session_start(); ?>
<!-- 
// Östhammars Kommun - Färdtjänst
// Registrera användare
// Author: Albin Rönnkvist
 -->

<!-- Header -->
<?php 
    $page_title = "Skapa";
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
if ((isset($_SESSION['myUsername']) && ($_SESSION['user_type'] == 'admin') || ($_SESSION['user_type'] == 'employee'))) :
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
                <li><a href="users.php">Hantera användare</a></li>
                <li>Skapa</li>
            <?php
            endif;
            ?>

            <!-- Logged in as employee -->
            <?php
            if($_SESSION['user_type'] == 'employee') :
            ?>  
                <li><a href="users.php">Hantera kunder</a></li>
                <li>Skapa</li>
            <?php
            endif;
            ?>
        </ul>

        <!-- Page title -->
        <h1><i class="fas fa-user-plus"></i> <?php echo $page_title; ?></h1> 
        <hr>
    
        <!-- Logged in as employee -->
        <?php
            if($_SESSION['user_type'] == 'admin') :
        ?>  
            <h2>Skapa ny användare:</h2>
        <?php
        endif;
        ?>

        <!-- Logged in as employee -->
        <?php
            if($_SESSION['user_type'] == 'employee') :
        ?>  
            <h2>Skapa ny kund:</h2>
        <?php
        endif;
        ?>

        <!-- Form to register new user -->
        <form class="order-form" action="#" method="post">

            <!-- Personal information -->
            <h4 class="h4-form">Personlig info:</h4>
            <div class="popup" onclick="myPopupp()"><i class="fas fa-info-circle"></i>
                    <span class="popuptext" id="myPopup">Endast siffrorna 0-9. Inga bokstäver, tecken eller mellanslag. <br> Exempel: 199712240084</span>
            </div>
            Personnummer:<br>
            <input type="text" name="username" pattern="[0-9]{12}" required placeholder="ååååmmddxxxx">
            <br>
            Lösenord:<br>
            <input type="password" name="password" required>
            <br>
            Förnamn:<br>
            <input type="text" name="firstname" required>
            <br>
            Efternamn:<br>
            <input type="text" name="lastname" required>
            <br>
            E-postadress:<br>
            <input type="text" name="email" required placeholder="example@hotmail.com">
            <br>
            Telefonnummer:<br>
            <input type="text" name="phonenumber" required placeholder="0725059834">
            <br>
            Måste bli kontaktad via samtal vid beställningsbekräftelse?<br>
            <input type="radio" name="contactvia" value="Ja"> <span>Ja</span>
            <input type="radio" name="contactvia" value="Nej" checked="checked"> <span>Nej</span>
            <br><br>

            <!-- Type of user -->
            <label>Typ av användare:</label>
            <select name="user_type" id="user_type" >
                <option value="customer">Kund</option>

                <!-- If the user is logged in as admin -->
                <?php
                if (isset($_SESSION['myUsername']) && $_SESSION['user_type'] == 'admin' ) :
                ?>
                    <option value="employee">Färdtjänsthandläggare</option>
                    <option value="admin">Administratör</option>
                <?php 
                endif; 
                ?> 
            </select>
            <br><br>

            <!-- Grant wherewithal -->
            <h4 class="h4-form">Bevilja färdtjänstmedel:</h4>
            Beviljad trappklättrare?
            <input type="radio" name="trappklattrare" value="yes"> <span>Ja</span>
            <input type="radio" name="trappklattrare" value="no" checked="checked"> <span>Nej</span>
            <br>
            Beviljad specialfordon?
            <input type="radio" name="specialfordon" value="yes"> <span>Ja</span>
            <input type="radio" name="specialfordon" value="no" checked="checked"> <span>Nej</span>
            <br>
            Beviljad arbetsresa?
            <input type="radio" name="arbetsresa" value="yes"> <span>Ja</span>
            <input type="radio" name="arbetsresa" value="no" checked="checked"> <span>Nej</span>
            <br>
            Beviljad ledsagare?
            <input type="radio" name="ledsagare" value="yes"> <span>Ja</span>
            <input type="radio" name="ledsagare" value="no" checked="checked"> <span>Nej</span>
            <br>
            Beviljad skrymmande hjälpmedel?
            <input type="radio" name="skrymmande" value="yes"> <span>Ja</span>
            <input type="radio" name="skrymmande" value="no" checked="checked"> <span>Nej</span>
            <br>
            <br>
            <input type="checkbox" name="confirm" required> Användaren som ska registreras har blivit informerad om hur dess data kommer lagras och godkänner det.
            <br>

            <!-- Submit new user -->
            <input type="submit" name="register" value="Skapa">

        </form><!-- End of register-form -->
        <div style="clear: both;"></div>

        <!-- Store new user -->
        <?php

            //Create new instance of the class User
            $register = new Users();

            //Register
            if(isset($_POST['register']) && isset($_POST['confirm'])){
                $username = $_POST['username'];
                $user_type = $_POST['user_type'];
                $password = $_POST['password'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
                $phonenumber = $_POST['phonenumber'];
                $trappklattrare = $_POST['trappklattrare'];
                $specialfordon = $_POST['specialfordon'];
                $arbetsresa = $_POST['arbetsresa'];
                $ledsagare = $_POST['ledsagare'];
                $contactvia = $_POST['contactvia'];
                $skrymmande = $_POST['skrymmande'];

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if($register->takenUsername($username)){
                        echo "<h1 style='color: red; class='pError'>Användarnamnet är upptaget!</h1>";
                    }

                    if($register->storeUser($username, $user_type, $password, $firstname, $lastname, $email, $phonenumber, $trappklattrare, $specialfordon, $arbetsresa, $ledsagare, $contactvia, $skrymmande)){
                        echo "<script> window.location.href = 'register-confirm.php'; </script>";
                    }
                    else{
                        echo "<h1 style='color: red; class='pError'>Fel vid lagring!</h1>";
                    }
                }
                elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo("<p style='color: red; class='pError'>" . "<b>$email</b> är inte en giltig e-postadress!" . "</p>");
                }
            }
        ?>

    </div><!-- end of #content -->
    <div style="clear: both;"></div>

<?php 
// End - if the user has authority
endif; 
?> 

<!-- Footer -->
<?php include("includes/footer.php"); ?>