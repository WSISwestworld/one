window.onscroll = function () { sysPanel() };

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function sysPanel() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
}
