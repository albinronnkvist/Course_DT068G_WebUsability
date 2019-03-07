<?php
    // define variables and set to empty values
    $destinationFromErr = $destinationToErr = $passengersErr = $numberErr = $rullstolErr = $trappaErr = "";
    
    $destinationFrom = $destinationTo = $date = $time = $passengers = $passengersInfo =
    $stairclimber = $stairclimberInfo = $rullstol = $rullstolInfo  = $trappa = $trappaInfo = 
    $number = $ledsagareinfo = $ledsagare = $noPermitInfo = $noPermit = $childseatInfo = $childseat = 
    $arbetsresaInfo = $arbetsresa = $specialfordonInfo = $specialfordon = $skrymmandeInfo = $skrymmande = $children = $alderInfo = $alder = "";
    
        
    if ($_SERVER["REQUEST_METHOD"] == "POST") {



        /*
        DESTINATION
        */
        // Destination från
        if (empty($_POST["destination-from"])) {
            $destinationFromErr = "Du måste fylla i var du vill bli upphämtad";
        } 
        else {
            $destinationFrom = test_input($_POST["destination-from"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$destinationFrom)) {
                $destinationFromErr = "Only letters and white space allowed"; 
            }
        }
        
        // Destination till
        if(isset($_POST["destination-to"])) {

            if (empty($_POST["destination-to"])) {
                $destinationToErr = "Du måste fylla i var du vill åka.";
            } 
            else {
                $destinationTo = test_input($_POST["destination-to"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/",$destinationTo)) {
                    $destinationToErr = "Only letters and white space allowed"; 
                }
            }
        }



        /*
        DATUM OCH TID
        */
        // Datum
        if (empty($_POST["date"])) {
            $dateErr = "Du måste fylla i datum för upphämtning.";
        } 
        else {
            $date = test_input($_POST["date"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$date)) {
                $dateErr = "Only letters and white space allowed"; 
            }
        }

        // Tid
        if (empty($_POST["time"])) {
            $timeErr = "Du måste fylla i tid för upphämtning.";
        } 
        else {
            $time = test_input($_POST["time"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$time)) {
                $timeErr = "Only letters and white space allowed"; 
            }
        }                



        /*
        MEDRESENÄRER
        */
        // Medresenärer ja/nej
        if (test_input($_POST["passengers"]) == "no") {
            $passengers = "Antal medresenärer: ";
            $number = $_POST["number"];
            $passengersInfo = "";
        } 
        else {
            $passengers = "Antal medresenärer: ";
            $number = $_POST["number"];
            $passengersInfo = "Typ av medresenärer: ";
        }

            // Antal Medresenärer
            if (test_input($_POST["passengers"]) == "yes" && empty($_POST["number"])) {
                $numbersErr = "Du måste ange ett antal medresenärer.";
                $passengers = "Antal medresenärer: ";
                $number = 0;
            } 
            else {
                $passengers = "Antal medresenärer: ";
                $number = $_POST["number"];
            }

            // Antal Medresenärer - om inga medresenärer är valda
            if (test_input($_POST["passengers"]) == "no") {
                $numbersErr = "";
                $number = "0";
            } 

            // Ledsagare ja/nej
            if (!isset($_POST['ledsagare'])) {
                $ledsagareInfo = "";
                $ledsagare = "";
            } else {
                $ledsagareInfo = "Ledsagare: ";
                $ledsagare = "Ledsagare, ";
            }

            // Person utan "färdtjänsttillstånd" ja/nej
            if (!isset($_POST['nopermit'])) {
                $noPermitInfo = "";
                $noPermit = "";
            } else {
                $noPermitInfo = "Vuxen ";
                $noPermit = "Vuxen, ";
            }

            // Barn utan "färdtjänsttillstånd" ja/nej
            if (!isset($_POST['children'])) {
                $children = "";
            } else {
                $children = "Barn";
            }

                // Beskrivning av barn
                if (empty($_POST["alder"])) {
                    $alder = "";
                    $alderInfo = "";
                } else {
                    $alderInfo = "Beskrivning av barn: ";
                    $alder = test_input($_POST["alder"]);
                }

                // Bilbarnstol ja/nej
                if (test_input($_POST["bilbarnstol"]) == "0" || (test_input($_POST["passengers"]) == "no") || empty($_POST["bilbarnstol"])) {
                    $childseatInfo = "";
                    $childseat = "";
                } 
                else {
                    $childseatInfo = "Antal bilbarnstolar: ";
                    $childseat = $_POST["bilbarnstol"];
                }



        /*
        STEGKLÄTTRARE
        */
        //Stegklättrare ja/nej
        if (test_input($_POST["stairclimber"]) == "no" || empty($_POST["stairclimber"])) {
            $stairclimberInfo = "";
            $stairclimber = "";
        } 
        else {
            $stairclimberInfo = "Trappklättrare: ";
            $stairclimber = "Ja";
        }

            // Beskrivning av rullstol - om segklättrare är ifyllt med "ja"
            if (test_input($_POST["stairclimber"]) == "yes" && empty($_POST["rullstol"])) {
                $rullstolInfo = "Info om rullstol: ";
                $rullstol = "Ingen information om trappklättrare har fyllts i.";
                $rullstolErr = "Du måste beskriva din typ av rullstol.";
            } else {
                $rullstolInfo = "Info om rullstol: ";
                $rullstol = test_input($_POST["rullstol"]);
            }
            
            // Beskrivning av trappor - om stegklättrare är ifyllt med "ja"
            if (test_input($_POST["stairclimber"]) == "yes" && empty($_POST["trappa"])) {
                $trappaInfo = "Info om trappa: ";
                $trappa = "Ingen information om trappor har fyllts i.";
                $trappaErr = "Beskriv trappor där trappklättraren ska användas.";
            } else {
                $trappaInfo = "Info om trappa: ";
                $trappa = test_input($_POST["trappa"]);
            }

            // Beskrivning av rullstol - om stegklättrare är ifyllt med "nej"
            if (test_input($_POST["stairclimber"]) == "no" || empty($_POST["rullstol"])) {
                $rullstolInfo = "";
                $rullstol = "";
            } else {
                $rullstol = test_input($_POST["rullstol"]);
            }
            
            // Beskrivning av trappor - om stegklättrare är ifyllt med "nej"
            if (test_input($_POST["stairclimber"]) == "no" || empty($_POST["trappa"])) {
                $trappaInfo = "";
                $trappa = "";
            } else {
                $trappa = test_input($_POST["trappa"]);
            }



        /* 
        ÖVRIGA HJÄLPMEDEL
        */
        // Arbetsresa? ja/nej
        if (test_input($_POST["arbetsresa"]) == "no" || empty($_POST["arbetsresa"])) {
            $arbetsresaInfo = "";
            $arbetsresa = "";
        } else {
            $arbetsresaInfo = "Arbetsresa: ";
            $arbetsresa = "Ja";
        }

        // Specialfordon? ja/nej
        if (test_input($_POST["specialfordon"]) == "no" || empty($_POST["specialfordon"])) {
            $specialfordonInfo = "";
            $specialfordon = "";
        } else {
            $specialfordonInfo = "Specialfordon: ";
            $specialfordon = "Ja";
        }

        // Skrymmande hjälpmedel? yes/no
        if (test_input($_POST["skrymmande"]) == "no" || empty($_POST["skrymmande"])) {
            $skrymmandeInfo = "";
            $skrymmande = "";
        } else {
            $skrymmandeInfo = "Skrymmande hjälpmedel: ";
            $skrymmande = "Ja";
        }

    }




    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>