<?php

session_start();


?>

<!DOCTYPE html>
<html>
<head>
	<title>:: YOUCODE</title>



<link rel="stylesheet" href="css/minified/jquery-ui.min.css" type="text/css" />
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap-datepicker.min.css" />
  <link href="css/jquery.growl.css" rel="stylesheet" type="text/css" />

 <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>

  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js" ></script>
  <script src="bootstrap/js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.growl.js" type="text/javascript"></script>

  <script type="text/javascript" src="js/ajax.js"></script>

  <script type="text/javascript">

  function totalDiarioSoloMovil(){

     var fechai = document.getElementById("fechai").value;
     var fechaf = document.getElementById("fechaf").value;

   mob = document.getElementById("num_mobilre").value;

    $.ajax({ url: "../back-end/Source/Parametrico.php", 

       type: "GET",
       contentType: "application/json",
       dataType: 'json',
       data: {"oper":25 , "mob" : mob, "fechai" : fechai, "fechaf" : fechaf },         
       success: function(json){

        try{ 
        console.debug(json);

        if(json[0].sum != null){

         document.getElementById("total").value        = json[0].sum;
         document.getElementById("cantidadserv").value = json[0].count;

       }else{
        document.getElementById("total").value = "$ 0"; 
      }

         }catch(e){}

  }

});

  }

  function actualizar(){

    location.reload();

  }


    function totalDiarioMobil(){


      var fechai = document.getElementById("fechai").value;
      var fechaf = document.getElementById("fechaf").value;
      var telefono  = document.getElementById("tel").value;
  var nombre    = document.getElementById("nom").value;
  var tpago     = document.getElementById("tpago").value;
     $.ajax({ url: "../back-end/Source/Parametrico.php", 


       type: "GET",
       contentType: "application/json",
       dataType: 'json',
       data: {"oper":24, "fechai" : fechai, "fechaf" : fechaf,"telefono" : telefono, "nomb" : nombre, "tpago" : tpago },         
       success: function(json){
        console.debug(json);

        if(json[0].sum != ""){

         document.getElementById("total").value = json[0].sum;
         document.getElementById("cantidadserv").value = json[0].count;

       }else{
        document.getElementById("total").value = "$ 0";	
      }


    }
    
  });




   }



   function buscarRepartidor(){

    $.ajax({ url: "../back-end/Source/Parametrico.php", 

     type: "GET",
     contentType: "application/json",
     dataType: 'json',
     data: {"oper":5 },         
     success: function(json){

             //console.log(json);

             try{              
             var $select = $('#num_mobilre'); 
            //    $select.find('option').remove();  

            for(var i = 0; json.length; i ++){

              $select.append('<option value=' + json[i]['n_ide'] + '>' + json[i]['num_mob'] + '</option>');
            }

          }catch(e){}

           }

        });



  }


  function consultarByTelefono(e){

   var key=document.all ? e.which : e.keyCode;


   if (key == 13) {

    e.preventDefault();
    var telef = document.getElementById("tel").value;
    
    $.ajax({ url: "../back-end/Source/Parametrico_Cliente.php", 
     type: "GET",
     contentType: "application/json",
     dataType: 'json',
     data: { "oper" : 21, "telefono" : telef },
     
     success: function(json){ 

      var resp = json.success;

      var json_string = JSON.stringify(json.data);
      var jsonObj = JSON.parse(json_string);
      var html = '<table class="table table-bordered" border="0">';
  

      $.each(jsonObj, function(key, value){

        console.log(jsonObj[key].num_mob);
        html += '<tr> <td width="20%" align="center" >' + jsonObj[key].num_servicio + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].fecha_serv + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].nombre_completo + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].total + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].num_mob + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].descripcion  + '<td width="20%" align="center" onclick="imprimir_report('+jsonObj[key].num_servicio+')"  > <img src="images/pdf.png" alt="" border=3 height=30 width=30></img> </td>';
        html += '</tr>';
        
      });

      html += '</table>';

      $('#actualize').html(html);





    }


  });

  }else{
    if(key == 24){
        alert("FINO");
      $('#actualize > tbody').remove();

    }
  }
}




function buscarFechas(){

  var parametro = document.getElementById("parametro").value;
  var fecha_ini = document.getElementById("fechai").value;
  var fecha_fin = document.getElementById("fechaf").value;
  var movil     = document.getElementById("num_mobilre").value;
  var telefono  = document.getElementById("tel").value;
  var nombre    = document.getElementById("nom").value;
  var tpago     = document.getElementById("tpago").value;



  if(fechai != '' && fechaf != ''){

    $.ajax({ url: "../back-end/Source/Servicio_Despacho.php", 
     type: "GET",
     contentType: "application/json",
     dataType: 'json',
     data: { "oper" : 11, "fechai" : fecha_ini, "fechaf" : fecha_fin, "param" : parametro, "movil": movil, "telefono" : telefono, "nomb" : nombre, "tpago" : tpago },

     success: function(json){


       var res = json.success;
       var param = json.param;  

       if(json.data != null){

       if(res){

             if(param == 1){

              var json_string = JSON.stringify(json.data);
              var jsonObj = JSON.parse(json_string);
              var html = '<table class="table table-bordered" border="0">';

              $.each(jsonObj, function(key, value){

                console.log(jsonObj[key]);
                html += '<tr> <td width="20%" ondblclick="cargarAntiguo('+jsonObj[key].num_servicio+')"  align="center" >' + jsonObj[key].num_servicio + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].fecha_serv + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].nombre_completo + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].tpagos + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].total + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].num_mob + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].descripcion + '</td>'  + '<td width="20%" onclick="imprimir_report('+jsonObj[key].num_servicio+')"  > <img align="center" src="images/pdf.png" alt="" border=3 height=30 width=30></img> </td>';
                html += '</tr>';

              });

              html += '</table>';

              $('#actualize').html(html);

            }else{

             var json_string = JSON.stringify(json.data);
             var jsonObj = JSON.parse(json_string);
             var html = '<table class="table table-bordered" border="0">';
             html += '<td> # Liquidacion </td>';
             html += '<td> Empleado </td>';
             html += '<td> N.Movil </td>';
             html += '<td> Fecha Liquidacion </td>';
             html += '<td> Cantidad Serv </td>';
             html += '<td> Valor Servicio </td>';
             $.each(jsonObj, function(key, value){

        //console.log(jsonObj[key]);
        html += '<tr> <td width="20%"  align="center" >' + jsonObj[key].id_liquidacion + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].fk_empleado + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].num_mob + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].fecha_liq + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].cantidad_serv + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].total_liq + '</td>' ;
        html += '</tr>';
        
      });

             html += '</table>';

             $('#tablaid').html(html);


           }

         } // END TRUE

       }else{
        $('#actualize > tbody').remove();
       }



       }});


  }else{
    alert("Debe definir fechas para consultar");
  }




}

function despachosMobil(){

  mob   = document.getElementById("num_mobilre").value;
  tpago = document.getElementById("tpago").value;

  $.ajax({ url: "../back-end/Source/Empleado.php", 
   type: "GET",
   contentType: "application/json",
   dataType: 'json',
   data: { "oper" : 8, "mob" : mob, "tpago" : tpago },

   success: function(json){


     var res = json.success;
     var param = json.param;

     if(json.data != null){

      var json_string = JSON.stringify(json.data);
      var jsonObj = JSON.parse(json_string);
        var html = '<table class="table table-bordered" border="0">';
            

      $.each(jsonObj, function(key, value){

        //console.log(jsonObj[key]);
        html += '<tr> <td width="20%" ondblclick="cargarAntiguo('+jsonObj[key].num_servicio+')"  align="center" >' + jsonObj[key].num_servicio + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].fecha_serv + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].nombre_completo + '<td width="20%" align="center">' +  jsonObj[key].tpagos +  '</td>' + '<td width="20%" align="center">' +  jsonObj[key].total + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].num_mob + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].descripcion + '</td>'  + '<td width="20%" onclick="imprimir_report('+jsonObj[key].num_servicio+')"  > <img src="images/pdf.png" alt="" border=3 height=30 width=30></img> </td>';
        html += '</tr>';
        
      });

      html += '</table>';

      $('#actualize').html(html);

  }else{

    $('#actualize > tbody').remove();

}

}


});


}

function cargarAntiguo(valor){
  console.log(valor);

  window.open("ObservacionServicio.php?idser="+valor,'','top=300,left=300,width=1000,height=400') ;


}

 function imprimir_report(serv){

  try{ 

  $('.dialog').css('display','block');
  //$('#dialog').load('http://198.46.152.223:8080/JasperPrint/webresources/print/imprimir #dialog');
  $('#myframe').attr('src', 'http://198.46.152.223:8080/JasperPrint/webresources/print/imprimirServicio?serv='+serv);

  var dialog1 = $("#dialog").dialog({ 
   autoOpen: false,
   height: 600,
   width: 650,
   modal: true,

 });

  dialog1.dialog('open');

   }catch(e){}


}


      $(document).ready(function(){

       $('#fechaf').datepicker({
        format: "yyyy-mm-dd"
      });  

       $('#fechai').datepicker({
        format: "yyyy-mm-dd"
      });  


         $("#nom").autocomplete({
          source: "autocomplete.php",

  });

       
     });

   </script>



 </head>
 <body onload="buscarRepartidor();">

  <div class="container">
    <form id="form" name="form" method="post" class="form-horizontal" >  

     <h1>Consultas Generales</h1>

     <fieldset class="row1">


       <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Telefono:</label>
        <div class="col-sm-4">
         <input class="form-control" value="" id="tel" name="tel"  required="" tabindex="1" type="text" onkeypress="consultarByTelefono(event)" >

       </div>

     </div>

     <div class="form-group">
      <label class="control-label col-sm-2" for="nom">Nombre:</label>
      <div class="col-sm-4">
        <input class="form-control" type="text" id="nom" name="nom" value="" />

      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="pam">Tipo Consulta:</label>
      <div class="col-sm-6">
        <select class="form-control" id="parametro"> 

          <option value="1" selected> Servicios Diario </option>
          <option value="2"> Liquidacion Diaria </option>

        </select>

      </div>
    </div>

<div class="form-group">
    <label class="control-label col-sm-2" for="fe">Inicio:</label>

    <div class="input-group date" data-provide="datepicker">
   
      <input data-date-format="yyyy/mm/dd" value="<?php echo date('Y-m-d');  ?>"  id="fechai" name="fechai" type="text" class="form-control">
      <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
      </div>
    </div>

    </div>

    <div class="form-group">

    <label class="control-label col-sm-2" for="fe">Final:</label>
    <div class="input-group date" data-provide="datepicker">
      <input data-date-format="yyyy/mm/dd" id="fechaf" name="fechaf" value="<?php echo date('Y-m-d');  ?>"   type="text" class="form-control">
      <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
      </div>
    </div>

    </div>


      <div class="form-group">
     <label class="control-label col-sm-2" for="fe">Tipo Pago:</label>
<div class="col-sm-6">
   <select id="tpago" name="tpago" class="form-control" onChange="despachosMobil();"  >
   
   <option value="3" > TODOS </option>
   <option value="1" > EFECTIVO </option>
   <option value="2" > CREDITO </option>

    </select>

    </div>

    </div>

<div class="form-group">
     <label class="control-label col-sm-2" for="fe">Movil:</label>
<div class="col-sm-6">
<select id="num_mobilre" class="form-control" name="num_mobilre" onchange="despachosMobil();totalDiarioSoloMovil()" >

    <option value="-1" > Seleccione </option>

    </select>

    </div>

    </div>

     <div class="form-group">
     <label class="control-label col-sm-2" for="fe">Nombre Repartidor:</label>
<div class="col-sm-6">
   <select id="repartidor" name="repartidor" class="form-control">

    </select>

    </div>

    </div>


  

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="button" onClick="buscarFechas();totalDiarioMobil();" class="btn btn-default">Buscar</button>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="button" onClick="actualizar();" class="btn btn-default">Actualizar</button>
      </div>
    </div>
    
  

  </fieldset>

  <fieldset class="row4">
    <legend>Servicios Despachados</legend>
    <p>
      <table width="90%" class="table table-striped" id="tablaid" >

      <thead>
        <tr>



          <td width="20%" align="center">SERVICIO</td>
          <td width="20%" align="center">FECHA</td>
          <td width="20%" align="center">CLIENTE</td>
          <td width="20%" align="center">T. PAGO</td>
          <td width="20%" align="center">VALOR</td>
          <td width="20%" align="center">REPARTIDOR</td>

          <td width="20%" align="center">ESTADO</td>
          <td width="20%" align="center">IMPRIMIR</td>
        </tr>

        </thead>

        <tbody id="tbody" >

        <tr>
          <td colspan="8"><div id="actualize" style="width: 100%; height: 200px; overflow-y: scroll;"> </div></td>
        </tr>
        </tbody>

      </table>

      <table width="604"> 
      
       <tr>

          <td width="229" bgcolor="#FF0000"> <strong>CANTIDAD SERVICIO</strong></td>

          <td width="141" > </td>
          <td width="67" > </td>
          <td width="147" > <input type="text" id="cantidadserv" readonly="readonly" />  </td>

        </tr>

        <tr>

          <td width="229" bgcolor="#FF0000"> <strong>TOTAL SERVICIO</strong></td>

          <td width="141" > </td>
          <td width="67" > </td>
          <td width="147" > <input type="text" id="total" readonly="readonly" />  </td>

        </tr>

      </table>

    </fieldset>

  </form>





  </div>

  <div id="dialog"  style="display:none" title="Impresion">
<iframe id="myframe" src="" width="100%" height="100%">
  
</iframe>
 </div>


</body>
</html>
