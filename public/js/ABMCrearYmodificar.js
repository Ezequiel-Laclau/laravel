window.onload=function(){
var botonAgregarActor=document.getElementById("btn-agr-act");
var botonEliminarActor=document.getElementById("btn-eli-act");
var divBotones=document.getElementById("btns-mdf-act");
var select = document.querySelector("div#cont-form-act-1 select");
var form = document.getElementById("form-crear-pel");
var contador=0;
var nuevoSelect="";
var nuevaOption="";
var nuevoTextNode="";
var nuevoDiv="";
var viejoDiv="";
var nuevoLabel="";
var cantidadActores=select.options.length-1;
var nroActor=1;

for(var limite=cantidadActores;limite>0;limite--){
if(document.querySelector("main form#form-crear-pel div#cont-form-act-"+limite)){
nroActor=limite;
break;
}
}
var listaIdsActores=[];
for(var i=1;i<=cantidadActores;i++){
    listaIdsActores[i]=(select.options[i].value);
}
botonAgregarActor.onclick=function(){
    if(nroActor<cantidadActores){
    nroActor=nroActor+1;
    nuevoTextNode=document.createTextNode("Actor "+nroActor+": ");
    nuevoLabel=document.createElement("label");
    nuevoLabel.setAttribute("for","actor-"+nroActor);
    nuevoLabel.append(nuevoTextNode);
    nuevoSelect=document.createElement("select");
    nuevoSelect.setAttribute("name","actor-"+nroActor);
    nuevoSelect.setAttribute("id","actor-"+nroActor);
    nuevoDiv=document.createElement("div");
    nuevoDiv.setAttribute("id","cont-form-act-"+nroActor);
    nuevaOption=document.createElement("option");
    nuevoSelect.append(nuevaOption);
    for(var i=1;i<=cantidadActores;i++){
        nuevaOption=document.createElement("option");
        nuevaOption.setAttribute("value",listaIdsActores[i]);
        nuevoTextNode=document.createTextNode(select.options[i].innerHTML);
        nuevaOption.append(nuevoTextNode);
        nuevoSelect.append(nuevaOption);
    }
    nuevoDiv.append(nuevoLabel);
    nuevoDiv.append(nuevoSelect);
    form.insertBefore(nuevoDiv,divBotones);
}
}
botonEliminarActor.onclick=function(){
    if(nroActor>1){
    viejoDiv=document.getElementById("cont-form-act-"+nroActor);
    form.removeChild(viejoDiv);
    nroActor=nroActor-1;
    }
}

}