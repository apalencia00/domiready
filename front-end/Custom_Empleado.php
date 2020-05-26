

<!DOCTYPE html>
<html>
<head>
  <title>SERVICIOS EXPRESS</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/minified/jquery-ui.min.css" type="text/css" />
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

  <style type="text/css">

    @media screen and (min-width: 768px) {

      #myModal .modal-dialog  {width:800px;}

    }

  </style>

  <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js" ></script>


  <script type="text/javascript">

    $(document).on("click", "#bacano", function (e) {
     var data = $(this).data('id');
     $("#myModal #idcedu").text(data);
     $("#myModal #idced").val(data);
     console.log(data);

     $.ajax({

       url: '../back-end/Source/Empleado.php',
       type: 'GET',
       contentType : "application/json",
       dataType : "json",
       data : {"oper" : 11, "id_emp" : data },

       success: function(json)
       {
          console.log(json[0].empsucursal);
         $("#myModal #nombre").val(json[0].empnom);
         $("#myModal #apellido").val(json[0].empapell);
         $("#myModal #direccion").val(json[0].empdire);
         $("#myModal #telefono").val(json[0].emptel);
         $("#myModal #celular").val(json[0].empcel);
         $("#myModal #mobil").val(json[0].num_mob);

         contenedormodal = document.getElementById("myModal");

         document.getElementById("estado").options[0] = new Option(json[0].estado,json[0].estado);

         //$('#estado option[value="'+json.data[0].estado+'"]').attr('selected','selected');

         document.getElementById("sucursald").options[0] = new Option(json[0].empsucursal,json[0].empsucursal);


       },
       error : function(event){



       }


     });

   });




 </script>
 


<script type="text/javascript">

function buscarEstados(){

  $.ajax({ url: "../back-end/Source/Parametrico.php", 

   type: "GET",
   contentType: "application/json",
   dataType: 'json',
   data: {"oper":27 },         
   success: function(json){
          //alert(json);

          try{ 

          if(json != ""){

            var $select = $('#estado'); 

            for(var i = 0; json.length; i ++){

              $select.append('<option value=' + json[i]['estado'] + '>' + json[i]['estado'] + '</option>');
            }

          }

           }catch(e){}

        }

      });

}

function buscarSucursal(){

  $.ajax({ url: "../back-end/Source/Parametrico.php", 

   type: "GET",
   contentType: "application/json",
   dataType: 'json',
   data: {"oper":28 },         
   success: function(json){
          //alert(json);

          try{ 

          if(json != ""){

            var $select = $('#sucursald'); 

            for(var i = 0; json.length; i ++){

              $select.append('<option value=' + json[i]['sucursal'] + '>' + json[i]['sucursal'] + '</option>');
            }

          }

           }catch(e){}

        }

      });

}



  $('#myTabs').bind('show', function(e) {  

    paneID = $(e.target).attr('href');
    src = $(paneID).attr('data-src');
    // if the iframe hasn't already been loaded once
    if($(paneID+" iframe").attr("src")=="")
    {
      $(paneID+" iframe").attr("src",src);
    }



  });





</script>



</style>

</style>

<script>

  function tipoEmpleo(tipo){

    if(tipo == "O"){

      document.getElementById("num_mobilre").disabled = true;
      document.getElementById("sucursal").disabled = true;

      $.ajax({ url: "../back-end/Source/Empleado.php", 

       type: "GET",
       contentType: "application/json",
       dataType: 'json',
       data: {"oper":9 },   

       success: function(json){

         if(json.root != null){

          var res = json.success;                   

          if(res){

            var json_string = JSON.stringify(json.root);
            var jsonObj = JSON.parse(json_string);

            var html = '<table class="table table-striped" border="0">';

            $.each(jsonObj, function(key, value){


              html += '<tr> <td width="15%" scope="row" id="bacano" data-target="#myModal" data-toggle="modal" data-id="'+jsonObj[key].n_ide+'" >' + jsonObj[key].id_empleado + '</td>' +  '<td width="15%">' +  jsonObj[key].n_ide + '</td>' + '<td width="10%">' +  jsonObj[key].empnom + '</td>' + '<td width="15%">'  + jsonObj[key].empapell + '</td>' + '<td width="15%">'  + jsonObj[key].empdire + '</td>' + '<td width="15%">'  + jsonObj[key].empcel + '</td>' + '<td width="15%">'  + jsonObj[key].num_mob + '</td>' +'<td width="15%">'  + jsonObj[key].estado + '</td>' +  '<td width="15%">'  + jsonObj[key].empsucursal + '</td>'  ;
              html += '</tr>';

            });
            html += '</table>';
            $('#act_table').html(html);

          }

        }

      }

    });

    }else{
      document.getElementById("num_mobilre").disabled = false;
      document.getElementById("sucursal").disabled = false;

      $('#act_table > tbody').remove();

    }

  }

  function checkLength( o, n, min, max ) {
    if ( o.val().length > max || o.val().length < min ) {
      o.addClass( "ui-state-error" );
      updateTips( "Length of " + n + " must be between " +
        min + " and " + max + "." );
      return false;
    } else {
      return true;
    }
  }

  function editar(){
      
      var idced  = $("#myModal #idced").val();
      var nombre = $("input#nombre");
      var apellido = $("input#apellido");
      var direccion  = $("input#direccion");
      var telefono = $("input#telefono");
      var celular = $("input#celular").val();
      var mobil = $("input#mobil");
      var estado = $("select#estado").val();
      var sucursal = $("select#sucursald").val();
      console.log(sucursal);console.log(estado);

      if(estado != "" || sucursal != "" || sucursal == "S" ){ 

      $.ajax({ url: "../back-end/Source/Empleado.php", 

         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: {"oper":7, "id" : idced ,"nomb" : nombre[0].value, "ape" : apellido[0].value, "dire" : direccion[0].value, "tel" : telefono[0].value, "mob" : mobil[0].value, "est" : estado, "suc" : sucursal, "cel" : celular  },   

         success : function(json){

            if(json[0].success){
            alert(json[0].mensaje);
            location.reload();

          }else{alert(json[0].mensaje);}

         }      

       });

       
      }else{alert("Debe seleccionar un estado y/o sucursal valido");
        }
    }




function localizarInfoEmpleado(id)

{

  $.ajax({ url: "../back-end/Source/Empleado.php", 

   type: "GET",
   contentType: "application/json",
   dataType: 'json',
   data: {"oper":4, "iden" : id},   

   success: function(json){

     if(json.root != null){

      var res = json.success;                   

      if(res){

        var json_string = JSON.stringify(json.root);
        var jsonObj = JSON.parse(json_string);

        var html = '<table class="table table-striped" border="0">';
        $.each(jsonObj, function(key, value){


          html += '<tr> <td width="15%" scope="row" id="bacano" data-target="#myModal" data-toggle="modal" data-id="'+jsonObj[key].n_ide+'" >' + jsonObj[key].id_empleado + '</td>' +  '<td width="15%">' +  jsonObj[key].n_ide + '</td>' + '<td width="10%">' +  jsonObj[key].empnom + '</td>' + '<td width="15%">'  + jsonObj[key].empapell + '</td>' + '<td width="15%">'  + jsonObj[key].empdire + '</td>' + '<td width="15%">'  + jsonObj[key].empcel + '</td>' + '<td width="15%">'  + jsonObj[key].num_mob + '</td>' +'<td width="15%">'  + jsonObj[key].estado + '</td>' +  '<td width="15%">'  + jsonObj[key].empsucursal + '</td>'  ;
          html += '</tr>';

        });


        html += '</table>';
        $('#act_table').html(html);




      }


    }else{
     $('#act_table > tbody').remove();
   }

 }

});

}

// HABILITA EL COMBO DE MOVILES DEPENDIENDO DE LA SUCURSAL

function localizarMovilSucursal(suc)

{


  if(suc !== "P" )

  {

    $.ajax({ url: "../back-end/Source/Empleado.php", 
     type: "GET",
     contentType: "application/json",
     dataType: 'json',
     data: { "oper" : 10, "suc" : suc },

     success: function(json){ 

      try{

       var $select = $('#num_mobilre'); 

       for(var i = 0; json.length; i ++){
        $select.append('<option value=' + json[i]['n_ide'] + '>' + json[i]['num_mob'] + '</option>');
      }

    }catch(e){

    }


  }

});



  }


}


</script>

</head>

<body >

  <div id="wrapper">

    <form id="form" name="form" method="post" action="">

      <legend>
        CRITERIO DE BUSQUEDA
      </legend>

      <fieldset >

        <label>

          TIPO EMPLEADO

        </label>

        <select id="tipoemp" onchange="tipoEmpleo(this.value);" >

          <option value="S" > SELECCIONE </option>
          <option value="O" > OFICINA </option>
          <option value="R" > REPARTIDOR </option>

        </select>


        <label>

         MOBIL
       </label>

       <select id="sucursal" onchange="localizarMovilSucursal(this.value);" >

        <option value="P" > SELECCIONE </option>
        <option value="C" > CENTRO </option>
        <option value="N" > NORTE </option>
        <option value="CN" > CENTRO-NORTE </option>

      </select>

      <select id="num_mobilre" name="num_mobilre" class="select-style" onChange="localizarInfoEmpleado(this.value)" >

        <option value="invalid" >SELECCIONE</option>

      </select>




    </fieldset>

    <fieldset>

     <div class="">

       <table class="table table-striped" id="tableID" width="80%" height="70%" align="center" >
        <thead>
          <tr>
            <td width="10%" >ID</td>
            <td width="10%" >IDENTIFICACION</td>
            <td width="10%" >NOMBRE</td>
            <td width="10%" >APELLIDO</td>
            <td width="10%" >DIRECION</td>
            <td width="10%" >TELEFONO</td>
            <td width="10%" >MOBIL</td>
            <td width="10%" >ESTADO</td>
            <td width="10%" >SUCURSAL</td>
            
          </tr>

        </thead>

        <tbody id="tbody">
          <tr>
            <td colspan="9">
              <div id="act_table" style="width: 1000px; height: 200px; overflow-y: scroll;" > </div></td>
            </tr>

          </tbody>
        </table>

      </div>


    </fieldset>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <label class="label label-info"  name="idcedu" id="idcedu"> </label>
        <input type="hidden" name="idced" id="idced" >
        <h4 class="modal-title" id="">Editar Empleado  </h4>
        
      </div>
      <div class="modal-body">

        <form id="form_dialog" class="form-horizontal" name="form_dialog" onsubmit="return false" >

                <div class="form-group">

                  <label class="control-label col-sm-4">Nombre
                  </label>
                  <div class="col-sm-8">

                  <input  type="text" name="nombre" id="nombre" class="form-control col-lg-100"/>
                  </div>

                </div>

                <div class="form-group">

                  <label class="control-label col-sm-4">Apellido
                  </label>
                  <div class="col-sm-8">

                    <input type="text" name="apellido" id="apellido"   class="form-control col-lg-100">

                  </div>

                </div>

                <div class="form-group">

                  <label class="control-label col-sm-4">Direccion
                  </label>
                  <div class="col-sm-8">

                    <input type="text" name="direccion" id="direccion"  class="form-control col-lg-100">

                  </div>

                </div>

                <div class="form-group">

                  <label class="control-label col-sm-4">Telefono
                  </label>
                  <div class="col-sm-8">

                    <input type="text" id="telefono" name="telefono" class="form-control col-lg-100"/>

                  </div>

                </div>


                <div class="form-group">

                  <label class="control-label col-sm-4">Celular
                  </label>
                  <div class="col-sm-8">

                    <input type="text" id="celular" name="celular" class="form-control col-lg-100"/>

                  </div>

                </div>

                <div class="form-group">

                  <label class="control-label col-sm-4">Mobil
                  </label>
                  <div class="col-sm-8">

                    <input type="text" id="mobil" name="mobil" class="form-control col-lg-100"/>

                  </div>

                </div>

                <div class="form-group">

                  <label class="control-label col-sm-4">Estado
                  </label>
                  <div class="col-sm-8">

                    <select class="form-control col-lg-100" id="estado" onclick="buscarEstados()" name="estado" >

                     

                    </select >

                  </div>

                </div>

                 <div class="form-group">

                  <label class="control-label col-sm-4">Sucursal
                  </label>
                  <div class="col-sm-8">
                  <label for="obs"></label>
                  <select class="form-control col-lg-100" id="sucursald" onclick="buscarSucursal()" >

                    

                  </select >

                  <br>

<button type="button" id="save" onclick="editar()" class="btn btn-primary btn-block">Aceptar</button>

                

              </form>

     

</div>
<div class="modal-footer">
  
</div>
</div>

</div>
</div>
    


</form>


</div>

</body>
</html>
