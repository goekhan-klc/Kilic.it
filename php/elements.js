var hamburgerMenu = document.getElementById('hamburger-menu');
var mobileMenuItems = document.getElementById('mobilemenu-items');
var mobilemenuOverlay = document.getElementById('mobilemenu-overlay');
var confirmation = document.getElementById("confirmation");

hamburgerMenu.addEventListener('click', function() {
    mobileMenuItems.classList.toggle('show');
    mobilemenuOverlay.classList.toggle('show');
 });

