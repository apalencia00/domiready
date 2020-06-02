

<!DOCTYPE html>
<html>
<head>
  <title>SERVICIOS EXPRESS</title>

  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap-datepicker.min.css" />
  <link href="css/jquery.growl.css" rel="stylesheet" type="text/css" />
  <script src="js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js" ></script>
  <script src="bootstrap/js/bootstrap-datepicker.min.js"></script>
  
  <script type="text/javascript" src="js/jquery.js" ></script>
  
  <script>

$(document).ready(function(){

  document.body.style.zoom = "75%";

});



</script>

  <script>

    function cargarMovimientosCaja()
    {

      fecha_ini = document.getElementById("fechai").value;
      fecha_fin = document.getElementById("fechaf").value;
      tipo     = document.getElementById("tipo").value;

      $.ajax({ url: "../back-end/Source/Caja_Menor.php",
        contentType: "application/json",
        dataType: 'json',
        type: "GET", 
        data: { "oper" : 6, "fecha_ini" : fecha_ini, "fecha_fin" : fecha_fin, "param" : tipo },

        success: function(json){

         var res = json.success;                     

         if(res){
          var json_string = JSON.stringify(json.root);
          var jsonObj = JSON.parse(json_string);

          var html = '<table border="0" class="table table-bordered">';
    
          $.each(jsonObj, function(key, value){

				//console.log(jsonObj[key].num_servicio);
				html += '<tr> <td width="10%">' +  jsonObj[key].concepto + '</td>' + '<td width="10%">' +  jsonObj[key].detalle + '</td>' + '<td width="10%">' +  jsonObj[key].fecha_sys + '</td>' + '<td width="10%">' +  jsonObj[key].valor + '</td>'  + '</td>' + '<td width="10%">' +  jsonObj[key].saldo_caja_menor + '</td>' +  '<td width="10%">' +  jsonObj[key].num_mob + '</td>' ;
        html += '</tr>';

      });

          html += '</table>';

          $('#act_table').html(html);
          
        }    
      }});


    }

    function getConceptoCaja(){

     $.ajax({ url: "../back-end/Source/Parametrico_Caja.php", 
       type: "GET",
       contentType: "application/json",
       dataType: 'json',
       data: { "oper" : 1 },

       success: function(json){ 

         console.log(json);

         var $select = $('#tipo'); 
         $select.find('option').remove();  

         for(var i = 0; json.length; i ++){

          $select.append('<option value=' + json[i]['id_concepto_caja'] + '>' + json[i]['descripcion'] + '</option>');
        }
      }});

   }



 </script>

</head>

<body onload="getConceptoCaja();" >

 <div class="container">
  <form id="form" name="form" method="post" class="form-horizontal">

    <h1>Listado Caja Menor Centro</h1>

    <fieldset class="row1" >



      <div class="form-group">
        <label class="control-label col-sm-2" for="fe">Inicio:</label>

        <div class="input-group date" data-provide="datepicker">

          <input data-date-format="yyyy/mm/dd" value="<?php echo date('Y/m/d'); ?>" id="fechai" name="fechai" type="text" class="form-control">
          <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
          </div>
        </div>

      </div>

      <div class="form-group">

        <label class="control-label col-sm-2" for="fe">Final:</label>
        <div class="input-group date" data-provide="datepicker">
          <input data-date-format="yyyy/mm/dd" value="<?php echo date('Y/m/d'); ?>" id="fechaf" name="fechaf" type="text" class="form-control">
          <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
          </div>
        </div>

      </div>

      <div class="form-group">
       <label class="control-label col-sm-2" for="pam">Conceto Caja:</label>
       <div class="col-sm-6">


        <select class="form-control" name="tipo" id="tipo">

        </select> 

      </div>

    </div>


    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="button" onClick="cargarMovimientosCaja()" class="btn btn-default">Buscar</button>
      </div>
    </div>



  </fieldset> 

  <fieldset class="row4">
    <legend>Caja Menor </legend>


    <table class="table table-bordered" width="100%" height="200px" id ="tablaservi">
      <tr>
        <td width="10%" align="center">CONCEPTO CAJA</td>
        <td width="10%" align="center">DESCRIPCION</td>
        <td width="10%" align="center">FECHA</td>
        <td width="10%" align="center">VALOR</td>
        <td width="10%" align="center">SALDO CAJA</td>
        <td width="10%" align="center">EMPLEADO</td>

      </tr>
      <tr>
      <td  colspan="6"><div id="act_table" style="width: 100%; height: 200px; overflow-y: scroll;" > </div></td>
      </tr>
    </table>
  </fieldset>


</form>

</div>

</body>
</html>
