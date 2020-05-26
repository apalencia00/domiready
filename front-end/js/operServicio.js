function enviar_sms(tipo, numero){

          
             $.ajax({ url: "../back-end/Source/sms.php", 
                type: "GET",
             contentType: "application/json",
             dataType: 'json',
                 data: {"numero" : numero, "tipo":tipo},
                         
                 success: function(data){ 
                 
                     console.log("ok:" +data);
                    //window.alert("ok:"+data);
                     
                 },
                 timeout: function(data){ 
                    console.log("time:" +data);
                                
                 },
                 error: function(data){
                    console.log("error:" +data);
                            
                 }

             });
            

         }



function validate_activity(e)
{


  var   oper = document.getElementById("operacion").value;
  var   id    = document.getElementById("ide").value;
  var   tel   = document.getElementById("tel1").value;
  var   cel   = document.getElementById("cel").value;
  var   nomb  = document.getElementById("nom").value;
  var  fecha = document.getElementById("fecha").value;
  var  tipo_serv = document.getElementById("tipo_serv").value;
  var  idserv= document.getElementById("idserv").value;

  var  tipo_pago = document.getElementById("tipo_pago").value;
  var  valor = document.getElementById("valor").value;
  var  comision = document.getElementById("comision").value;
  var  regresar = document.getElementsByName("regresar");
    
   var objreg;
   console.log(regresar);
        for (var i = 0; i < regresar.length; i++) {
          
              if (regresar[i].checked) {
        // do whatever you want with the checked radio
                //alert(regresar[i].value);
                objreg = regresar[i].value;
                console.log("Dime algo " + objreg);
      
              break;
            }
          }


  var  repartidor = document.getElementById("repartidor").value;
  var  observacion = document.getElementById("servicio").value;
  var  dirini = document.getElementById("dirini").value;
  var  dirdest = document.getElementById("dirdest").value;

  var  distance = document.getElementById("distance").value;
  var  time   = document.getElementById("time").value;

  var dir1 = document.getElementById("altori1").value;
  var dir2 = document.getElementById("altori2").value;
  var dir3 = document.getElementById("altori3").value;
  var dir4 = document.getElementById("altori4").value;
  var dir5 = document.getElementById("altori5").value;
  var dir6 = document.getElementById("altori6").value;
  var dir7 = document.getElementById("altori7").value;
  var compdire_or = document.getElementById("comp_dire").value;
  var compdire_dest = document.getElementById("comp_diredest").value;
  var usuario = document.getElementById("usuario").value;

  if( id !== 0  || fecha !== "" || tel !== "" || objreg !=="" || nomb !== "" 
    || dirini!=="" || dirdest !== "" || tipo_serv !== 0 || idserv !== 0 || repartidor != ""
    || tipo_pago !== 0 || valor !== "" || comision !== ""  || observacion !== "" ){

    $.ajax({ url: "../back-end/Source/Servicio_Despacho.php", 
     type: "GET",
     contentType: "application/json",
     dataType: 'json',
     data: {"oper" : 1,"operacionserv" : oper, "ide" : id, "fecha" : fecha, "tel" : tel , "regresar" : objreg, "repartidor" : repartidor, "nomb" : nomb, "dirini" : dirini, "dirdest" :dirdest, "distance" : distance, "dir1": dir1, "dir2": dir2,"dir3": dir3,"dir4": dir4,"dir5": dir5,"dir6": dir6,"dir7": dir7, "time" : time, "tipo_serv" : tipo_serv, "idserv" : idserv, "tipo_pago" : tipo_pago, "valor" : valor, "comision" : comision , "observacion" : observacion, "comp_dire" : compdire_or, "comp_diredest" : compdire_dest},
     success: function(json){

         //console.log(json);
         if(json.success){

           alert(json.mensaje); 

              if (tel == cel){
                     if (cel.length==10){
                        enviar_sms(1, '57'+cel );
                    }
                 }
                 else{
                    if (cel.length==10){
                        enviar_sms(1,'57'+cel );
                    }
                    else if (tel.length==10){
                        enviar_sms(1,'57'+tel );
                    }
                 }     

		        /***********************/
				/*******  SMS  *********/
				/***********************/
				//para enviar sms 1 es para agendado ok, 2 para registro cliente
				
				
				//window.alert("ok");
				 if (tel == cel){
				 	if (cel.length==10){
						enviar_sms(1, '57'+cel );
					}
				 }
				 else{
					if (cel.length==10){
						enviar_sms(1,'57'+cel );
					}
					else if (tel.length==10){
						enviar_sms(1,'57'+tel );
					}
				 }     
		   
		   
           e.preventDefault();
           osService(); 

           document.getElementById("ide").value = "";
           document.getElementById("nom").value = "";
           document.getElementById("apell").value = "";
           document.getElementById("tel").value = "";
           document.getElementById("cel").value = "";
           document.getElementById("dirdest").value = "";
           document.getElementById("dirini").value = "";
           document.getElementById("nomb_completo").value = "";
           document.getElementById("valor").value = "";
           document.getElementById("servicio").value = "";
           document.getElementById("num_mobilre").selectedIndex = -1;
           document.getElementById("repartidor").selectedIndex = 0;
           document.getElementById("comp_dire").value = "";
           document.getElementById("comp_diredest").value = "";
           

           $('#tipo_pago option').prop('selected', function() {
            return this.defaultSelected;
          });


         }else{

          alert(json.mensaje + "\n" + json.code);
        }

      }});

}else{
  alert("Error al registrar Servicio, Complete informacion");
}

return false;

}

function servicioNorte()

{
  var   id    = document.getElementById("ide").value;
  var   tel   = document.getElementById("tel").value;
  var   cel   = document.getElementById("cel").value;
  var   nomb  = document.getElementById("nom").value;
  var  fecha = document.getElementById("fecha").value;
  var  tipo_serv = document.getElementById("tipo_serv").value;
  var  idserv= document.getElementById("idserv").value;
  var  frecuencia = document.getElementById("frecuencia").value;
  var  tipo_pago = document.getElementById("tipo_pago").value;
  var  valor = document.getElementById("valor").value;
  var  comision = document.getElementById("comision").value;
  var  regresar = document.getElementById("regresar").value;
  var   repartidor = document.getElementById("repartidor").value;
  var          observacion = document.getElementById("servicio").value;
  var  dirini = document.getElementById("dirini").value;
  var  dirdest = document.getElementById("dirdest").value;

  var  distance = document.getElementById("distance").value;
  var   time   = document.getElementById("time").value;

  console.log("Identififcacion Cliente" +id);
  console.log("Telefono Cliente" +tel);
  console.log("Celular Cliente" +cel);
  console.log("Nombre CLiente" +nomb);
  console.log("Fecha " +fecha);
  console.log("Tipo Servicio" +tipo_serv);
  console.log("Consecutivo " +idserv);
  console.log("frecuencia" +frecuencia);
  console.log("Tipo Pago" +tipo_pago);
  console.log("Valor" +valor);
  console.log("Porcentaje COmision" +comision);
  console.log("Regresa ? " +regresar);
  console.log("ID Repartidor" +repartidor);
  console.log("Observacion" +observacion);
  console.log("Direccion Origen" +dirini);
  console.log("Direccion Destino " +dirdest);
  console.log("Distancia km " +distance);
  console.log("Tiempo" +time);


  $.ajax({ url: "../back-end/Source/ServiNorte.php", 
   type: "GET",
   contentType: "application/json",
   dataType: 'json',
   data: {"ide" : id, "tel" : tel, "cel" : cel, "nomb" : nomb, "fecha" : fecha, "tipo_serv" : tipo_serv, "idserv" : idserv, "frecuencia" : frecuencia, "tipo_pago" : tipo_pago, "valor" : valor, "comision" : comision , "regresar" : regresar, "repartidor" : repartidor, "observacion" : observacion , "dirini" : dirini, "dirdest" : dirdest, "distance" : distance, "time" : time  },
   success: function(response){

     if(response.success){

         //$('#myModal').modal('show');
         console.log("AQUI ENRO BIEN");
		 
		 
		 		
		 
		 
         
       }else{
                  //$('#myModalerr').modal('show');
                  console.log("ENTRO CON ERROR");
                }

              }});


}

function imprimir_ireport(ev){

  form=document.getElementById('form');

  form.action='../back-end/Source/imprimir.php?oper=2';
  form.submit();

}

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

function printerBatch(){
  divResultado = document.getElementById('resultado');
  ajax=objetoAjax();
  ajax.open("GET", "http://localhost:8080/JasperPrint/webresources/print/imprimir");
  
  ajax.send(null);

}


