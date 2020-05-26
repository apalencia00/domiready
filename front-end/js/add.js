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



function enviar_sms(tipo, numero){

     $.ajax({ url: "../back-end/Source/sms.php", 
        type: "GET",
     contentType: "application/json",
     dataType: 'json',
         data: {"numero" : numero, "tipo":tipo},
                 
         success: function(data){ 
         	//window.alert("ok:"+data);
             
         },
		 timeout: function(data){ 
		 	//window.alert("time:"+data);
						
		 },
		 error: function(data){
			//window.alert("error:"+data);
					
		 }

     });
	

 }

function addCliente() {

  
  divResultado = document.getElementById('resultado');

tipo_doc = document.getElementById('tipo_doc').value;

ide    = document.getElementById('identificacion').value;

nomb   = document.getElementById('nombre').value;

apellido = document.getElementById("apellido").value;

dire   = document.getElementById('direccion').value;

tel    = document.getElementById('telefono').value;

cel    = document.getElementById('celular').value;

correo = document.getElementById("email").value;

compdireccion = document.getElementById("compdireccion").value;
//suc    = document.contactform.suc.value;

var expression = "/^[0-9]$/";

if(tipo_doc !== 0 && ide !== "" && nomb !== "" && dire !== "" && tel !== "" ){
var identi = ide.toString();

  $.ajax({ url: "../back-end/Source/Cliente.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "id" : identi, "tipo" : tipo_doc , "nomb" : nomb,  "apellido" : apellido, "dire" : dire, "tel" : tel, "cel" :cel, "correo" : correo, "compdir" :compdireccion },
                 
         success: function(json){ 

          var resp = json[0].success;

			
			
				/***********************/
				/*******  SMS  *********/
				/***********************/
				//para enviar sms 1 es para agendado ok, 2 para registro cliente
				
				 if (tel == cel){
				 	if (cel.length==10){
						enviar_sms(2, '57'+cel );
					}
				 }
				 else{
					if (cel.length==10){
						enviar_sms(2,'57'+cel );
					}
					else if (tel.length==10){
						enviar_sms(2,'57'+tel );
					}
				 
				 } 		

          if(resp){
			  
			  

            if (tel == cel){
                     if (cel.length==10){
                        enviar_sms(2, '57'+cel );
                    }
                 }
                 else{
                    if (cel.length==10){
                        enviar_sms(2,'57'+cel );
                    }
                    else if (tel.length==10){
                        enviar_sms(2,'57'+tel );
                    }
                 
                 }         

            alert(json[0].mensaje);
            window.location.href = 'Servicio_Despacho.php';
			
				
			
          }else{

            alert(json[0].mensaje);
          }

         }

       });


}else{
    alert("Informacion insuficiente para registrar");
}

}


function addCajareg(){

console.log("BIEN BACANO ESTE ES CENTRO");

divResultado = document.getElementById('resultado');

URL = '..Source/';

tipo_concepto    = document.getElementById('tipo').value;

saldo = document.getElementById('saldoac').value;

motivo   = document.getElementById('motivo').value;

cedula   = document.getElementById('cedula').value;

valor    = document.getElementById('valor').value;

fecha    = document.getElementById('fecha').value;

if(tipo_concepto != 0 && saldo != '' && motivo != '' && cedula != '' && valor != '' && fecha != ''){

    $.ajax({ url: "../back-end/Source/Caja_Menor.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "oper" : 1,"tipo" : tipo_concepto, "saldo" : saldo, "motivo" : motivo, "cedula" : cedula, "valor" : valor, "fecha" : fecha },
                 
         success: function(json){ 

         var response = json.data[0].success;


          if(json.data[0].success == "t"){
              alert(json.data[0].mensaje);
                location.reload();

          }else{

              alert(json.data[0].mensaje);
              location.reload();

          }
        

         }

       });

}else{
  alert("Error campo(s) vacios"); 
}

}


function addCajaregNorte(){

  console.log("BIEN BACANO ESTE ES NORTE");


divResultado = document.getElementById('resultado');

URL = '..Source/';

tipo_concepto    = document.getElementById('tipo').value;

saldo = document.getElementById('saldoac').value;

motivo   = document.getElementById('motivo').value;

cedula   = document.getElementById('cedula').value;

valor    = document.getElementById('valor').value;

fecha    = document.getElementById('fecha').value;

if(tipo_concepto != 0 && saldo != '' && motivo != '' && cedula != '' && valor != '' && fecha != ''){

    $.ajax({ url: "../back-end/Source/Caja_Menor.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "oper" : 3,"tipo" : tipo_concepto, "saldo" : saldo, "motivo" : motivo, "cedula" : cedula, "valor" : valor, "fecha" : fecha },
                 
         success: function(json){ 

         var response = json.data[0].success;


          if(json.data[0].success == "t"){
              alert(json.data[0].mensaje);
                location.reload();

          }else{

              alert(json.data[0].mensaje);
              location.reload();

          }
        

         }

       });

}else{
  alert("Error campo(s) vacios"); 
}

}



