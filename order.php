<?php session_start(); ?>
<!-- 
// Östhammars Kommun - Färdtjänst
// Beställningssida
// Author: Albin Rönnkvist
 -->

<!-- Header -->
<?php 
    $page_title = "Beställ resa online";
    include("includes/header.php");
?>  



<!-- If the user is not logged in -->
<?php 
if(!isset($_SESSION["myUsername"])) : 
?>  
    <!-- Sidebar -->
    <?php include("includes/sidebar.php") ?>

    <!-- Content -->
    <div id="content">

        <!-- Breadcrumbs -->
        <ul class="breadcrumbs">
            <li><a href="index.php">Start</a></li>
            <li><a href="orderinfo.php">Beställ resa</a></li>
            <li>Beställ resa online</li>
        </ul>

        <!-- Page title -->
        <h1><i class="fas fa-taxi"></i> <?php echo $page_title; ?></h1> 
        <hr>

        <!-- Log in -->
        <h2>Ej inloggad!</h2>
        <p>Du måste vara inloggad för att kunna använda dig av denna tjänst. Vänligen logga in nedan.</p>

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
                    echo "<p>" . "Fel lösenord eller användarnamn!" . "</p>";
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
        
        <div style="clear: both;"></div>

    </div><!-- end of #content -->
    <div style="clear: both;"></div>
<?php 
// End - if user is not logged in.
endif; 
?>



<!-- If they user is logged in -->
<?php
if(isset($_SESSION["myUsername"])) :
    $loginFromDB = new Users();
?>
    <!-- Sidebar -->
    <?php include("includes/sidebar.php") ?>
    
    <div id="content">

        <!-- Breadcrumbs -->
        <ul class="breadcrumbs">
            <li><a href="index.php">Start</a></li>
            <li><a href="orderinfo.php">Beställ resa</a></li>
            <li>Beställ resa online</li>
        </ul>

        <!-- Page title -->
        <h1><i class="fas fa-taxi"></i> <?php echo $page_title; ?></h1> 
        <hr>



        <!-- Info about ordering -->
        <h2>Hur gör jag?</h2>
        <p>Fyll i <a href="#order">"beställ resa online"-formuläret nedan <i class="fas fa-arrow-down"></i></a> och klicka på "Beställ"-knappen för att genomföra beställningen. Taxibolaget kontaktar sedan dig och bekräftar resan.<br></p>
        <br>
        <p><b><i class="fas fa-info-circle"></i> Info:</b> Färdtjänst beställs senast kl. 17:00 dagen innan avresa. 
            <?php
            //Om besökaren är beviljad trappklättrare
            if (isset($_SESSION['trappklattrare']) && $_SESSION['trappklattrare'] == 'yes') :
            ?>
                Trappklättrare beställs senast kl. 13:00 dagen innan avresa.
            <?php
            endif;
            ?>
        </p>
        <p>Gruppresor(medresenärer med färdtjänsttillstånd) kan endast beställas via färdtjänstväxeln.</p>



        <!-- Form for ordering -->
        <a id="order"></a>
        <h2>Beställ resa online:</h2>
        <form id="order-trip" class="order-form" action="confirm.php" method="post" onsubmit="return validate(this);">

            <!-- Destination -->
            <div class="input-container">
                <h3 class="h3-form"><i class="fas fa-map-marker-alt"></i> Jag vill resa:</h3>
                <div class="input-half">
                    Från:
                    <input type="text" name="destination-from" onfocus="this.value=''" placeholder="Skriv adress här..." required> 
                </div>
                <div class="input-half2">
                    Till:
                    <input type="text" name="destination-to" onfocus="this.value=''" placeholder="Skriv adress här..." required>
                </div>
            </div>
            
            <!-- Date / Time -->
            <div class="input-container">
            <h3 class="h3-form"><i class="fas fa-calendar-alt"></i> Datum / tid:</h3>
                <div class="input-half">
                    Datum (åååå-mm-dd)
                    <input type="text" name="date" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="input-half2">
                    Tid (hh:mm)
                    <input type="text" name="time" value="<?php echo date('H:i'); ?>" required>
                </div>

            </div>

            <!-- Passengers -->
            <div class="input-container">
                <h3 class="h3-form"><i class="fas fa-user-friends"></i> Medresenärer?</h3>

                <div class="input-margin"><input type="radio" name="passengers" id="mycheckbox" value="yes"> <span>Ja</span></div>
                <div class="input-margin"><input type="radio" name="passengers" id="mycheckbox2" value="no" checked="checked"> <span>Nej</span></div>

                <div id="mycheckboxdiv" style="display:none;">
                    <h4 class="h4-form">
                        <div class="popup" onclick="myPopupp()"><i class="fas fa-info-circle"></i>
                            <span style="font-size: 0.8em;" class="popuptext" id="myPopup">Läs mer nedan om regler för medresenärer</span>
                        </div> 
                        Typ av medresenärer:
                    </h4>
                     <?php
                    //Om besökaren är beviljad ledsagare
                    if (isset($_SESSION['ledsagare']) && $_SESSION['ledsagare'] == 'yes') :
                    ?>
                        <div class="input-margin"><input type="checkbox" id="ledsagare" name="ledsagare" value="check"> <span>Ledsagare</span></div>
                    <?php
                    endif;
                    ?>
                    <div class="input-margin"><input type="checkbox" id="nopermit" name="nopermit" value="check"> <span>Vuxna</span></div>
                    <div class="input-margin"><input type="checkbox" id="children" name="children" value="check"> <span>Barn(t.o.m. 19 år)</span></div>
                    <br>
                    
                    <div style="clear: both;"></div>
                    <div class="input-small-container">
                    <h4 class="h4-form">Antal medresenärer <span style="font-size: 0.8em;">(Alla typer)</span>:</h4>
                        <div class="input-small">
                            <input name="number" type="number" value="1" id="passengers-amount">
                        </div>
                    
                        <div style="clear: both;"></div>

                    <div id="mycheckboxdiv3" style="display:none;">
                        <h4 class="h4-form">Antal bilbarnstolar:</h4>
                            <div class="input-small">
                                <input name="bilbarnstol" type="number" value="0" id="passengers-amount">
                            </div>
                            <div style="clear: both;"></div>
                        <h4 class="h4-form">Ålder på barn:</h4>
                            <div class="input-half">
                                <input name="alder" type="text" id="alder" placeholder="Skriv ålder på barnet/barnen">
                            </div>
                    </div>
                    </div>
            
                </div>
            </div>

            <!-- Arbetsresa -->
            <?php
            //Om besökaren är beviljad arbetsresa
            if (isset($_SESSION['arbetsresa']) && $_SESSION['arbetsresa'] == 'yes') :
            ?>
            <div class="input-container">
                <h3 class="h3-form"><i class="fas fa-briefcase"></i> Arbetsresa?</h3>

                <div class="input-margin"><input type="radio" name="arbetsresa" value="yes"> <span>Ja</span></div>
                <div class="input-margin"><input type="radio" name="arbetsresa" value="no" checked="checked"> <span>Nej</span></div>
            </div>
            <?php
            endif;
            ?>
            
            <!-- Stegklättrare -->
            <?php
            //Om besökaren är beviljad trappklättrare
            if (isset($_SESSION['trappklattrare']) && $_SESSION['trappklattrare'] == 'yes') :
            ?>
            <div class="input-container">
                <h3 class="h3-form"><i class="fas fa-wheelchair"></i> Trappklättrare?</h3>

                <div class="input-margin"><input type="radio" name="stairclimber" <?php if (isset($stairclimber) && $stairclimber=="yes") echo "checked";?> id="mycheckbox3" value="yes"> <span>Ja</span></div>
                <div class="input-margin"><input type="radio" name="stairclimber" <?php if (isset($stairclimber) && $stairclimber=="no") echo "checked";?> id="mycheckbox4" value="no" checked="checked"> <span>Nej</span></div>

                <div id="mycheckboxdiv2" style="display:none;">
                    <p>(Ju mer information du ger vid bokningen desto bättre.)</p>
                    <h4 class="h4-form">Typ av rullstol:</h4>
                    <textarea placeholder="Beskriv vilken rullstol du har eftersom alla rullstolar inte fungerar till trappklättraren..." name="rullstol" id="rullstol"></textarea>
                    <h4 class="h4-form">Typ av trappor:</h4>
                    <textarea placeholder="Tala om vilken sorts trappor du har där hemma. Sneda, raka, svängda, trä osv..." name="trappa" id="trappa"></textarea>
            
                </div>
            </div>
            <?php
            endif;
            ?>

            <!-- Specialfordon -->
            <?php
            //Om besökaren är beviljad specialfordon
            if (isset($_SESSION['specialfordon']) && $_SESSION['specialfordon'] == 'yes') :
            ?>
            <div class="input-container">
                <h3 class="h3-form"><i class="fas fa-wheelchair"></i> Specialfordon?</h3>

                <div class="input-margin"><input type="radio" name="specialfordon" value="yes"> <span>Ja</span></div>
                <div class="input-margin"><input type="radio" name="specialfordon" value="no" checked="checked"> <span>Nej</span></div>
            </div>
            <?php
            endif;
            ?>

            <!-- Skrymmande hjälpmedel -->
            <?php
            //Om besökaren är beviljad skrymmande hjälpmedel
            if (isset($_SESSION['skrymmande']) && $_SESSION['skrymmande'] == 'yes') :
            ?>
            <div class="input-container">
                <h3 class="h3-form"><i class="fas fa-wheelchair"></i> Skrymmande hjälpmedel?</h3>

                <div class="input-margin"><input type="radio" name="skrymmande" value="yes"> <span>Ja</span></div>
                <div class="input-margin"><input type="radio" name="skrymmande" value="no" checked="checked"> <span>Nej</span></div>
            </div>
            <?php
            endif;
            ?>

            <!-- Submit order -->
            <input class="order" type="submit" name="order" value="Beställ">

            <!-- Clear form(disabled for now) -->
            <!-- <input type="button" onclick="resetForm()" value="Rensa formulär"> -->
            <!-- <script>// Reset form
                function resetForm() {
                    document.getElementById("order-trip").reset();
                }
            </script> -->
        </form>
        <p>
            <b><i class="fas fa-info-circle"></i> Info:</b>
            Vid frågor, ändringar eller avbokning av resa går det bra att kontakta växeln fram till klockan 20.00. Vänligen ring <a href="tel:+0173-74-74-10"><i class="fas fa-phone"></i> 0173-74 74 10</a>.
        </p>

        <?php include("includes/booking-form.php") ?>

        <div style="clear: both;"></div>

    </div><!-- end of #content -->
    <div style="clear: both;"></div>



    <!-- Booking rules -->
    <div id="rules-container">
    <hr>
        <div class="rules-left">
            <h2>Regler vid beställning:</h2>
            <h3>Var får man resa?</h3>
            <a id="cost-table"></a>
            <p>
                Den som har beviljats färdtjänst får resa inom kommunen, delar av angränsande kommuner och till / från Arlanda. 
                Alla färdtjänstresor börjar eller slutar alltid i Östhammars kommun.<br><br>
                Se kartan i <i>Figur 1</i> eller tabellen nedan för att se var du kan resa <i class="fas fa-arrow-down"></i>
            </p>
            <!-- Table for possible travels -->
            <p><b>Tabell med möjliga resmål och kostnader:</b></p>
            <table>
                <tr>
                    <th>Från</th>
                    <th>Till</th> 
                    <th>Kostnad</th>
                </tr>
                <tr>
                    <td>Östhammars Kommun</td>
                    <td>Östhammars Kommun</td> 
                    <td>30:-</td>
                </tr>
                <tr>
                    <td>Östhammars Kommun</td>
                    <td>Uppsala Kommun (del av)</td> 
                    <td>90:-</td>
                </tr>
                <tr>
                    <td>Östhammars Kommun</td>
                    <td>Norrtälje Kommun (del av)</td> 
                    <td>90:-</td>
                </tr>
                <tr>
                    <td>Östhammars Kommun</td>
                    <td>Tierps Kommun</td> 
                    <td>90:-</td>
                </tr>
                <tr>
                    <td>Östhammars Kommun</td>
                    <td>Arlanda</td> 
                    <td>150:-</td>
                </tr>

                <tr>
                    <td>Uppsala Kommun (del av)</td>
                    <td>Östhammars Kommun</td> 
                    <td>90:-</td>
                </tr>
                <tr>
                    <td>Norrtälje (del av)</td>
                    <td>Östhammars Kommun</td> 
                    <td>90:-</td>
                </tr>
                <tr>
                    <td>Tierps Kommun</td>
                    <td>Östhammars Kommun</td> 
                    <td>90:-</td>
                </tr>
                <tr>
                    <td>Arlanda</td>
                    <td>Östhammars Kommun</td> 
                    <td>150:-</td>
                </tr>
            </table>

            <h3>Vad kostar det?</h3>
            <p>Resorna kostar olika mycket beroende på var man vill åka, se <a href="#cost-table">tabell ovan <i class="fas fa-arrow-up"></i></a> för kostnader.</p>
            <p>Barn och ungdomar från och med 6 år till och med 19 år betalar halv avgift. Barn under 6 år reser alltid gratis.</p>

             <h3>Beställa resa</h3>
             <p>Du kan beställa en resa online i <a href="#order">formuläret ovan <i class="fas fa-arrow-up"></i></a> eller ringa färdtjänstväxeln på telefonnumret <a href="tel:+0173-74-74-10"><i class="fas fa-phone"></i> 0173-74 74 10</a>.</p>
             <br>
             <p>
                Du kan beställa din resa alla dagar mellan
                <i>kl 08:00 och 17:00</i>, senast dagen innan avresedagen.
                <br>
                Du har möjlighet att beställa din resa samma dag, men får då resa i mån av plats och till förhöjd avgift. Beställer du din resa på avresedagen kostar det 15 kronor extra.
            </p>

            <h3>Avbeställa resa</h3>
            <p>
                Vid frågor, ändringar eller avbokning av resa går det bra att kontakta växeln fram till klockan 20:00. Vänligen ring <a href="tel:+0173-74-74-10"><i class="fas fa-phone"></i> 0173-74 74 10</a>.
            </p>
            <p>Om du inte kan genomföra din resa och inte avbeställer den måste du i alla fall betala avgiften för den beräknade resan.</p>

            <h3>Medresenärer</h3>
            <ul>
                <li><p><b>Ledsagare</b>: Om du har rätt till ledsagare framgår av ditt beslut. Ledsagare reser alltid gratis.</li>
                <li><b>Vuxna</b>: Vuxna personer utan färdtjänsttillstånd kan resa tillsammans med dig om du anger detta när du beställer din resa.</li>
                <li><b>Barn</b>: Barn utan färdtjänsttillstånd kan resa tillsammans med dig om du anger detta när du beställer din resa. Då måste gu även ange ålder på barnet / barnen och om de behöver barnstol.</li>
                <li>
                    <b>Gruppresa</b>: Om ni är flera färdtjänstbeviljade resenärer kan ni beställa en gruppresa. Resan måste då göras mellan två adresser utan uppehåll. 
                    För gruppresan betalar ni bara en avgift per bil. Eventuella medresenärer (utan färdtjänsttillstånd) ingår aldrig i en gruppresa, utan måste alltid betala full avgift, enligt <a href="#cost-table">ovanstående tabell <i class="fas fa-arrow-up"></i></a>.
                    OBS! en gruppresa kan endast beställas via färdtjänstväxeln på telefonnumret <a href="tel:+0173-74-74-10"><i class="fas fa-phone"></i> 0173-74 74 10</a>.
                </li>
            </ul>

            <h3>Trappklättrare</h3>
            <p>
            Tillgång till trappklättrare finns enligt nya avtalet. Om du är beviljad trappklättrare av din handläggare, tänk på detta när  du behöver boka den:
            </p>
            <ul>
                <li><b>Bokning</b>: Boka den senast kl. 13:00 dagen innan, men helst så tidigt som möjligt då det behöver planeras.</li>
                <li><b>Typ av rullstol</b>: Tala om vilken rullstol du har eftersom alla rullstolar inte fungerar till trappklättraren.</li>
                <li><b>Typ av trappor</b>: Tala om vilken sorts trappor du har där hemma. Sneda, raka, svängda, trä osv.( Detta kontrolleras av färdtjänstleverantören innan du beviljats trappklättrare)</li>
                <li>Ju mer information du ger vid bokningen desto bättre.</li>
            </ul>

            <h3>Samordning</h3>
            <p>
                På grund av samordning kan din resa senare- eller tidigareläggas 60 minuter. Tid när du hämtas får du antingen i din e-postbekräftelse eller vid beställningstillfället om du bokar via telefonväxeln. Din totala restid kan som mest fördubblas på grund av samordning, men kan aldrig förlängas med mer än 60 minuter.
            </p>

            <h3>Arbetsresa</h3>
            <p>Eventuella arbetsresor måste innefattas i ditt beslut om färdtjänst. Om det gör det har du rätt till garanterad ankomsttid.</p>

            <h3>Specialfordon</h3>
            <p>Om du är beviljad specialfordon så kan du boka det. Specialfordon måste bokas om din rullstol / rullator är för stor för en vanlig bil.</p>

            <h3>Skrymmande hjälpmedel</h3>
            <p>Om du är beviljad skrymmande hjälpmedel så kan du ange det i bokningen. Då beställs en större bil för att kunna ta med ditt skrymmande hjälpmedel.</p>

        </div>

        <div class="rules-right">
            <h3>Karta</h3>
            <p>Karta över möjliga resmål:</p>
            <div class="image-map">
                <img src="img/karta.jpg" alt="karta över områden som man kan resa till med Östhammars kommuns färdtjänst">
                <p><i>Figur 1</i></p>
                <br>
            </div>
        </div>
    </div><!-- End of #rules-container -->
    <div style="clear: both;"></div>
    <br>
    <hr>

    <!-- Last updated -->
    <p><b><i class="far fa-clock"></i> Senast uppdaterad:</b> 2018-05-28</p>
    <br>

<?php 
// END - If the user is logged in.
endif; 
?> 

<!-- Footer -->
<?php include("includes/footer.php"); ?>