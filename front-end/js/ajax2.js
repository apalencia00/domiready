
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

function consultarServMes()
{

	divResultado = document.getElementById('resultado');
	fecha = document.getElementById('fecha').value;
	ajax=objetoAjax();
	ajax.open("GET", "../back-end/Source/getServiciosMes.php?fecha="+fecha);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)
	

}

function agregarLiquidacion(){

divResultado = document.getElementById('resultado');
	fecha = document.getElementById('fecha').value;
	ajax=objetoAjax();
	ajax.open("GET", "../back-end/Source/liquidar.php?fecha="+fecha);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)

}



function liquidarTotal(){

	if(document.getElementById("fliquidar").value.length > 0 && document.getElementById("mobil").value.length > 0){


	fliquidar = document.getElementById("fliquidar").value;
	factual  = document.getElementById("factual").value;
	emp = document.getElementById("emp").value;
	cantidad = document.getElementById("cantidad").value;
	ahorro = document.getElementById("ahorro").value;
	parqueo = document.getElementById("parqueo").value;
	valor = document.getElementById("valor").value;
	mobil = document.getElementById("mobil").value;
	comision = document.getElementById("comision").value;
	credito = document.getElementById("credito").value;
	producido = document.getElementById("producido").value;
	realmobil = document.getElementById("realmobil").value;


	  $.ajax({ url: "../back-end/Source/Liquidar.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: {"oper" : 1, "fliquidar" : fliquidar, "factual" : factual, "emp" :emp, "cantidad" : cantidad, "total" : valor },
         success: function(json){
                         
         console.log(json);
         if(json.success){
         
             alert(json.mensaje);   osService(); 


         
             }else{
                  
                  alert(json.mensaje + "\n" + json.code);
             }
         
         }});

}

else

alert("Fecha de liquidacion y mobil invalidos");

}


function actualizar()
{
	emp = document.getElementById("emp").value;

	ajax=objetoAjax();
	ajax.open("POST", "../back-end/Source/actualizarLiquidacion.php?",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)


}

