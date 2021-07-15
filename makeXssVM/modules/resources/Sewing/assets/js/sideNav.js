/* Open when someone clicks on the Menu element */
function openNav() {
    document.getElementById("myNav").style.width = "20%";
    document.getElementById("sideNavButton").style.visibility = "hidden";
}

/* Close when someone clicks on the "x" symbol inside the overlay */
function closeNav() {
    document.getElementById("myNav").style.width = "0%";
    document.getElementById("sideNavButton").style.visibility = "visible";
}