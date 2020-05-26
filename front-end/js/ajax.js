function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function validarLogin() { 

	
	$('#loading_image').show();


var user = document.getElementById("un").value;
var pass = document.getElementById("pw").value;

 $.ajax({ url: "/back-end/Source/Login.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: {"un" : user, "pw" : pass  },
         success: function(json){
         	console.log(json);
                          	window.location = './View/Menu.php';
            if(json != ""){ 
            	//window.location.replace("http://localhost:9090/DomiReady/View/Menu.php");
             if(json.success){

             	
			//console.log(json);  
                 //


             }

         }
                          
         }
         
    });

 return true; // allow regular form submission
    
    }       


function mostrarConsulta(){
	divResultado = document.getElementById('resultado');
	ajax=objetoAjax();
	ajax.open("GET", "../back-end/Source/datos.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)
}

function mostrarDetalleCaja(){
	divResultado = document.getElementById('resultado');
	 fecha_act = document.getElementById('fecha').value;
	
	ajax=objetoAjax();
	ajax.open("GET", '../back-end/Source/getCaja.php?fechact='+fecha_act,true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)
}


function addEmpleado(){

divResultado = document.getElementById('resultado');

URL = '..Source/';

ide    = document.getElementById('identificacion').value;

nomb   = document.getElementById('nonmbre').value;

apel  = document.getElementById("apellido").value;

dire   = document.getElementById('direccion').value;

tel    = document.getElementById('telefono').value;

cel    = document.getElementById('celular').value;

tipo   = document.getElementById('tipo').value;

suc    = document.getElementById("suc").value;

mobil  = document.getElementById('mobil').value;

if(ide !== 0 && nomb !== "" && dire !== "" && tel !== "" && cel !== "" && tipo !== 0 && mobil !== 0){


  $.ajax({ url: "../back-end/Source/Empleado.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "oper" : 1, "id" : ide , "suc" : suc , "nomb" : nomb, "dire" : dire , "tel" : tel, "cel" : cel, "mobil" : mobil, "tipo" : tipo, "apellido" : apel },
                 
         success: function(json){ 

         	console.log(json);

          var resp = json[0].success;

          if(resp){

            alert(json[0].mensaje);
            location.reload();
          }else{

            alert(json.data);
          }

         }

       });
}
else{
    alert("Informacion faltante para reigstrar");
}

}

function consultarServicios(){
	divResultado = document.getElementById('resultado');

	combo = document.getElementById('local').value;
	fecha = document.getElementById('fecha').value;

	ajax=objetoAjax();
	ajax.open("GET", "../back-end/Source/getServicios.php?combo="+combo+"&fecha="+fecha);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)
}

function consultarLiquidado(){
	divResultado = document.getElementById('resultado');

	
	fecha = document.getElementById('fecha').value;

	ajax=objetoAjax();
	ajax.open("GET", "../back-end/Source/getLiquidado.php?fecha="+fecha);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)
}





