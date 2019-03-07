<?php include("includes/config.php"); ?>
<!DOCTYPE html>
<html lang="sv">

<head>
    <?php 
        //Site title
        $site_title = "Östhammars kommun";
        $divider = " | ";
    ?>
    <title><?php echo $page_title . $divider . $site_title; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Favicons -->
    <link rel="icon" type="image/png" href="img/favicon.png">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

</head>

<body>
    <header>
        <!-- Skip to content (For users who navigate with tab and enter) -->
        <a class="skip" href="#content">
            Hoppa till innehållet<br>
            <i class="fas fa-chevron-down"></i>
        </a>
        
        <!-- Sitename -->
        <a class="headerLogo" href="index.php"></a>

        <!-- Main menu -->
        <?php include("includes/mainmenu.php"); ?>

        <!-- Searchform -->
        <form class="searchform">
            <input type="text" placeholder="Sök här..." name="search">
            <input type="submit" value="Sök">
        </form>
    </header>

    <!-- Margin content under the fixed header -->
    <div id="headerMargin"></div>

    <div id="container">
    
        <!-- Searchform mobile -->
        <form class="searchform2">
            <input type="text" placeholder="Sök här..." name="search">
            <input type="submit" value="Sök">
        </form>