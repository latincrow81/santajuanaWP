window.onload = function(){document.getElementById("menuResponsive").addEventListener("click", drop);}

function drop(){
    document.getElementById("menuResponsive").className = "";
    document.getElementById("menuResponsive").className += "opened";
    document.getElementById("menuResponsive").removeEventListener("click", drop);
    document.getElementById("menuResponsive").addEventListener("click", contract);
}
function contract(){
    document.getElementById("menuResponsive").className = "";
    document.getElementById("menuResponsive").className += "closed";
    document.getElementById("menuResponsive").removeEventListener("click", contract);
    document.getElementById("menuResponsive").addEventListener("click", drop);
}