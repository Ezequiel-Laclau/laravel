window.onload=function(){
var form=document.getElementById("Nav-Busc-Tit");
var input = form.elements[1];
var busqueda="";
form.onsubmit= function(event) {
  busqueda=input.value.trim()
  if (busqueda !== "") {
    location.assign("/titulos/busqueda/"+busqueda);
  }
  event.preventDefault();
}
}