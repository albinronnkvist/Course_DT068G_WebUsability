<?php session_start(); ?>
<!-- 
// Östhammars Kommun - Bekräfta beställning av färdtjänst
// Startsida
// Author: Albin Rönnkvist
 -->

<!-- Header -->
<?php 
    $page_title = "Bekräftelse av bokning";
    include("includes/header.php");
?>  

    <!-- Content  -->
    <div id="content">
        
        <!-- Breadcrumbs -->
        <ul class="breadcrumbs">
            <li><a href="index.php">Start</a></li>
            <li><a href="orderinfo.php">Beställ resa</a></li>
            <li><a href="order.php">Beställ resa online</a></li>
            <li>Beställning genomförd</li>
        </ul>

<?php include("includes/booking-form.php") ?>




<!-- Send mail -->
<?php
    if (isset($_POST["order"])) {

        $to = 'albinflp@gmail.com';
        $subject = 'Färdtjänstbokning';
        $from = 'support@albinronnkvist.se';
        
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // Create email headers
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();
        
        // Compose a simple HTML email message
        $bookingInfo2 = '<html><body>';
        $bookingInfo2 .= '<h1 style="color:#0078F0; font-size: 3em">Beställning - Färdtjänst</h1>';
        $bookingInfo2 .= '<h2 style="color:#262626;">Resmål</h2>';
        $bookingInfo2 .= '<p style="color:#333;font-size:16px;"><b>Från: </b>' . $destinationFrom . '</p>' . "\n";
        $bookingInfo2 .= '<p style="color:#333;font-size:16px;"><b>Till: </b>' . $destinationTo . '</p>' . "\n";
        $bookingInfo2 .= '<h2 style="color:#262626;">Upphämtning</h2>';
        $bookingInfo2 .= '<p style="color:#333;font-size:16px;"><b>Datum: </b>' . $date . '</p>' . "\n";
        $bookingInfo2 .= '<p style="color:#333;font-size:16px;"><b>Klockslag: </b>' . $time . '</p>' . "\n\n";
        $bookingInfo2 .= '<h2 style="color:#262626;">Medresenärer</h2>';
        $bookingInfo2 .= '<p style="color:#333;font-size:16px;"><b>' . $passengers . '</b>' . $number . '</p>' . "\n";
        $bookingInfo2 .= '<p style="color:#333;font-size:16px;"><b>' . $passengersInfo . '</b>' . $ledsagare . $noPermit . $children . '</p>' . "\n";
        $bookingInfo2 .= '<p style="color:#333;font-size:16px;"><b>' . $childseatInfo . '</b>' . $childseat. '</p>' . "\n";
        $bookingInfo2 .= '<p style="color:#333;font-size:16px;"><b>' . $alderInfo . '</b>' . $alder . '</p>' . "\n";
        $bookingInfo2 .= '<h2 style="color:#262626;">Färdtjänstmedel</h2>';
        $bookingInfo2 .= '<p style="color:#333;font-size:16px;"><b>' . $arbetsresaInfo . '</b>' . $arbetsresa . '</p>' . "\n";
        $bookingInfo2 .= '<p style="color:#333;font-size:16px;"><b>' . $specialfordonInfo . '</b>' . $specialfordon . '</p>' . "\n";
        $bookingInfo2 .= '<p style="color:#333;font-size:16px;"><b>' . $skrymmandeInfo . '</b>' . $skrymmande . '</p>' . "\n";
        $bookingInfo2 .= '<p style="color:#333;font-size:16px;"><b>' . $stairclimberInfo . '</b>' . $stairclimber . '</p>' . "\n";
        $bookingInfo2 .= '<p style="color:#333;font-size:16px;"><b>' . $rullstolInfo . '</b>' . $rullstol . '</p>' . "\n";
        $bookingInfo2 .= '<p style="color:#333;font-size:16px;"><b>' . $trappaInfo . '</b>' . $trappa . '</p>' . "\n\n";
        $bookingInfo2 .= '<h2 style="color:#262626;">Personuppgifter</h2>';
        $bookingInfo2 .= '<p style="color:#333;font-size:16px;"><b>' . "Namn: " . '</b>' . $_SESSION['firstname'] . " " . $_SESSION['lastname'] . '</p>' . "\n";
        $bookingInfo2 .= '<p style="color:#333;font-size:16px;"><b>' . "E-postadress: " . '</b>' . $_SESSION['email'] . '</p>' . "\n";
        $bookingInfo2 .= '<p style="color:#333;font-size:16px;"><b>' . "Telefonnummer: " . '</b>' . $_SESSION['phonenumber'] . '</p>' . "\n";
        $bookingInfo2 .= '<p style="color:#333;font-size:16px;"><b>' . "Måste få bekräftelse via samtal?: " . '</b>' . $_SESSION['contactvia'] . '</p>' . "\n";
        $bookingInfo2 .= '<p style="color:#333;font-size:12px;">' . 'Vill kunden ha beställningsbekräftelsen via samtal så måste den få det. Annars är det inte ett krav.' . '</p>' . "\n";
        $bookingInfo2 .= '</body></html>';
   
        

        //If the Email was sent successfully, inform the user.
        if(mail($to, $subject, $bookingInfo2, $headers)){
            echo "<h1 style='color: #5cb85c;'><i class='fas fa-check-circle'></i> Beställning genomförd!</h1>";
            echo "<h2>Vad händer nu?</h2>";
            echo "<p>
                    Vi kommer nu hantera din beställning och återkommer inom kort med information till dig via E-post eller telefon.
                </p>";
            echo "<h2>Översikt av beställning</h2>";
            echo "<h3>Resmål</h3>";
            echo "<b>Från:</b> " . $destinationFrom . "<br>"; 
            echo "<b>Till:</b> " . $destinationTo . "<br>"; 
            echo "<h3>Upphämtning</h3>";
            echo "<b>Datum:</b> " . $date . "<br>";
            echo "<b>Klockslag:</b> " . $time . "<br>";
            echo "<h3>Medresenärer</h3>";
            echo "<b>" . $passengers . "</b>" . $number . "<br>";
            echo "<b>" . $passengersInfo . "</b>" . $ledsagare . $noPermit . $children . "<br>";
            if(!empty($alderinfo) && !empty($alder)) {
                echo "<b>" . $alderInfo. "</b>" . $alder . "<br>";
            }
            if(!empty($childseatinfo) && !empty($childseat)) {
                echo "<b>" . $childseatInfo . "</b>" . $childseat. "<br>";
            }
            echo "<h3>Färdtjänstmedel</h3>";
            if(!empty($arbetsresaInfo) && !empty($arbetsresa)) {
                echo "<b>" . $arbetsresaInfo . "</b>"  . $arbetsresa . "<br>";
            }
            if(!empty($specialfordonInfo) && !empty($specialfordon)) {
                echo "<b>" . $specialfordonInfo . "</b>"  . $specialfordon . "<br>";
            }
            if(!empty($skrymmandeInfo) && !empty($skrymmande)) {
                echo "<b>" . $skrymmandeInfo . "</b>" . $skrymmande . "<br>";
            }
            if(!empty($stairclimberInfo) && !empty($stairclimber)) {
                echo "<b>" . $stairclimberInfo . "</b>"  . $stairclimber . "<br>";
            }
            if(!empty($rullstolInfo) && !empty($rullstol)) {
                echo "<b>" . $rullstolInfo . "</b>" . $rullstol . "<br>";
            }
            if(!empty($trappaInfo) && !empty($trappa)) {
                echo "<b>" . $trappaInfo. "</b>"  . $trappa . "<br>";
            }
            echo "<hr>";

            // More info
            echo '<p><b><i class="fas fa-info-circle"></i> Info:</b>
            Vid frågor, ändringar eller avbokning av resa går det bra att kontakta växeln fram till klockan 20.00. Vänligen ring <a href="tel:+0173-74-74-10">0173-74 74 10</a>.</p><br>';
            echo "<p><a href='index.php'><i class='fas fa-arrow-left'></i> Tillbaka till startsidan</a></p><br><br>";

            // log out
            if(isset($_GET['logOut'])){
                $loginFromDB->logOutUser($username);
                echo "<script> window.location.href = 'index.php'; </script>";
            }
            echo '<a class="aButton" href="?logOut">Logga ut <i class="fas fa-sign-out-alt"></i></a><br>';
        }




        //If they Email was not sent, inform the user.
        else{
            echo "<h1 style='color: red;'><i class='far fa-times-circle'></i> Mailet skickades INTE.</h1>";
            echo "<p>Något gick fel vid beställningen.</p>";
            echo "<p><a href='order.php'>Försök igen</a> eller beställ via färdtjänstväxeln på <a href='tel:+0173-74-74-10'><i class='fas fa-phone'></i> 0173-74 74 10</a></p>";
        }
    }
?>

    <div style="clear: both;"></div>
    </div><!-- end of #content -->
    <div style="clear: both;"></div>

<!-- Footer -->
<?php include("includes/footer.php"); ?>