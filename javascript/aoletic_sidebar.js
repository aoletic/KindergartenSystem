/* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("sidebar_push").style.marginLeft = "250px";
  document.getElementById("podnozje_push").style.marginLeft ="250px";
}

/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
   document.getElementById("sidebar_push").style.marginLeft = "0";
   document.getElementById("podnozje_push").style.marginLeft ="0";

}

function on() {
  document.getElementById("overlay").style.display = "block";
}

function off() {
  document.getElementById("overlay").style.display = "none";
}



