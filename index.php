<?php session_start(); ?>
<!-- 
// Östhammars Kommun - Färdtjänst
// Startsida
// Author: Albin Rönnkvist
 -->

<!-- Header -->
<?php 
    $page_title = "Färdtjänst";
    include("includes/header.php");
?>  
    <!-- Sidebar -->
    <?php include("includes/sidebar.php") ?>

    <!-- Popup window with info about the website -->
    <script>
        // Save data to sessionStorage
        sessionStorage.setItem('firstVisit', '1');

        // Overlay onload
        $(function(){

            var isshow = localStorage.getItem('isshow');
            if (isshow== null) {

                localStorage.setItem('isshow', 1);
                var overlay = $('<div id="overlay"></div>');
                overlay.show();
                overlay.appendTo(document.body);
                    $('.popupOnload').show();
                    
            }

            $('.close').click(function(){
                $('.popupOnload').hide();
                    overlay.appendTo(document.body).remove();
                    return false;
            });
                
            $('.x').click(function(){
                $('.popupOnload').hide();
                    overlay.appendTo(document.body).remove();
                    return false;
                });
        });
    </script>

    <!-- Onload popup -->
    <div class='popupOnload'>
        <div class='cnt223'>
            <h1>OBS!</h1>
            <p>
                Detta är inte Östhammar Kommuns officiella webbplats utan endast ett skolprojekt i utbildningssyfte.
                <br/>
                <br/>
                <a href='' class='close'>Stäng</a>
            </p>
        </div>
    </div>

    <!-- Content -->
    <div id="content">

        <!-- Page title -->
        <h1><i class="fas fa-home"></i> <?php echo $page_title; ?></h1> 
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
    <h2>Beställ färdtjänstresa:</h2>
    <ul>
        <li>Beställ färdtjänstresa online via webbtjänsten. <a href="order.php">Beställ resa online <i class="fas fa-arrow-right"></i></a></li>
        <li>Eller ring färdtjänstväxeln på <a href="tel:+0173-74-74-10"><i class="fas fa-phone"></i> 0173-74 74 10</a>.</li>
    </ul>
    <p><a href="orderinfo.php">Mer information om beställning av färdtjänstresa <i class="fas fa-arrow-right"></i></a></p>
<?php 
endif; 
?>



<!-- If they user is not logged in -->
<?php 
if(!isset($_SESSION["myUsername"])) : 
?>  
    <h2>Vad är färdtjänst?</h2>
        <p>Färdtjänst är särskilt anordnade transporter för personer med funktionshinder och omfattar inte transporter som bekostas av det allmänna, till exempel skolresor och sjukresor.</p>
    <h2>Beställ färdtjänstresa:</h2>
        <p>Du som är beviljad färdtjänst kan beställa en färdtjänstresa antingen på telefon eller online via våran webbtjänst. <a href="orderinfo.php">Beställ en färdtjänstresa <i class="fas fa-arrow-right"></i></a></p>
    <h2>Ansök om färdtjänst:</h2>
        <p>Du måste var beviljad färdtjänst för att kunna beställa en färdtjänstresa. <a href="ansok.php">Ansök om färdtjänst<i class="fas fa-arrow-right"></i></a></p>
<?php 
endif; 
?>

    </div><!-- end of #content -->
    <div style="clear: both;"></div>

<!-- Footer -->
<?php include("includes/footer.php"); ?>