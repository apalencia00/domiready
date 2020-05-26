

<!DOCTYPE html>
<html>
<head>
  <title>SERV </title>
<link rel="stylesheet" type="text/css" href="css/estiloretencion.css" />
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap-datepicker.min.css" />
  <link href="css/jquery.growl.css" rel="stylesheet" type="text/css" />
  <script src="js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js" ></script>
  <script src="bootstrap/js/bootstrap-datepicker.min.js"></script>


  <script>
  
  function localizarServicioRetenidoDiario(){

      $.ajax({ url: "../back-end/Source/Servicio_Despacho.php",
        contentType: "application/json",
        dataType: 'json',
        type: "GET", 
        data: { "oper" : 18 },

        success: function(json){

          //console.log(json);      
          var res = json.success;    

            var json_string = JSON.stringify(json.root);
            var jsonObj = JSON.parse(json_string);
            var html = '<table class="table table-bordered" border="0">';

            $.each(jsonObj, function(key, value){

              
              html += '<tr> <td  onclick="setDatos('+jsonObj[key].num_servicio+')" >' + jsonObj[key].num_servicio + '</td>' + '<td >' +  jsonObj[key].fecha_serv + '</td>' + '<td >' +  jsonObj[key].nomb_completo + '</td>' + '<td >' +  jsonObj[key].descripcion + '</td>' + '<td ">' +  jsonObj[key].total + '</td>'  ;
              html += '</tr>';

            });

            html += '</table>';


            $('#act_table').html(html);

             
        }

      });



    }

    function setDatos(numserv){


      $.ajax({ url: "../back-end/Source/Servicio_Despacho.php",
        contentType: "application/json",
        dataType: 'json',
        type: "GET", 
        data: { "oper" : 19, "servicio" : numserv },

        success: function(json){

          console.log(json);
          document.getElementById("telef").value = json.root[0].clitel;
          document.getElementById("nombreset").value = json.root[0].nomb_completo;
          document.getElementById("valrete").value = json.root[0].total;
          document.getElementById("obsrete").value = json.root[0].DESCRIPCION;


             
        }

      });


    }

  
  

    function localizarServicioByTelefonoCelularRetenido(telef){

      $.ajax({ url: "../back-end/Source/Servicio_Despacho.php",
        contentType: "application/json",
        dataType: 'json',
        type: "GET", 
        data: { "oper" : 18, "telef" :telef  },

        success: function(json){

          console.log(json);      
          var res = json.success;    


          if(res){
            var json_string = JSON.stringify(json.root);
            var jsonObj = JSON.parse(json_string);
            var html = '';

            $.each(jsonObj, function(key, value){


              html += '<tr> <td  >' + jsonObj[key].num_servicio + '</td>' + '<td >' +  jsonObj[key].fecha_serv + '</td>' + '<td >' +  jsonObj[key].nombre_completo + '</td>' + '<td >' +  jsonObj[key].num_mob + '</td>' + '<td >'  + jsonObj[key].t_pago + '</td>' + '<td ">' +  jsonObj[key].total + '</td>' + '<td >' +  jsonObj[key].descripcion + '</td>' ;
              html += '</tr>';

            });


            $('#act_table').html(html);

          }    
        }

      });



    }

  </script>

  <style type="text/css">

    .table table-bordered{

      width: 50%;

    }

  </style>

</head>

<body onload="localizarServicioRetenidoDiario();">

  <form id="form" name="form" method="post" action="" class="register">

    <h1>Servicios Retenidos</h1>

    <fieldset class="row1">

          <legend>Servicio Detenido</legend>
<p>
<label> Telefono 
      </label>
      <input value="" id="tel" name="tel"  required="" tabindex="1" type="text" onkeypress=>

      
</p>

<p>

      <label> Nombre 
      </label>
      <input style="width: 300px" id="nomb_completo" name="nomb_completo"  required="" tabindex="1" type="text"  >

      </p>

      <p>

     <table class="table table-bordered" id="tablaid" width="200px" height="70%" >
      <thead>
        <tr>
          <td width="20%" >SERVICIO</td>
          <td width="20%" >FECHA</td>
          <td width="20%" >CLIENTE</td>
          <td width="20%" >ESTADO</td>
          <td width="20%" >VALOR</td>

        </tr>

      </thead>
      <tbody id="tbody">
        <tr>
          <td colspan="7">
            <div id="act_table" style="width: 100%; height: 200px; overflow-y: scroll;" > </div></td>
          </tr>

        </tbody>
      </table>

       <label> Telefono 
      </label>
      <input style="width: 300px" id="telef" name="telef"  required="" tabindex="1" type="text"  >

        <label> Nombre 
      </label>
      <input style="width: 300px" id="nombreset" name="nombreset"  required="" tabindex="1" type="text"  >


        <label> Valor 
      </label>
      <input style="width: 300px" id="valrete" name="valrete"  required="" tabindex="1" type="text"  >

      <label> Observacion 
      </label>
      <textarea style="width: 300px" id="obsrete" name="obsrete"  required="" tabindex="1"  > </textarea>



    </fieldset>

    <fieldset class="row5">

    <legend>Servicio Despachado</legend>

     <table class="table table-bordered" id="tablaid" width="300px" height="70%" >
      <thead>
        <tr>
          <td width="20%" >SERVICIO</td>
          <td width="20%" >FECHA</td>
          <td width="20%" >CLIENTE</td>
          <td width="20%" >MOVIL</td>

          <td width="20%" >ESTADO</td>
          <td width="20%" >VALOR</td>

        </tr>

      </thead>
      <tbody id="tbody">
        <tr>
          <td colspan="7">
            <div id="act_tabledespss" style="width: 100%; height: 200px; overflow-y: scroll;" > </div></td>
          </tr>

        </tbody>
      </table>

         <label> Telefono 
      </label>
      <input style="width: 300px" id="tel" name="tel"  required="" tabindex="1" type="text"  >

        <label> Nombre 
      </label>
      <input style="width: 300px" id="tel" name="tel"  required="" tabindex="1" type="text"  >


        <label> Valor 
      </label>
      <input style="width: 300px" id="tel" name="tel"  required="" tabindex="1" type="text"  >

      <label> Observacion 
      </label>
      <input style="width: 300px" id="tel" name="tel"  required="" tabindex="1" type="text"  >


    </fieldset>





  </form>

</body>
</html>
