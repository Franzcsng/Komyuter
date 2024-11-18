
var modal = document.getElementById("log-out-modal");
var icon = document.getElementById("home-profile-logout");
var close = document.getElementsByClassName("cancelbtn")[0];

icon.onclick = function() {
    modal.style.display = "block";
}

close.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
