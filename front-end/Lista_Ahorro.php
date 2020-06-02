
<!DOCTYPE html>
<html>
<head>
	<title>Menu Despacho</title>

 <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
 <link rel="stylesheet" href="bootstrap/css/bootstrap-datepicker.min.css" />
 <script src="js/jquery-1.9.1.min.js"></script>
 <script type="text/javascript" src="bootstrap/js/bootstrap.min.js" ></script>
 <script src="bootstrap/js/bootstrap-datepicker.min.js"></script>
 <script type="text/javascript" src="js/ajax.js"  ></script>


</head>

<script>

$(document).ready(function(){

  document.body.style.zoom = "75%";

});



</script>


<script type="text/javascript">

function buscarFechas(){

      fecha_ini = document.getElementById("fechai").value;
      fecha_fin = document.getElementById("fechaf").value;
      movil     = document.getElementById("num_mobilr").value;

      $.ajax({ url: "../back-end/Source/Ahorro.php",
        contentType: "application/json",
        dataType: 'json',
        type: "GET", 
        data: { "oper" : 3, "fecha_ini" : fecha_ini, "fecha_fin" : fecha_fin, "movil" : movil },

        success: function(json){

         var res = json.success;                     

         if(res){
          var json_string = JSON.stringify(json.root);
          var jsonObj = JSON.parse(json_string);

          var html = '<table border="0" class="table table-bordered">';
    
          $.each(jsonObj, function(key, value){

        console.log(jsonObj[key].id_ahorro);
        html += '<tr> <td width="10%" >' + jsonObj[key].id_ahorro + '</td>' + '<td width="10%" align ="center">' +  jsonObj[key].kf_empleado + '</td>' + '<td width="10%" >' + jsonObj[key].num_mob + '</td>'   +'<td width="10%" align ="center" >' +  jsonObj[key].fecha_ahorro + '</td>'  + '<td width="10%" align ="center" >' +  jsonObj[key].valor + '</td>';
         html += '</tr>';

      });

          html += '</table>';

          $('#actualize').html(html);
          
        }    
      }});



}


  function totalAhorro(mob){

   $.ajax({ url: "../back-end/Source/Parametrico.php", 

     type: "GET",
     contentType: "application/json",
     dataType: 'json',
     data: {"oper":22, "mobil" : mob },         
     success: function(json){
      console.debug(json);

      document.getElementById("total").value = json[0].total;


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

    if(json != ""){

      var $select = $('#num_mobilr'); 

      for(var i = 0; json.length; i ++){

        $select.append('<option value=' + json[i]['n_ide'] + '>' + json[i]['num_mob'] + '</option>');
      }

    }

  }

});

}


function loadAhorro(num_mobil)
{

  $.ajax({ url: "../back-end/Source/Empleado.php", 
   type: "GET",
   contentType: "application/json",
   dataType: 'json',
   data: { "oper" : 2, "mobil" : num_mobil },

   success: function(json){ 

    console.log(json); 
    var res = json.success;
    var respuesta = json.root;

    if(res){

      if(respuesta != null){

        var json_string = JSON.stringify(respuesta);



        var jsonObj = JSON.parse(json_string);
         var html = '<table border="0" class="table table-bordered">';
    

        $.each(jsonObj, function(key, value){

         //
         html += '<tr> <td width="10%" >' + jsonObj[key].id_ahorro + '</td>' + '<td width="10%" align ="center">' +  jsonObj[key].empnom + ' ' + jsonObj[key].empapell + '</td>'   +'<td width="10%" align ="center" >' +  jsonObj[key].fecha_ahorro + '</td>'  + '<td width="10%" align ="center" >' +  jsonObj[key].valor + '</td>';
         html += '</tr>';


         

       });

        html += '</table>'; 

        $('#actualize').html(html);

      }

    }
    
  }

});
}




</script>

<script>
 $(document).ready(function(){


   buscarRepartidor();

   $('#fechai').datepicker({
    format: "yyyy/mm/dd"
  });  

    $('#fechaf').datepicker({
  format: "yyyy/mm/dd"
});

 });

  





</script>

 <div class="container">
<form id="form" name="form" method="post" class="form-horizontal">

  <h1>Lista Ahorro Centro</h1>

  <fieldset class="row1">

    <div class="form-group">

      <label class="control-label col-sm-2" >Movil</label>
<div class="col-sm-6">

      <select class="form-control" id="num_mobilr" name="num_mobilr" onchange="loadAhorro(this.value);totalAhorro(this.value);" >

      <option value="-1" > Seleccione </option>

      </select>

      </div>

    </div>

  
  <div class="form-group">

        <label class="control-label col-sm-2" for="fe">Inicio:</label>
        <div class="input-group date" data-provide="datepicker">
          <input data-date-format="yyyy/mm/dd" value ="<?php echo date('Y-m-d');  ?>"  id="fechai" name="fechai" type="text" class="form-control">
          <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
          </div>
        </div>

      </div>

      <div class="form-group">

        <label class="control-label col-sm-2" for="fe">Final:</label>
        <div class="input-group date" data-provide="datepicker">
          <input data-date-format="yyyy/mm/dd" id="fechaf" value= "<?php echo date('Y-m-d') ?>"  name="fechaf" type="text" class="form-control">
          <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
          </div>
        </div>

      </div>


</fieldset>


 <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
<input class="btn btn-default" type="button" value="Buscar" onClick="buscarFechas();" />

</div>
    </div>


<fieldset class="row4">

  <table class="table table-bordered" >

    <tr>
      <th width="10%" >ID</th>
      <th width="10%" >EMPLEADO</th>
      <th width="10%" >MOVIL</th>
      <th width="10%" >FECHA</th>
      <th width="10%" >VALOR</th>

    </tr>
 
    <tr>
      <td colspan="5">
        <div id="actualize" style="width: 950px; height: 200px; overflow-y: scroll;"  > </div>
        </td>
      </tr>

      <tr>

        <td bgcolor="#FF0000"> <strong>TOTAL AHORRADO</strong></td>

        <td > </td>
        <td > </td>
        <td > <input type="text" id="total" readonly="readonly" />  </td>
      </tr>

    </table> 


  </fieldset>

</div>

</form>

</body>
</html>
