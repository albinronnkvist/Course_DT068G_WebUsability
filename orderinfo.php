<?php session_start(); ?>
<!-- 
// Östhammars Kommun - Info om beställning
// Regler
// Author: Albin Rönnkvist
 -->

<!-- Header -->
<?php 
    $page_title = "Beställ resa";
    include("includes/header.php");
?>  
    <!-- Sidebar -->
    <?php include("includes/sidebar.php") ?>

    <!-- Content -->
    <div id="content">
        <ul class="breadcrumbs">
            <li><a href="index.php">Start</a></li>
            <li>Beställ resa</li>
        </ul>

        <!-- Page title -->
        <h1><i class="fas fa-taxi"></i> <?php echo $page_title; ?></h1> 
        <hr>

        <!-- Order trip -->
        <h2>Hur beställer jag?</h2>
        <ul>
            <li>Beställ resa online via webbtjänsten. <a href="order.php">Beställ resa online <i class="fas fa-arrow-right"></i></a>.</li>
            <li>Eller ring färdtjänstväxeln på <a href="tel:+0173-74-74-10"><i class="fas fa-phone"></i> 0173-74 74 10</a>.</li>
        </ul>
        <p>
            <b><i class="fas fa-info-circle"></i> Info:</b> 
            Färdtjänst bokas senast kl. 17:00 dagen innan avresa. Trappklättrare bokas senast kl. 13:00 dagen innan avresa.
        </p>
        <br>
        <p>
            Vid frågor, ändringar eller avbokning av resa går det bra att kontakta växeln fram till klockan 20:00. Vänligen ring <a href="tel:+0173-74-74-10"><i class="fas fa-phone"></i> 0173-74 74 10</a>.
        </p>
        <div style="clear: both;"></div>

    </div><!-- end of #content -->
    <div style="clear: both;"></div>



    <!-- Booking rules -->
    <div id="rules-container">
    <hr>
        <div class="rules-left">
            <h2>Regler vid beställning:</h2>
            <h3>Vem får beställa?</h3>
            <?php if (!isset($_SESSION['myUsername'])) : ?>
            <p>Du måste vara beviljad färdtjänst för att kunna beställa en färdtjänstresa.</p><p><a href="ansok.php">Ansök om färdtjänst <i class="fas fa-arrow-right"></i></a>.</p><br>
            <?php endif; ?>
            <p>Du eller personen som företräder dig gör beställningen.</p>
            <h3>Var får man resa?</h3>
            <a id="cost-table"></a>
            <p>
                Den som har beviljats färdtjänst får resa inom kommunen, delar av angränsande kommuner och till / från Arlanda. 
                Alla färdtjänstresor börjar eller slutar alltid i Östhammars kommun.<br><br>
                Se kartan i <i>Figur 1</i> eller tabellen nedan för att se var du kan resa <i class="fas fa-arrow-down"></i>.
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
            <p><a href="order.php">Beställ en resa online via webbtjänsten <i class="fas fa-arrow-right"></i></a> eller ringa färdtjänstväxeln på telefonnumret <a href="tel:+0173-74-74-10"><i class="fas fa-phone"></i> 0173-74 74 10</a>.</p>
            <br>
            <p>
                Beställer du via webbtjänsten så fyller du i ett formulär och klickar på "Beställ" för att genomföra beställningen av resan. Information om beställning får du vid genomförandet.
                Beställer du via färdtjänstväxeln så får du även information om beställningen under genomförandet.
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
    </div><!-- End of #rules-container-->
    <div style="clear: both;"></div>
    <br>
    <hr>

    <!-- Last updated -->
    <p><b><i class="far fa-clock"></i> Senast uppdaterad:</b> 2018-05-28</p>
    <br>

<!-- Footer -->
<?php include("includes/footer.php"); ?>