/*
// Sidemenu
// Author: Albin Rönnkvist
*/

function foldMenu() {
    // Menu on smaller screens
    var x = document.getElementById("myTopnav");
    if (x.className === "smallmenu") {
        x.className += " afterClick";
    } else {
        x.className = "smallmenu";
    }
}


// Accesability
// Make all <a>-tags focusable (for people who use tab to navigate the page)
var divs = document.getElementsByTagName('a');
for (var i = 0, len = divs.length; i < len; i++){
    divs[i].setAttribute('tabindex', '0');
}
// Same for buttons
var divs = document.getElementsByTagName('button');
for (var i = 0, len = divs.length; i < len; i++){
    divs[i].setAttribute('tabindex', '0');
}