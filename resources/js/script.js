'use strict'

window.addEventListener('load', function(){
    var anio = document.getElementById("year");
    anio.textContent = new Date().getFullYear();
});