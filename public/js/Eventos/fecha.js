// window.onload = function(){
//     var fecha = new Date(); //Fecha actual
//     var mes = fecha.getMonth()+1; //obteniendo mes
//     var dia = fecha.getDate(); //obteniendo dia
//     var annio = fecha.getFullYear(); //obteniendo año
//     if(dia<10)
//       dia='0'+dia; //agrega cero si el menor de 10
//     if(mes<10)
//       mes='0'+mes //agrega cero si el menor de 10
//     document.getElementById('fecha').value=dia+"/"+mes+"/"+annio;
//     value=dia+"/"+mes+"/"+annio;
//     console.log(value);
// }

var fecha = new Date();
document.getElementById("fecha").value = fecha.toJSON().slice(0,10);