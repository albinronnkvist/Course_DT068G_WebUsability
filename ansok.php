<?php session_start(); ?>
<!-- 
// Östhammars Kommun - Färdtjänst
// Ansök om färdtjänst
// Author: Albin Rönnkvist
 -->

<!-- Header -->
<?php 
    $page_title = "Ansök";
    include("includes/header.php");
?> 
    <!-- Sidebar -->
    <?php include("includes/sidebar.php") ?>
    
    <!-- Content -->
    <div id="content">

        <!-- Breadcrumbs -->
        <ul class="breadcrumbs">
            <li><a href="index.php">Start</a></li>
            <li>Ansök</li>
        </ul>

        <!-- Page title -->
        <h1><i class="fas fa-arrow-circle-right"></i> <?php echo $page_title; ?></h1> 
        <hr>

        <!-- Appliance -->
        <h2>Ansökan:</h2>
        <p>Du eller den person som företräder dig fyller i blanketten <i>ansökan om färdtjänst</i> nedan. Du ska också skicka med ett <i>läkarutlåtande</i> avseende färdtjänst. Färdtjänsthandläggaren utreder sedan ditt behov och beslutar om du har rätt till färdtjänst.</p><br>
        <p>Följ instruktionerna i blanketten som bifogas nedan.</p>
        <p><a href="https://www.osthammar.se/globalassets/dokument/blanketter/blankett-fardtjanst-ansokan.pdf" target="_blank">Ansökan om färdtjänst <i class="fas fa-file-pdf"></i></a>.</p>
        
        <h2>Att tänka på:</h2>
        <h3 class="h3First">Vem kan beviljas färdtjänst?</h3>
        <p><b>Du kan ansöka färdtjänst om:</b></p>
        <ul>
            <li>du är folkbokförd i Östhammars kommun</li>
            <li>du har ett funktionshinder som gör det väldigt svårt för dig att förflytta dig eller resa med kollektivtrafik</li>
            <li>ditt funktionshinder är bestående, i minst tre månader eller längre.</li>
        </ul>
        <p>Du har inte rätt till färdtjänst enbart på grund av att det saknas kollektivtrafik där du ska resa. 
            Färdtjänst är särskilt anordnade transporter för personer med funktionshinder och omfattar inte transporter som bekostas av det allmänna, till exempel skolresor och sjukresor.</p>

        <h3>Om du får avslag på din ansökan</h3>
        <p>Om du får ett avslag på din ansökan har du rätt att överklaga ditt beslut. Information om hur du överklagar får du i samband med avslaget.</p>
    
    <div style="clear: both;"></div>
    </div><!-- end of #content -->
    <div style="clear: both;"></div>
    <hr>

    <!-- Last updated -->
    <p><b><i class="far fa-clock"></i> Senast uppdaterad:</b> 2018-05-28</p>
    <br>

<!-- Footer -->
<?php include("includes/footer.php"); ?>