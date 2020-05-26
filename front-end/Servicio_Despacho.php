
<?php

//phpinfo();

error_reporting(0);

session_start();

if($_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != ""  )  {

  $usuario = $_SESSION['admon_mod'];
  $us = intval($usuario[0]["id_usuario"]);

  ?>

  <!DOCTYPE html>
  <html>
  <head>


  <meta name="theme-color" content="#563d7c">


<style>

/*
*
* ==========================================
* FOR DEMO PURPOSES
* ==========================================
*
*/

body {
background: #f5f5f5;
}

.rounded-lg {
border-radius: 1rem;
}

.nav-pills .nav-link {
color: #555;
}

.nav-pills .nav-link.active {
color: #fff;
}


  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }

    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }


</style>
    <!-- Custom styles for this template -->

    <link href="../vendor/twitter/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" >


<title>DOMIREADY</title>

<!-- <link rel="stylesheet" href="css/minified/jquery-ui.min.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/stylodes_ppal.css" />
<link rel="stylesheet" href="css/minified/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"> -->

<link  href="css/bootstrap.scss" /> 


<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/ajax2.js" ></script>
<script type="text/javascript" src="js/operServicio.js" ></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/setConf.js" ></script>
<!--<script type="text/javascript" src="../js/peticiones.js" ></script> -->

<script type="text/javascript">


 

  function historial_By_Criteria(event, v){

    var chCode = ('charCode' in event) ? event.charCode : event.keyCode;
    var telefono = document.getElementById("tel").value;

    $.ajax({ url: "../back-end/Source/Servicio_Despacho.php", 
     type: "GET",
     contentType: "application/json",
     dataType: 'json',

     data : { "oper" : 13 ,"valor" : v,"tele" : telefono},

     success: function(json){

       var res = json.success;                     

       if(res){
        var json_string = JSON.stringify(json.data);
        var jsonObj = JSON.parse(json_string);

        var html = '<table class="table table-bordered" border="0">';
                     
        $.each(jsonObj, function(key, value){

          //console.log(jsonObj);
          html += '<tr> <td ondblclick="cargarAntiguo('+jsonObj[key].id_servicio+')" width="20%" align="center">' +  jsonObj[key].dir_proc + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].dir_dest + '</td>'  + '<td width="20%" align="center">' +  jsonObj[key].fecha_serv + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].total + '</td>' ;
          html += '</tr>';

        });

       
        html += '</table>';

        $('#historico').html(html);

      }    
    }

  });

  }

  function cargarAntiguo(valor){


   document.getElementById("ide").value = "";
   document.getElementById("nom").value = "";
   document.getElementById("apell").value = "";
   document.getElementById("tel").value = "";
   document.getElementById("cel").value = "";
   document.getElementById("dirdest").value = "";
   document.getElementById("dirini").value = "";
   document.getElementById("nomb_completo").value = "";
   document.getElementById("comp_dire").value = "";
   document.getElementById("comp_diredest").value = "";

   $.ajax({ url: "../back-end/Source/Servicio_Despacho.php", 
     type: "GET",
     contentType: "application/json",
     dataType: 'json',

     data : { "oper" : 14 ,"servicio" : valor},

     success: function(json){



      document.getElementById("dirini").value = json.data[0].dir_proc;
      document.getElementById("dirdest").value = json.data[0].dir_dest;
      document.getElementById("ide").value = json.data[0].n_ide;
      document.getElementById("nom").value = json.data[0].clinom;
      document.getElementById("apell").value = json.data[0].cliapell;
      document.getElementById("valor").value = json.data[0].total;
      document.getElementById("tel").value = json.data[0].clitel;
      document.getElementById("cel").value = json.data[0].clicel;
      document.getElementById("nomb_completo").value = json.data[0].nomb_completo;
      document.getElementById("comp_dire").value = json.data[0].comp_dire;
      document.getElementById("comp_diredest").value = json.data[0].comp_diredest;
    }

  });

 }

 function historial_clienteByIdTel(){


   var identificacion  = document.getElementById('ide').value;
   var telefono        = document.getElementById('tel').value;
   var nom_completo    = document.getElementById('nomb_completo').value;
   $.ajax({ url: "../back-end/Source/Servicio_Despacho.php", 
     type: "GET",
     contentType: "application/json",
     dataType: 'json',

     data : { "oper" : 5 ,"ide" : identificacion , "telefono" : telefono, "comp" : nom_completo },

     success: function(json){

       var res = json.success;                     

       if(res){
        var json_string = JSON.stringify(json.data);
        var jsonObj = JSON.parse(json_string);
        var html = '<table class="table table-bordered" border="0">';
             
        $.each(jsonObj, function(key, value){

        //console.log(jsonObj);
        html += '<tr> <td ondblclick="cargarAntiguo('+jsonObj[key].id_servicio+')" width="15%">' +  jsonObj[key].dir_proc + '</td>' + '<td width="15%">' +  jsonObj[key].dir_dest + '</td>' +  '<td width="15%">' +  jsonObj[key].fecha_serv + '</td>' + '<td width="15%">' +  jsonObj[key].total + '</td>' ;
        html += '</tr>';
        
      });

        html += '</table>';

        $('#historico').html(html);

      }    
    }

  });
 }

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
 document.getElementById("comp_dire").value = "";
 document.getElementById("comp_diredest").value = "";
 $("#s").attr("checked", false);
 $("#n").attr("checked", "checked");

});


});


</script>



</script>

<SCRIPT language="JavaScript">
  
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

    try{ 

     var $select = $('#operacion'); 

     for(var i = 0; json.length; i ++){
      $select.append('<option value=' + json[i]['id_estado_orden'] + '>' + json[i]['descripcion'] + '</option>');
    }
  }catch(e){}

   }


});

}

function tipoServicio(){

 $.ajax({ url: "../Source/Parametrico.php", 
   type: "GET",
   contentType: "application/json",
   dataType: 'json',
   data: { "oper" : 3 },

   success: function(json){

    try{ 

             //console.log(json);
             
                //var $select = $('#tipo_serv'); 
               // $select.find('option').remove();  

               for(var i = 0; json.length; i ++){

                $select.append('<option value=' + json[i]['id_tservicio'] + '>' + json[i]['descripcion'] + '</option>');
              }
            }catch(e){}

             }

          });

}

function tPago(){

 $.ajax({ url: "../back-end/Source/Parametrico.php", 
   type: "GET",
   contentType: "application/json",
   dataType: 'json',
   data: { "oper" : 2 },

   success: function(json){ 

             //console.log(json);

             try{ 
             
             var $select = $('#tipo_pago'); 
             $select.find('option').remove();  

             for(var i = 0; json.length; i ++){

              $select.append('<option value=' + json[i]['id_tipopago'] + '>' + json[i]['descripcion'] + '</option>');
            }
          }catch(e){}

           }


        });


}

function comision(){

 $.ajax({ url: "../back-end/Source/Parametrico.php", 
   type: "GET",
   contentType: "application/json",
   dataType: 'json',
   data: { "oper" : 1 },

   success: function(json){ 

    try{ 

     var $select = $('#comision'); 
     $select.find('option').remove();  

     for(var i = 0; json.length; i ++){

      $select.append('<option value=' + json[i]['id_com'] + '>' + json[i]['porcentaje_com'] + '</option>');
    }

  }catch(e){}

   }


});


}


function historial(){

  id = document.getElementById("ide").value;

  if(id != ""){

    window.open("HistorialID.php?id="+id, "_blank", "toolbar=yes, scrollbars=no, resizable=yes, top=500, left=500, width=800, height=400");

  }
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

function buscarRepartidor(){

  $.ajax({ url: "../back-end/Source/Parametrico.php", 

   type: "GET",
   contentType: "application/json",
   dataType: 'json',
   data: {"oper":5 },         
   success: function(json){

    try{ 

    
     var $select = $('#num_mobilre'); 
              //  $select.find('option').remove();  

              for(var i = 0; json.length; i ++){

                $select.append('<option value=' + json[i]['n_ide'] + '>' + json[i]['num_mob'] + '</option>');
              }

            }catch(e){}

             }

          });

}

function buscarNombreRepartidor(idnumb){

             //var ide_mobil = document.getElementById("num_mobilre").value;
             $.ajax({ url: "../back-end/Source/Parametrico.php", 

               type: "GET",
               contentType: "application/json",
               dataType: 'json',
               data: {"oper":6 , "mobil_ide" : idnumb },         
               success: function(json){

                try{ 

             //console.log(json);
             
             var $select = $('#repartidor'); 
             $select.find('option').remove();  

             $select.append('<option value=' + json[0]['n_ide'] + '>' + json[0]['empnom'] + '</option>');

           }catch(e){}

            }

         });

             
             
             
           }

           

         </script>



         <script>

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

          function registrarServicioNorte()
          {


           var   id    = document.getElementById("ide").value;
           var   tel   = document.getElementById("tel").value;
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
           for (var i = 0; i < regresar.length; i++) {
          
              if (regresar[i].checked) {
        // do whatever you want with the checked radio
                //alert(regresar[i].value);
                objreg = regresar[i].value;
                console.log("Dime algo " + regresar[i].value);
                 
                  
               
        // only one radio can be logically checked, don't check the rest
              break;
            }
          }

           var   repartidor = document.getElementById("repartidor").value;
           var          observacion = document.getElementById("servicio").value;
           var  dirini = document.getElementById("dirini").value;
           var  dirdest = document.getElementById("dirdest").value;

           var  distance = document.getElementById("distance").value;
           var   time   = document.getElementById("time").value;

           var dir1 = document.getElementById("altori1").value;
           var dir2 = document.getElementById("altori2").value;
           var dir3 = document.getElementById("altori3").value;
           var dir4 = document.getElementById("altori4").value;
           var dir5 = document.getElementById("altori5").value;
           var dir6 = document.getElementById("altori6").value;
           var dir7 = document.getElementById("altori7").value;

           var compdire_or = document.getElementById("comp_dire").value;
           var compdire_dest = document.getElementById("comp_diredest").value;


           if( id !== 0  && fecha !== "" && tel !== "" && objreg !=="" && repartidor !== 0 && nomb !== "" 
            && dirini!=="" && dirdest !== "" && tipo_serv !== 0 && idserv !== 0 
            && tipo_pago !== 0 && valor !== "" && comision !== ""  && observacion !== ""  ){

            $.ajax({ url: "../back-end/Source/Servicio_Despacho.php", 
             type: "GET",
             contentType: "application/json",
             dataType: 'json',
             data: { "oper" : 15,"operacionserv" : 5, "ide" : id, "fecha" : fecha, "tel" : tel , "regresar" : objreg, "repartidor" : repartidor, "nomb" : nomb, "dirini" : dirini, "dirdest" :dirdest, "distance" : distance, "dir1": dir1, "dir2": dir2,"dir3": dir3,"dir4": dir4,"dir5": dir5,"dir6": dir6,"dir7": dir7, "time" : time, "tipo_serv" : tipo_serv, "idserv" : idserv, "tipo_pago" : tipo_pago, "valor" : valor, "comision" : comision , "observacion" : observacion, "comp_dire" : compdire_or, "comp_diredest" : compdire_dest  },

             success: function(json){

               console.log(json);
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
                 
                 osService(); 

                 setTimeout('document.location.reload()',0);
                 $('html,body').scrollTop(0);




               }else{

                alert(json.mensaje + "\n" + json.code);
              }

            }});

        }else{
          alert("Error al asignar Servicio a Norte, Complete informacion");
        }

    }




    </script>

    <script type="text/javascript">



      function registrarPendiente(){

        var   oper = document.getElementById("operacion").value;
        var   id    = document.getElementById("ide").value;
        var   tel   = document.getElementById("tel").value;
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
           for (var i = 0; i < regresar.length; i++) {
          
              if (regresar[i].checked) {
        // do whatever you want with the checked radio
                //alert(regresar[i].value);
                objreg = regresar[i].value;
                console.log("Dime algo " + regresar[i].value);
                 
                  
               
        // only one radio can be logically checked, don't check the rest
              break;
            }
          }


        var   repartidor = document.getElementById("repartidor").value;
        var          observacion = document.getElementById("servicio").value;
        var  dirini = document.getElementById("dirini").value;
        var  dirdest = document.getElementById("dirdest").value;

        var  distance = document.getElementById("distance").value;
        var   time   = document.getElementById("time").value;

        var dir1 = document.getElementById("altori1").value;
        var dir2 = document.getElementById("altori2").value;
        var dir3 = document.getElementById("altori3").value;
        var dir4 = document.getElementById("altori4").value;
        var dir5 = document.getElementById("altori5").value;
        var dir6 = document.getElementById("altori6").value;
        var dir7 = document.getElementById("altori7").value;
        var compdire_or = document.getElementById("comp_dire").value;
        var compdire_dest = document.getElementById("comp_diredest").value;
//
$.ajax({ url: "../back-end/Source/Servicio_Despacho.php", 
 type: "GET",
 contentType: "application/json",
 dataType: 'json',
 data: {"oper" : 17, "operacionserv" : oper, "ide" : id, "fecha" : fecha, "tel" : tel , "regresar" : objreg, "repartidor" : repartidor, "nomb" : nomb, "dirini" : dirini, "dirdest" :dirdest, "distance" : distance, "dir1": dir1, "dir2": dir2,"dir3": dir3,"dir4": dir4,"dir5": dir5,"dir6": dir6,"dir7": dir7, "time" : time, "tipo_serv" : tipo_serv, "idserv" : idserv, "tipo_pago" : tipo_pago, "valor" : valor, "comision" : comision , "observacion" : observacion,"comp_dire" : compdire_or, "comp_diredest" : compdire_dest},
 success: function(json){
    console.log(json);
   if(json[0].success){
//         
alert(json[0].mensaje);
//
location.reload(); 
//
//
//         
}else{
//                  
alert(json[0].mensaje + "\n" + json.code);
}
//         
}
});

}


</script>

</head>

<body >


    <div class="container-fluid">

      <div class="row content">

              <div class="col-sm-4 sidenav">

                    <h4>Busquedas </h4>

                    <br>

                          <div class="form-group">

                                <label for="username">Telefono</label>
                                <div class="input-group">
                                    <input type="text" class="form-control col-lg-50" id="tel" name="tel" onkeypress="consultarCliente(event)" required  />
                                    <!-- <img src="images/clean.png" name="clean" width="19" height="19" id="clean"  /> --> 
                                
                                  </div>

                          </div> 

                                <div class="form-group">

                                      <label>Nombre Completo</label>
                                        <div class="input-group">
                                              <input type="text" class="form-control" id="nomb_completo" name="nomb_completo" style="width:400px" onkeypress="consultarCliente(event)"  />      
                                        
                                        </div>

                                </div>

                                                    <h4>Historial De Servicios</h4><br>

                                                    <div class="input-group">

                                                                <table class="table table-striped" width="400" id="tableid">
                                                            
                                                                            <thead class="thead-dark">
                                                                                <td width="20%">RECOGIDA</td>
                                                                                <td width="20%">ENTREGA</td>
                                                                                <td width="20%">FECHA</td>
                                                                                <td width="20%">VALOR</td>

                                                                            </thead>

                                                                                <tbody>
                                                                                    <td colspan="4"><div id="historico" style="width: 100%; height: 100px; overflow-y: scroll;" > </div></td>
                                                                                </tbody>
                                                                  
                                                                </table>

                                                    </div>

                                                <h4>Localizacion : </h4>

                                                <div class="container-fluid">

                                                      <div id="map-container" class="z-depth-1-half map-container" >

                                                          <div id="map" frameborder="0" style="border:0; height: 400px; width: 100%"></div>
                                                        
                                                      </div>

                                                </div>

                                                <div class="form-group">

                                                          <label> Distancia (km)  </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text" style="width:40px" id="distance" name="distance" />
                                                        
                                                        </div>

                                                </div>

                                                  <div class="form-group">

                                                        <label> Tiempo  </label>
                                                            <div class="input-group">
                                                                <input class="form-control" style="width:40px" type="text" id="time" name="time" />
                                                              
                                                              </div>
                                                  </div>

              </div>



                          <div class="col-sm-5">

                                <h4>Gestion De Servicios</h4>
                              
                                <form id="form" role="form" name="form" method="post" action=""  onsubmit="return validate_activity(event); return false;" >

                                <input type="hidden" onkeypress ="busquedaServicio(event)" style="background-color: #faa;" id="idserv" name="idserv" required  />

                                        <div class="form-group">

                                              <label for="username">Documento</label>
                                              <div class="input-group">
                                                  <input type="text" width="40px"  id="ide" name="ide" class="form-control" onkeypress="consultarCliente(event)" required />
                                              
                                                </div>

                                        </div>



                                                <div class="form-group">

                                                      <label for="username">Telefono</label>
                                                      <div class="input-group">
                                                          <input type="text" class="form-control" id="tel1" name="tel1" onkeypress="consultarCliente(event)" required  />
                                                          <!-- <img src="images/clean.png" name="clean" width="19" height="19" id="clean"  />  -->
                                                      
                                                        </div>
                                                </div> 


                                          <div class="form-group">

                                                    <label>Otro Telefono</label>
                                                    <div class="input-group">
                                                            <input class="form-control" type="text" id="cel" name="cel" onkeypress="consultarCliente(event)"  />
                                                    
                                                    </div>
                                          </div>

                                          
                                          <div class="form-group">

                                                      <label>Nombre Completo</label>
                                                      <div class="input-group">
                                                        <input type="text" class="form-control" id="nomb_completo1" name="nomb_completo1" style="width:400px" onkeypress="consultarCliente(event)"  />      
                                                      
                                                      </div>

                                          </div>

                                          <div class="form-group">

                                                      <label>Nombre(s) :</label>
                                                      <div class="input-group">
                                                          <input type="text" class="form-control" id="nom" name="nom"   style="width:200px" onkeypress="consultarCliente(event)" required />
                                                      
                                                      </div>
                                          </div>

                                          <div class="form-group">

                                                <label>Apellidos(s) :</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="apell" name="apell"   style="width:200px" onkeypress="consultarCliente(event)"  />
                                                
                                                  </div>
                                          </div>

                                                <br>
                                                
                                                <h4>Operacion De Servicio</h4>
                                                

                                                    <div class="form-group">

                                                          <label>Tipo De Envio</label>
                                                                  <div class="input-group">

                                                                          <select class="form-control" id="operacion">
                                                                              <option value="1"> DESPACHO </option>
                                                                              <option value="5"> ENVIO NORTE </option>
                                                                        </select>
                                                                  </div>

                                                                <input id="fecha" name="fecha" class="" type="hidden" value="<?php echo date('Y-m-d H:i:s');?>"  />   
                                                                <input id="usuario" name="usuario" class="" type="hidden" value="<?php echo $usuario;?>"  />  
                                                    </div>


                                                  <div class="form-group">

                                                      <label>Tipo De Servicio</label>

                                                              <div class="input-group">

                                                                      <select class="form-control" id="tipo_serv" required> 
                                                                        
                                                                              <option value="1" > DOMICILIO CORRIENTE </option>
                                                                              <option value="2" > CARGA </option>
                                                                      </select>

                                                              </div>
                                                            
                                                  </div>


                                                  <div class="form-group">

                                                      <label>Tipo De Pago</label>

                                                              <div class="input-group">

                                                                      <select class="form-control" id="tipo_pago" name="tipo_pago" class="select-style" required>
                                                                            <option value="1" selected="selected" > EFECTIVO </option>
                                                                            <option value="2" > CREDITO </option>           
                                                                      </select>

                                                              </div>
                                                            
                                                  </div>


                                                  <div class="form-group">

                                                              <div class="input-group">
                                                                
                                                                      <label>Regresa *</label>
                                                                      <input id="s" class="form-control" name="regresar" type="radio" value="SI" required />
                                                                      <label class="gender">Si</label>
                                                                      <input id="n" class="form-control" name="regresar" type="radio" value="NO" checked="checked"/>
                                                                      <label class="gender">No</label>

                                                              </div>
                                                            
                                                  </div>

                                                  <div class="form-group">

                                                      <label>Asignar Servicio a:</label>

                                                              <div class="input-group">

                                                                    <div class="col">
                                                                      
                                                                        <select class="form-control" id="num_mobilre" name="num_mobilre" class="select-style" onchange="buscarNombreRepartidor(this.value)" required="required" >

                                                                            <option value="-1"> SELECCIONE </option> 

                                                                        </select>

                                                                        <select style="width:200px; display: none" id="repartidor" required="" > </select>

                                                                    </div>
                                                            
                                                              </div>

                                                          </div>

                                                  <div class="form-group">

                                                        <label>Comision :</label>
                                                        <div class="input-group">

                                                            <select class="form-control" name="comision" id="comision" class="select-style" required>
                                                                  <option value="0">Seleccione</option>

                                                            </select>

                                                        </div>
                                                  </div>



                                                  <div class="form-group">

                                                        

                                                        <div class="input-group">

                                                            <div class="col">

                                                            <label>Direcion Inicial :</label>
                                                
                                                                  <input type="text" class="form-control" id="dirini" name="dirini"  ondblclick="setDestino(this.value,document.getElementById('comp_dire').value)" onKeyPress="historial_By_Criteria(event, this.value)" required  />

                                                                    <select style="display: none" class="form-control" id="ciudad_org" required> 
                                                                    
                                                                            <option value="Barranquilla, Colombia" selected > BARRANQUILLA </option>
                                                                            <option value="Soledad, Atlántico, Colombia" > SOLEDAD - ATLANTICO </option>
                                                                            <option value="Santa Marta, Colombia" > SANTA MARTA </option>
                                                                            <option value="Puerto Colombia, Atlántico" > PTO COLOMBIA </option>

                                                                    </select>

                                                            </div>

                                                            <div class="col"> 
                                                              
                                                            <label> Complemento origen  </label>
                                                              <input type="text" class="form-control" id="comp_dire" name="comp_dire" style="text-transform: uppercase;width:200px"/>

                                                            </div>

                                                        </div>
                                                  </div>

                                                

                                                  <div class="form-group">

                                                        

                                                        <div class="input-group">

                                                            <div class="col">

                                                            <label>Direcion Final :</label>
                                                
                                                              <input type="text" class="form-control" id="dirdest" name="dirdest" ondblclick="setOrigen(this.value,document.getElementById('comp_diredest').value)" onKeyPress="historial_By_Criteria(event, this.value)"   required  />

                                                                    <select style="display: none" class="form-control" id="ciudad_dest" required> 

                                                                      <option value="Barranquilla, Colombia" selected > BARRANQUILLA </option>
                                                                      <option value="Soledad, Atlantico, Colombia" > SOLEDAD - ATLANTICO </option>
                                                                      <option value="Santa Marta, Colombia" > SANTA MARTA </option>


                                                                    </select>

                                                            </div>

                                                            <div class="col">

                                                              <label>Complemento destino</label>

                                                                <input type="text" class="form-control" id="comp_diredest" name="comp_diredest" style="text-transform: uppercase;width:200px"/>

                                                            </div>

                                                        </div>

                                                  </div>

                                                    <div class="form-group">

                                                        <label>Valor :</label>
                                                        <div class="input-group">

                                                              <input type="text"  class="form-control" id="valor" name="valor" value="" required/>
                                                              <input type="button" id="search" value="Calcular Distancia" />

                                                        </div>

                                                  </div>

                                                  <div class="form-group">

                                                        <label>Observacion :</label>
                                                        <div class="input-group">

                                                            <textarea class="form-control"  id="servicio" name="servicio" cols="30" rows="3" style="background:#FFF;text-transform: uppercase"  required ></textarea>
                                                        
                                                      </div>

                                                  </div>







                          </div>

                          <div class="col-sm-3 sidenav">


                          <h4>Diligencias Extras</h4>
                              
                                    <div class="form-group">

                                            <label for="username">Desvio 1</label>

                                                <div class="input-group">

                                                    <input type="text" class="form-control" placeholder="Desvio 1"  id="altori1" name="text"   />

                                                </div>

                                    </div>

                                    <div class="form-group">

                                          <label for="username">Desvio 2</label>

                                              <div class="input-group">

                                                    <input type="text" class="form-control" placeholder="Desvio 2"  id="altori2" name="text"   /> 

                                              </div>

                                    </div>


                                    <div class="form-group">

                                          <label for="username">Desvio 3</label>

                                              <div class="input-group">

                                                    <input type="text" class="form-control" placeholder="Desvio 3"  id="altori3" name="text"   />

                                              </div>

                                    </div>

                                    <div class="form-group">

                                          <label for="username">Desvio 4</label>

                                              <div class="input-group">

                                                    <input type="text" class="form-control" placeholder="Desvio 4"  id="altori4" name="text"   />

                                              </div>

                                    </div>


                                    <div class="form-group">

                                          <label for="username">Desvio 5</label>

                                              <div class="input-group">
           
                                                  <input type="text" class="form-control" placeholder="Desvio 5"  id="altori5" name="text"   />

                                              </div>

                                    </div>


                                    <div class="form-group">

                                          <label for="username">Desvio 6</label>

                                              <div class="input-group">

                                                    <input type="text" class="form-control" placeholder="Desvio 6"  id="altori6" name="text"   />

                                              </div>

                                    </div>


                                    <div class="form-group">

                                            <label for="username">Desvio 7</label>

                                                <div class="input-group">

                                                      <input type="text" class="form-control" placeholder="Desvio 7"  id="altori7" name="text"   />

                                                </div>

                                                
                                    </div>


    <button type="submit" id="registro" name="registro" class="subscribe btn btn-primary btn-block rounded-pill shadow-sm" >Aceptar</button>

    <button id="pendiente" name="pendiente" onclick="registrarPendiente()" type="button" class="subscribe btn btn-primary btn-block rounded-pill shadow-sm">Pendiente</button>




</div>

 



               
    </div>

                                      

  </div>

</div>




 

</body>
</html>

<?php }else{ header('Location: 404.php');

  unset($_SESSION['admon_mod']);

        // DESTROY COOKIE
  if (isset($_COOKIE['key'])) {
    unset($_COOKIE['key']);
    setcookie('key', '', time() - 3600, '/'); // empty value and old timestamp
  }



}
?>


