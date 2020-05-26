<?php

error_reporting(0);


  ?>

  <!DOCTYPE html>
  <html>
  <head>


    <style type="text/css">

      #content {
       border-radius: 25px;
       border: 2px solid #73AD21;
       padding: 20px; 
       width: 400px;
       height: 650px;
       display:none;
     }


     .input_fields_wrap{

      size:200px;
      height:auto;
      width:300px;
      alignment-adjust:auto;
      white-space:normal;
      padding:5px;
      float: left;

    }


    form input[type="text"]:required:valid{
     border:2px solid green;
     /* otras propiedades */
   }
   /*caso contrario, el color sera rojo*/
   form input[type="text"]:focus:required:invalid{
     border:2px solid red;
     /* otras propiedades */
   }

   a:focus, a:active {
    color: green;
  }

.RbtnMargin { margin-left: 5px;  margin-top: 2cm; }

  </style>
<title>SERVICIOS MANDAOS EXPRESS</title>

<link rel="stylesheet" href="css/minified/jquery-ui.min.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/stylodes_ppal.css" />
<link rel="stylesheet" href="css/minified/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/ajax2.js" ></script>
<script type="text/javascript" src="js/operServicio.js" ></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/setConf.js" ></script>
<!--<script type="text/javascript" src="../js/peticiones.js" ></script> -->

<script type="text/javascript"> 


 $(function(){

   $('#cancelar').on('click', function (e) {
    e.preventDefault();

    $('.dialog').css('display','block');
    $('#dialog').load('http://198.46.152.223:8080/JasperPrint/webresources/print/imprimir_last #dialog');
    $('#myframe').attr('src', 'http://198.46.152.223:8080/JasperPrint/webresources/print/imprimir_last');
           
    
    var dialog1 = $("#dialog").dialog({ 
      autoOpen: false,

      height: 600,
      width: 650,
      modal: true,
    });

// load content and open dialog
dialog1.dialog('open');

});

   $("#nomb_completo").autocomplete({
    source: "autocomplete.php",

  });

   $("#tel").autocomplete({
    source: "autocomplete.tel.php",
    minLength: 1
  });  

 var max_fields      = 7; //maximum input boxes allowed
    var wrapper      = $(".input_fields_wrap"); //Fields wrapper

   var x = 0; //initlal text box count
    $("#add").click(function(e){ //on add input button click
      e.preventDefault();
        if(x <= max_fields){ //max input box allowed
            x++; //text box increment
            $('#desv'+x).show();
            $('#altori'+x).show();
            $('.remove_button').show();
          }
        });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
      e.preventDefault(); $(this).parent('div').remove(); x--;
    });

    osService();
//servicio();
//tPago();
buscarRepartidor();
comision();

$("#clean")
.button()
.click(function () {

 document.getElementById("ide").value = "";
 document.getElementById("nom").value = "";
 document.getElementById("apell").value = "";
 document.getElementById("tel").value = "";
 document.getElementById("cel").value = "";
 document.getElementById("dirdest").value = "";
 document.getElementById("dirini").value = "";
 document.getElementById("nomb_completo").value = "";


});


});


</script>



</script>

<SCRIPT language="JavaScript">
  <!--
  function silentErrorHandler() {return true;}
  window.onerror=silentErrorHandler;
//-->
</SCRIPT>

<script>

  function osService(){

   $.ajax({ url: "../back-end/Source/Parametrico.php", 
     type: "GET",
     contentType: "application/json",
     dataType: 'json',
     data: { "oper" : 7 },

     success: function(json){ 

      if(json[0].nservi != null){            
       var number_servi = parseInt(json[0].nservi);


       document.getElementById("idserv").value = json[0].nservi;

     }else{
      document.getElementById("idserv").value = 0;
    }

  }

});

 }



 function servicio(){

  $.ajax({ url: "../Source/Parametrico.php", 
   type: "GET",
   contentType: "application/json",
   dataType: 'json',
   data: { "oper" : 4 },

   success: function(json){ 

     var $select = $('#operacion'); 

     for(var i = 0; json.length; i ++){
      $select.append('<option value=' + json[i]['id_estado_orden'] + '>' + json[i]['descripcion'] + '</option>');
    }
  }});

}

function tipoServicio(){

 $.ajax({ url: "../Source/Parametrico.php", 
   type: "GET",
   contentType: "application/json",
   dataType: 'json',
   data: { "oper" : 3 },

   success: function(json){ 

             //console.log(json);
             
                //var $select = $('#tipo_serv'); 
               // $select.find('option').remove();  

               for(var i = 0; json.length; i ++){

                $select.append('<option value=' + json[i]['id_tservicio'] + '>' + json[i]['descripcion'] + '</option>');
              }
            }});

}

function tPago(){

 $.ajax({ url: "../back-end/Source/Parametrico.php", 
   type: "GET",
   contentType: "application/json",
   dataType: 'json',
   data: { "oper" : 2 },

   success: function(json){ 

             //console.log(json);
             
             var $select = $('#tipo_pago'); 
             $select.find('option').remove();  

             for(var i = 0; json.length; i ++){

              $select.append('<option value=' + json[i]['id_tipopago'] + '>' + json[i]['descripcion'] + '</option>');
            }
          }});


}

function busquedaServicio(e)
{

  var key=e.keyCode || e.which;

  if (e.which == 13) {
    e.preventDefault();
    var identii = document.getElementById("idserv").value;

    $.ajax({ url: "../Source/Servicio_Despacho.php", 
     type: "GET",
     contentType: "application/json",
     dataType: 'json',
     data: { "oper" : 10, "idserr" : identii },
     
     success: function(json){ 

      var res    = json.success;
      var ides   = json.data[0].n_ide;
      var nombes = json.data[0].clinom;
      var apelli = json.data[0].cliapell;
      var diress = json.data[0].dir_proc;
      var tels   = json.data[0].clitel;
      var cels   = json.data[0].clicel;
      var diress2  = json.data[0].dir_dest;
      var tserx = json.data[0].tser;
      var comix = json.data[0].comi;
      var tpagx = json.data[0].tpag;
      var valore = json.data[0].total;

      console.log(res);
      console.log(ides);
      console.log(nombes);
      console.log(diress);
      console.log(tels);
      console.log(diress2);
      console.log(tserx);
      console.log(comix);
      console.log(tpagx);
      console.log(valore);

      document.getElementById("ide").value = ides;
      document.getElementById("nom").value = nombes;
      document.getElementById("apell").value = apelli;
      document.getElementById("tel").value = tels;
      document.getElementById("cel").value = cels;
      document.getElementById("dirdest").value = diress2;
      document.getElementById("dirini").value = diress;

      document.getElementById("valor").value = valore;



    }});

  }

}



function consultarCliente(e)

{
  var key=document.all ? e.which : e.keyCode;

  if (key == 13) {
    e.preventDefault();
    var identi = document.getElementById("ide").value;
    var telef = document.getElementById("tel").value;
    var nombress = document.getElementById("nom").value;
    var celulars = document.getElementById("cel").value;
    var apellidos = document.getElementById("apell").value;
    var nomb_completo = document.getElementById("nomb_completo").value;


    $.ajax({ url: "../back-end/Source/Parametrico_Cliente.php", 
     type: "GET",
     contentType: "application/json",
     dataType: 'json',
     data: { "oper" : 2 , "ide" : identi, "tel" : telef, "nom" : nombress, "ape" : apellidos,"cel": celulars, "comp" : nomb_completo },
     
     success: function(json){ 

        var resp = json.success;

        if(resp){


         if(json.data != "" ){

           historial_clienteByIdTel();
           var ides   = json.data[0].n_ide;
           var nombes = json.data[0].clinom;
           var cliapell = json.data[0].cliapell;
           var tels   = json.data[0].clitel;
           var cels   = json.data[0].clicel;
           document.getElementById("ide").value = ides;
           document.getElementById("nom").value = nombes;
           document.getElementById("tel").value = tels;
           document.getElementById("cel").value = cels;
           document.getElementById("apell").value = cliapell;
           document.getElementById("dirini").value = json.data[0].clidire;
           document.getElementById("comp_dire").value = json.data[0].comp_dire;
           document.getElementById("nomb_completo").value = json.data[0].nomb_completo;



         }else{
          console.log("entro aqui b");
          confirmado = confirm('El cliente no existe en la base de datos, desea ingresarlo?');

          if(confirmado){

            window.localStorage.setItem("dato", telef);

            window.location = "Cliente.php";

          }

        }

      }

    }});

  }
  else{

    if(key == 40){
     document.getElementById("ide").value = "";
     document.getElementById("nom").value = "";
     document.getElementById("tel").value = "";
     document.getElementById("cel").value = "";
     document.getElementById("apell").value = "";
     document.getElementById("dirini").value = "";
     return true;


   }
 }

}


          

         </script>



         <script>

		  function enviar_sms(tipo, numero){

		  
			 $.ajax({ url: "sms.php", 
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
		 
         function validate_activity(e)
{


  var   oper = document.getElementById("operacion").value;
  var   id    = document.getElementById("ide").value;
  var   tel   = document.getElementById("tel").value;
  var   cel   = document.getElementById("cel").value;
  var   nomb  = document.getElementById("nom").value;
  var  fecha = document.getElementById("fecha").value;
  var  tipo_serv = 1;
  var  idserv= document.getElementById("idserv").value;

  var  tipo_pago = 1;
  var  valor = document.getElementById("valor").value;
  var  comision = 1;
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


  var  repartidor = 0;
  var  observacion = document.getElementById("servicio").value;
  var  dirini = document.getElementById("dirini").value;
  var  dirdest = document.getElementById("dirdest").value;

  var  distance = document.getElementById("distance").value;
  var  time   = document.getElementById("time").value;

  var compdire_or = document.getElementById("comp_dire").value;
  var compdire_dest = document.getElementById("comp_diredest").value;
  var usuario = document.getElementById("usuario").value;

  if( id !== 0  || fecha !== "" || tel !== "" || objreg !=="" || nomb !== "" 
    || dirini!=="" || dirdest !== "" || tipo_serv !== 0 || idserv !== 0 
     || valor !== ""  || observacion !== "" ){

    $.ajax({ url: "../back-end/Source/Servicio_Despacho.php", 
     type: "GET",
     contentType: "application/json",
     dataType: 'json',
     data: {"oper" : 1,"operacionserv" : oper, "ide" : id, "fecha" : fecha, "tel" : tel , "regresar" : objreg, "repartidor" : repartidor, "nomb" : nomb, "dirini" : dirini, "dirdest" :dirdest, "distance" : distance, "dir1": "", "dir2": "","dir3": "","dir4": "","dir5": "","dir6": "","dir7": "", "time" : "", "tipo_serv" : tipo_serv, "idserv" : idserv, "tipo_pago" : tipo_pago, "valor" : valor, "comision" : comision , "observacion" : observacion, "comp_dire" : compdire_or, "comp_diredest" : compdire_dest},
     success: function(json){

         //console.log(json);
         if(json.success){

           alert(json.mensaje); 
           e.preventDefault();
           osService(); 


           $('.dialog').css('display','block');
           //$('#dialog').load('http://198.46.152.223:8080/JasperPrint/webresources/login/imprimir #dialog');
           $('#myframe').attr('src', 'http://198.46.152.223:8080/JasperPrint/webresources/print/imprimir?userin='+usuario);
           
           
           var dialog1 = $("#dialog").dialog({ 
             autoOpen: false,
             height: 600,
             width: 650,
             modal: true,
             
           });

           dialog1.dialog('open');

		   
				/***********************/
				/*******  SMS  *********/
				/***********************/
				//para enviar sms 1 es para agendado ok, 2 para registro cliente

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

          function setDestino(valor,compor){

            if(valor != ""){

            document.getElementById("dirini").value =  document.getElementById("dirdest").value;
            document.getElementById("dirdest").value = valor;
              
            document.getElementById("comp_dire").value = document.getElementById("comp_diredest").value ;
            document.getElementById("comp_diredest").value = compor;

            }

          }


          function setOrigen(val,compdest){
            console.log(compdest);

            if(val != ""){
              
              document.getElementById("dirdest").value = document.getElementById("dirini").value 
              document.getElementById("dirini").value = val;
              ;
              document.getElementById("comp_diredest").value = document.getElementById("comp_dire").value ;
              document.getElementById("comp_dire").value = compdest;
              


            }
          }

          

    </script>

    <script type="text/javascript">


</script>

</head>

<body >

  <form id="form" name="form" method="post" action="" class="register" onsubmit="return validate_activity(event); return false;" >


    <h1>Servicios Express </h1> <div id="content" > </div>
    <fieldset class="row1">
      <legend>Datos Personales
      </legend>
      <p>
        <label>Documento/NIT *
        </label>

        <input type="text" width="50"  id="ide" name="ide" onkeypress="consultarCliente(event)" required />

      </p>

      <p>
        <label>Telefono *
        </label>

        <input type="text" style="width:100px"  id="tel" name="tel" onkeypress="consultarCliente(event)" required  />
        <img src="images/clean.png" name="clean" width="19" height="19" id="clean"  />  

      </p>

      <p>




        <label>Otro Telefono</label>

        <input style="width:100px" type="text" id="cel" name="cel" onkeypress="consultarCliente(event)"  />


      </p>

      <p>


        <input type="text" id="nomb_completo" name="nomb_completo" style="width:400px" onkeypress="consultarCliente(event)"  />      

      </p>

      <p>

        <label>Nombre(s) *
        </label>
        <input type="text" id="nom" name="nom"   style="width:200px" onkeypress="consultarCliente(event)" required />



      </p>

      <p>

       <label>Contacto(s) *
       </label>
       <input type="text" id="apell" name="apell"   style="width:200px" onkeypress="consultarCliente(event)"  />


     </p>

   </fieldset>


   <fieldset class="row3">

    <legend>
     Informacion Servicio
   </legend>




   <p>


     <label>
       Operacion Servicio
     </label>

     <select id="operacion">

      <option value="1"> DESPACHO </option>
      <option value="5"> ENVIO NORTE </option>

    </select>




    <input id="fecha" name="fecha" class="" type="hidden" value="<?php echo date('Y-m-d H:i:s');?>"  />   
      <input id="usuario" name="usuario" class="" type="hidden" value="<?php echo $usuario;?>"  />        
  </p>

  <p>
   <label>Tipo Servicio *
   </label>
   <select id="tipo_serv" required> 

    <option value="1" > DOMICILIO </option>
    <option value="2" > CARGA </option>


  </select>




  <label>
    Servicio *

  </label>

  <input type="hidden" onkeypress ="busquedaServicio(event)" style="background-color: #faa;" id="idserv" name="idserv" required  />





</p>

<p>

  <label>Pago *
  </label>

  <select id="tipo_pago" name="tipo_pago" class="select-style" required>

   <option value="1" selected="selected" > EFECTIVO </option>
   <option value="2" > CREDITO </option>           
 </select>

 <label>Regresa *</label>
 <input  name="regresar" type="radio" value="SI" required />
 <label class="gender">Si</label>
 <input  name="regresar" type="radio" value="NO" checked="checked"/>
 <label class="gender">No</label>



</p>

<p>

  <label>Comision *
  </label>

  <select name="comision" id="comision" class="select-style" required>

  </select>     

  <p>

   <label> Origen * </label>

   <input type="text" id="dirini" name="dirini"  ondblclick="setDestino(this.value,document.getElementById('comp_dire').value)" onKeyPress="historial_By_Criteria(event, this.value)" style="text-transform: uppercase;width:200px" onkeyup="javascript:this.value=this.value.toUpperCase(); " required  />


   <select id="ciudad_org" required> 

    <option value="Barranquilla, Colombia" selected > BARRANQUILLA </option>

    <option value="Soledad, Atlántico, Colombia" > SOLEDAD - ATLANTICO </option>

    <option value="Santa Marta, Colombia" > SANTA MARTA </option>

    <option value="Puerto Colombia, Atlántico" > PTO COLOMBIA </option>


  </select>


</p>

<p>
  <label> Complemento Origen </label>
   <input type="text" id="comp_dire" name="comp_dire" style="text-transform: uppercase;width:200px"/>


</p>

<p>

  <label> Destino * </label>

  <input type="text" id="dirdest" name="dirdest" ondblclick="setOrigen(this.value,document.getElementById('comp_diredest').value)" onKeyPress="historial_By_Criteria(event, this.value)" style="text-transform: uppercase;width:200px" onkeyup="javascript:this.value=this.value.toUpperCase();" required  />

  <select id="ciudad_dest" required> 

    <option value="Barranquilla, Colombia" selected > BARRANQUILLA </option>

    <option value="Soledad, Atlantico, Colombia" > SOLEDAD - ATLANTICO </option>

    <option value="Santa Marta, Colombia" > SANTA MARTA </option>


  </select>
  
  </p>
  
  <p>
  
  
  <label>Complemento Destino</label>
  
  <input type="text" id="comp_diredest" name="comp_diredest" style="text-transform: uppercase;width:200px"/>
  

</p>

  <img src="images/add.png" name="add" width="32" height="29" id="add"  />   






<div class="input_fields_wrap">

 <p>

   <input type="text" placeholder="Desvio 1" class="input_fields_wrap" id="altori1" name="text" style="width:400px;display:none"  />


 </p>

 <p>              
   <input type="text" placeholder="Desvio 2" class="input_fields_wrap" id="altori2" name="text" style="width:400px;display:none"  /> 

 </p>

 <p>
  <input type="text" placeholder="Desvio 3" class="input_fields_wrap" id="altori3" name="text" style="width:400px;display:none"  />

</p>

<p>

  <input type="text" placeholder="Desvio 4" class="input_fields_wrap" id="altori4" name="text" style="width:400px;display:none"  />
</p>


<p>             
  <input type="text" placeholder="Desvio 5" class="input_fields_wrap" id="altori5" name="text" style="width:400px;display:none"  />

</p>


<p> 

  <input type="text" placeholder="Desvio 6" class="input_fields_wrap" id="altori6" name="text" style="width:400px;display:none"  />


</p>

<p>



  <input type="text" placeholder="Desvio 7" class="input_fields_wrap" id="altori7" name="text" style="width:400px;display:none"  />


</p>


</div>

</p>
<p>

 <label class="">Valor *
 </label>

 <input type="text" id="valor" name="valor" style="background:#faa" value="" required/>
 <input type="button" id="search" value="Calcular Distancia" />




</p>

<p>

 <label class="">Observacion *
 </label>

 <textarea   id="servicio" name="servicio" cols="30" rows="3" style="background:#FFF;text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" required ></textarea>

</p>

<p>
  <label> Movil * </label>

  <select style="width:auto" id="num_mobilre" name="num_mobilre" class="select-style" onchange="buscarNombreRepartidor(this.value)" required="required" >

   <option value="-1"> SELECCIONE </option> 

 </select>

</p>

<p>
  <label> Nombre * </label>
  <select style="width:200px" id="repartidor" required="" > </select>


</p>




</fieldset>


<fieldset class="row4">

 <legend> 

   Ubicacion

 </legend>

 <div id="map" style="width:300px; height:250px; margin:rigth" > </div>

 <p>
  <label> Distancia (km)  </label>

  <input type="text" id="distance" name="distance" />
</p>

<p>
  <label> Tiempo  </label>

  <input type="text" id="time" name="time" />
</p>


  

</fieldset>

<fieldset class="row5">

  <legend> 

   Historial

 </legend>

 <table class="table table-bordered" width="400" id="tableid">
  <tr>
   
   <td width="20%">RECOGIDA</td>
   <td width="20%">ENTREGA</td>
   <td width="20%">FECHA</td>
   <td width="20%">VALOR</td>

 </tr>
 <tr>
   <td colspan="4"><div id="historico" style="width: 100%; height: 100px; overflow-y: scroll;" > </div></td>
 </tr>
</table>
</fieldset>

<div class="row">
<div class="col-xs-2">
        <div class="text-right">

<div class="btn-group">
<button type="submit" id="registro" name="registro" class="btn btn-info btn-lg btn btn-default pull-center RbtnMargin"   >
 <span class="" > </span> 
Aceptar
  </button>

</div>
  
     <button id="pendiente" name="pendiente" onclick="registrarPendiente()" type="button" class="btn btn-search btn-lg pull-center">
    <span class=""></span> Pendiente
  </button>
  
   <button id="registron" name="registron" onclick="registrarServicioNorte()" type="button" class="btn btn-info btn-lg pull-center">
    <span class=""></span> Norte
  </button>
  
  <button id="cancelar" name="cancelar" class="btn btn-success btn-lg pull-center" type="button" >  
 Print
  </button>

</div>
</div>
</div>

</form>


<div id="dialog"  style="display:none" title="Impresion">
<iframe id="myframe" src="" width="100%" height="100%">
  
</iframe>
 </div>

 <applet id="miapplet"  code="AppletJava/Impresion.class" codebase="AppletJava"  >
    
    <PARAM NAME="integer"  VALUE="">


</applet>  

</body>
</html>


?>


