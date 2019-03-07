<?php session_start(); ?>
<!-- 
// Östhammars Kommun - Färdtjänst
// Redigera användare
// Author: Albin Rönnkvist
 -->

<!-- Header -->
<?php 
    include("includes/header.php");

    if(isset($_GET['updateID'])){
        $id = $_GET['updateID'];
    }
    else{
        echo("<script>
            window.location = 'index.php';
        </script>");
    }

    $user = new Users();

    $usernameFullname = $user->getFullname($id);

    $page_title = $usernameFullname['firstname'] . " " . $usernameFullname['lastname'];
?>  

    <!-- Sidebar -->
    <?php include("includes/sidebar.php") ?>
    
    <div id="content">

        <!-- Breadcrumbs -->
        <ul class="breadcrumbs">
            <li><a href="index.php">Start</a></li>

            <!-- Logged in as admin-->
            <?php
            if($_SESSION['user_type'] == 'admin') :
            ?>
                <li><a href="users.php">Hantera användare</a></li>
                <li><a href="userlist.php">Redigera</a></li>
                <li><?php echo $page_title ?></li>
            <?php
            endif;
            ?>

            <!-- Logged in as employee -->
            <?php
            if($_SESSION['user_type'] == 'employee') :
            ?>  
                <li><a href="users.php">Hantera kunder</a></li>
                <li><a href="userlist.php">Redigera</a></li>
                <li><?php echo $page_title ?></li>
            <?php
            endif;
            ?>
        </ul>

        <!-- Page title -->
        <h1><i class="fas fa-user-edit"></i> <?php echo $page_title; ?></h1> 
        <hr>

        <?php
            if($_SESSION['user_type'] == 'employee') :
        ?>  
            <!-- Update user -->
            <?php
    
                $specificUser = new Users();

                $updateUser = $specificUser->getSpecificUser($id);

                $username = $updateUser['username'];
                $user_type = $updateUser['user_type'];
                $password = $updateUser['password'];
                $firstname = $updateUser['firstname'];
                $lastname = $updateUser['lastname'];
                $email = $updateUser['email'];
                $phonenumber = $updateUser['phonenumber'];
                $trappklattrare = $updateUser['trappklattrare'];
                $specialfordon = $updateUser['specialfordon'];
                $arbetsresa = $updateUser['arbetsresa'];
                $ledsagare = $updateUser['ledsagare'];
                $contactvia = $updateUser['contactvia'];
                $skrymmande = $updateUser['skrymmande'];

                //Update
                if(isset($_POST['update']) && isset($_POST['confirm'])){
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
    
                        if($specificUser->updateUser($username, $user_type, $password, $firstname, $lastname, $email, $phonenumber, $trappklattrare, $specialfordon, $arbetsresa, $ledsagare, $contactvia, $skrymmande, $id)){
                            echo "<script> window.location.href = 'update-user-confirm.php?updatedID=" . $username . "'; </script>";
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

            <!-- Form to register new user -->
            <h2>Redigera <?php echo $page_title ?>:</h2>
            <form class="order-form" action="#" method="post">
    
                <!-- Personal information -->
                <h4 class="h4-form">Personlig info:</h4>
                <div class="popup" onclick="myPopupp()"><i class="fas fa-info-circle"></i>
                        <span class="popuptext" id="myPopup">Endast siffrorna 0-9. Inga bokstäver, tecken eller mellanslag. <br> Exempel: 199712240084</span>
                </div>
                Personnummer:<br>
                <input type="text" name="username" pattern="[0-9]{12}" required value="<?= $username; ?>">
                <br>
                Lösenord:<br>
                <input type="password" name="password" required value="<?= $password; ?>">
                <br>
                Förnamn:<br>
                <input type="text" name="firstname" required value="<?= $firstname; ?>">
                <br>
                Efternamn:<br>
                <input type="text" name="lastname" required value="<?= $lastname; ?>">
                <br>
                E-postadress:<br>
                <input type="text" name="email" required value="<?= $email; ?>">
                <br>
                Telefonnummer:<br>
                <input type="text" name="phonenumber" value="<?= $phonenumber; ?>">
                <br>
                Måste bli kontaktad via samtal vid beställningsbekräftelse?<br>
                <input type="radio" name="contactvia" id="contactja" value="Ja"> <span>Ja</span>
                <input type="radio" name="contactvia" id="contactnej" value="Nej"> <span>Nej</span>
                <br><br>

                <!-- Type of user -->
                <label>Typ av användare:</label>
                <select name="user_type" id="user_type" >
                    <option value="<?= $user_type; ?>">Kund</option>

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
                <input type="submit" name="update" value="Uppdatera">
    
            </form><!-- End of register-form -->
            <div style="clear: both;"></div>

    <?php 
    endif; 
    ?>

    </div><!-- end of #content -->
    <div style="clear: both;"></div>

<!-- Footer -->
<?php include("includes/footer.php"); ?>