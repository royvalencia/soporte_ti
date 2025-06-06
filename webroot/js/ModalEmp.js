//Boton de Ayuda para Toda la APP
function verModal() {
     var modal = document.getElementById("help-modal");    var iframe = document.getElementById("help-iframe");
    modal.style.display = "block";
}

function cerrarModal() {
    var modal = document.getElementById("help-modal");
    modal.style.display = "none";
}

window.onclick = function(event) {
    var modal = document.getElementById("help-modal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
