/*
// Toggles and other functionality.
// Author: Albin Rönnkvist
*/



// Toggle show more on checkbox - passangers
$(document).ready(function() {
    $('#mycheckbox').change(function() {
        $('#mycheckboxdiv').toggle();
    });
});

$(document).ready(function() {
    $('#mycheckbox2').change(function() {
        $('#mycheckboxdiv').hide();
    });
});

// Toggle show more on checkbox - stairclimber
$(document).ready(function() {
    $('#mycheckbox3').change(function() {
        $('#mycheckboxdiv2').toggle();
    });
});

$(document).ready(function() {
    $('#mycheckbox4').change(function() {
        $('#mycheckboxdiv2').hide();
    });
});

// Toggle show more on checkbox - children
$(document).ready(function() {
    $('#children').change(function() {
        $('#mycheckboxdiv3').toggle();
    });
});



// Toggle required on radio buttons (Passengers)
// If "no" is checked, required is disabled
$("#mycheckbox2").click(function() {
    $("#passengers-amount").prop("required", false);
    $("#passengers-amount").prop("disabled", true);
});
// If "yes" is checked, required is enabled
$("#mycheckbox").click(function() {
    $("#passengers-amount").prop("required", true);
    $("#passengers-amount").prop("disabled", false);
    $("#passengers-amount").focus();
});


// Toggle required on radio buttons (Stairclimber - Wheelchair)
// If "no" is checked, required is disabled
$("#mycheckbox4").click(function() {
    $("#rullstol").prop("required", false);
    $("#rullstol").prop("disabled", true);
});
// If "yes" is checked, required is enabled
$("#mycheckbox3").click(function() {
    $("#rullstol").prop("required", true);
    $("#rullstol").prop("disabled", false);
    $("#rullstol").focus();
});

// Toggle required on radio buttons (Stairclimber - Stairs)
// If "no" is checked, required is disabled
$("#mycheckbox4").click(function() {
    $("#trappa").prop("required", false);
    $("#trappa").prop("disabled", true);
});
// If "yes" is checked, required is enabled
$("#mycheckbox3").click(function() {
    $("#trappa").prop("required", true);
    $("#trappa").prop("disabled", false);
    $("#trappa").focus();
});


// Validate form before sending
function validate(form) {

    return confirm('Klicka på "OK" för att bekräfta beställningen.');

}


// When the user clicks on div, open the popup
function myPopupp() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}

// Clear certain fields if checkbox is not clicked
function ClearFields() {
    document.getElementById("ledsagare").checked = false;
    document.getElementById("nopermit").checked = false;
    document.getElementById("children").checked = false;
    document.getElementsByName("nopermit")[0].value = "";
    document.getElementsByName("number")[0].value = "";
    document.getElementsByName("bilbarnstol")[0].value = "";
    document.getElementsByName("alder")[0].value = "";
    var x = document.getElementById("mycheckboxdiv3");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
  }
var mycheckbox2El = document.getElementById('mycheckbox2');
if(mycheckbox2El) {
    mycheckbox2El.addEventListener('click', ClearFields , false);
}


// Dynamic contactvia input change

if($contactvia === "Ja"){
  $("#contactja").prop('checked', true);
  $("#contactnej").prop('checked', false);
} else {
    $("#contactja").prop('checked', false);
    $("#contactnej").prop('checked', true);
}



