<?php

session_start();

if($_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "")  {

$permisos = $_SESSION['admon_mod'];
$datos_mod = json_decode($permisos,true);

$usuario = $datos_mod["usuadoc"];



?>

<!DOCTYPE html>
<html>
<head>
	<title>:: YOUCODE</title>

  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap-datepicker.min.css" />
  <script src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js" ></script>
  <script src="bootstrap/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript" src="js/ajax2.js"  >
</script>



<script type="text/javascript">

function guardar(){

var getselect_emp =  document.getElementById("num_mobilre").value;
var total_mobil   =  document.getElementById("realmobil").value;
var cantidad      =  document.getElementById("cantidad").value;
var usuario       =  document.getElementById("usu").value;
var fliquidacion  = document.getElementById("fliquidar").value;


 $.ajax({ url: "../back-end/Source/Liquidar.php", 
           type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "oper" : 2, "fk_empleado" : getselect_emp, "total" : total_mobil, "cantidad" : cantidad, "usuario" : usuario,"fliquidar" : fliquidacion }, 

              success: function(json){
           
           var res = json.success;                     
                  
           if(res){
              alert(json.root[0].mensaje); location.reload();
           }else{
            alert(json.root[0].mensaje);
           }

         }

       });

}
  
  function cargarDatos(){

    getselect_emp = document.getElementById("num_mobilre").value;
    getfechaliquidar = document.getElementById("fliquidar").value;
    valor = document.getElementById("valor").value;
	  porce = document.getElementById("porce").value;

  var suma_cantidad = 0;

  var tr = 0;
  var te = 0;
  var tr = 0;
  var te = 0;
  var pr = 0;
  var sw = 0;
  var i  = 0;
  var cr = 0;
  var rm = 0;

  var tipo_pago = 0;
  var total = 0;

  var comr = 0;
  var come = 0;


  $.ajax({ url: "../back-end/Source/Parametrico_Empleado.php", 
           type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "oper" : 4, "num_mobil" : getselect_emp , "fliquida" : getfechaliquidar }, 

              success: function(json){

                if(json.root != null){
           
           var res = json.success;                     
                  
           if(res){

            var json_string = JSON.stringify(json.root);
            var jsonObj = JSON.parse(json_string);
      var html = '<table border="0">';
                        html += '';
      $.each(jsonObj, function(key, value){

            //   console.log(jsonObj[key]);

         total  =+ jsonObj[key].total;
          console.log(total);
        tipo_pago = parseInt(jsonObj[key].t_pago); 
         comr = parseInt(jsonObj[key].porcentaje_com); 

         come = 100 - parseInt(comr);

          if(tipo_pago == 1 ) {

      tr = parseInt(tr) + (total * comr/100);
      te = parseInt(te) + (total * come/100);

    }

      else{

            tr = tr + (total * comr/100);
            te = te + (total * come/100);

              cr=cr + total;
                    sw=1;

         }

          pr = pr + total;
                i= i + 1;

                if(sw == 1){
                  if( porce != 0 ){
                   valparq_porc = valor * ( porce/100 );
             rm = te - cr - valparq_porc;
                }else{
                  rm =  te - cr;
               }
                
            }else{
                 rm = te;
            }
//

        
        html += '<tr> <td width="15%">' +  jsonObj[key].n_des + '</td>' + '<td width="10%">' +  jsonObj[key].fecha_desp + '</td>' + '<td width="15%">'  + jsonObj[key].clienom + '</td>' + '<td width="15%">'  + jsonObj[key].dir_proc + '</td>'  +   '<td width="15%">'  + jsonObj[key].dir_dest + '</td>' + '<td width="15%">'  + jsonObj[key].tpago + '</td>' + '<td width="15%">'  + jsonObj[key].total + '</td>' + '<td rowspan>'  + jsonObj[key].descripcion + '</td>'  ;
        html += '</tr>';

        suma_cantidad = parseInt(suma_cantidad) + parseInt(jsonObj[key].cantidad_despacho);
         document.getElementById("cantidad").value  = suma_cantidad;
      });
                        
      html += '</table>';

      $('#act_table').html(html);

      document.getElementById("realmobil").value = parseInt(rm);
      document.getElementById("mobil").value = tr;
      document.getElementById("credito").value = cr;
      document.getElementById("producido").value = parseInt(pr);
      document.getElementById("comision").value = te;
          
         }    

       }else{

          $("#act_table tbody").remove();

       }
    } // este
        
});

}

function validarParqueo(){

  if(document.getElementById('parqueo').value == 'S'){
      alert("Digite valor del parqueo");
    document.getElementById("valor").disabled = false;
    document.getElementById("valor").focus();
  }else{
  document.getElementById("valor").disabled = true;
  document.getElementById("valor").value = '';

}

}

count = 0;

function restaPorcentajeParqueoRealMobil(e) {

 var key=e.keyCode || e.which;
    
   if (e.which == 13) {

    count++;

    if(count==1){

    valor_parqueo = document.getElementById("valor").value;
    valor_realmobil = document.getElementById("realmobil").value;

      parqueo_porcentaje = parseInt((valor_parqueo * 40/100));

    //parqueo_porcentaje = valor_parqueo * (40/100);

    valor_ultimo_real_mobil = valor_realmobil-parqueo_porcentaje;

    document.getElementById("realmobil").value = parseInt(valor_ultimo_real_mobil);


   }

 }


}


function buscarRepartidor(){

$.ajax({ url: "../back-end/Source/Parametrico.php", 
      
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
            data: {"oper":19 },         
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
         
         function buscarNombreRepartidor(idnumb){
             
             //var ide_mobil = document.getElementById("num_mobilre").value;
             $.ajax({ url: "../back-end/Source/Parametrico.php", 
      
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
            data: {"oper":6 , "mobil_ide" : idnumb },         
         success: function(json){
             
             //console.log(json);

             try{  
             
              var $select = $('#repartidor'); 
                $select.find('option').remove();  
                                
                $select.append('<option value=' + json['n_ide'] + '>' + json['empnom'] + '</option>');
            
    }catch(e){}

     }
    
        });
        
             
             
             
         }



</script>


<script>

 $(document).ready(function(){
 
     buscarRepartidor();

     
     
    });
     
  
</script>

</script>







	
</head>
<body onload="">

  
<form id="form" name="form" method="post" action="" class="form-inline">  

 <h1>Liquidacion Norte </h1>
 
 <fieldset class="row1">

 
 <input type="hidden" name="usu" id="usu" value="<?php echo $usuario ?>" >

                    <div class="form-group">

    <label class="control-label col-sm-4" for="fe">Fecha Liquidacion:</label>
    <div class="input-group date" data-provide="datepicker">
      <input data-date-format="yyyy/mm/dd" value="<?php echo date('Y-m-d');  ?>"   id="fliquidar" name="fliquidar" type="text" class="form-control">
      <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
      </div>
    </div>

    </div>


    <div class="form-group">
     <label class="control-label col-sm-4" for="fe">Movil:</label>
<div class="col-sm-6">
    <select id="num_mobilre" class="form-control" name="num_mobilre" onchange="cargarDatos();" >

    <option value="0" > Seleccione </option>

    </select>

    </div>

    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" for="pam">Parqueo</label>
      <div class="col-sm-6">
        <select onchange="validarParqueo()" class="form-control" id="parqueo"> 

          <option value="N">NO</option>
          <option value="S">SI</option>

        </select>

      </div>
    </div>


<div class="form-group">
      <label class="control-label col-sm-4" for="nom">Valor:</label>
      <div class="col-sm-4">
        <input class="form-control" type="text" id="valor" name="valor"  onkeypress="restaPorcentajeParqueoRealMobil(event)" disabled />

      </div>
    </div>



 <div class="form-group">
      <label class="control-label col-sm-6" for="pam">Porcentaje</label>
      <div class="col-sm-4">
        <select class="form-control" id="porce"> 

        <option value="0">0</option>
      <option value="30">30</option>
      <option value="40">40</option>
      <option value="50">50</option>
      <option value="60">60</option>
      <option value="70">70</option>
      <option value="80">80</option>

        </select>

      </div>
    </div>
    


 
 </fieldset>
 
            <fieldset class="row4">
                <legend>Servicios Despachados</legend>
              
<table width="100%" cellspacing="1" height="200px" border="0" align="center"  class="" >
 
  <thead>
 <tr>
  
    <td width="15%">N.DESPACHO</td>
    <td width="15%">FECHA</td>
    <td width="15%">CLIENTE</td>
    <td width="15%">ORIGEN</td>
    <td width="15%">DESTINO</td>
    <td width="15%">PAGO</td>
    <td width="15%">VALOR</td>
    <td width="15%">SUCURSAL</td>
    </tr>
   </thead>

   <tbody id="tbody">
  
  <tr>
    <td colspan="9"><div id="act_table" style="width: 100%; height: 200px; overflow-y: scroll;"> </div></td>
  </tr>
  </tbody>
</table>



</fieldset>

<fieldset class="row4">

<legend>
Detalle Liquidacion
</legend>
<p>
<label>
Cantidad Servicios
</label>

<div class="form-group">
      <label class="control-label col-sm-4" for="nom">Cantidad:</label>
      <div class="col-sm-2">
        <input class="form-control" type="text" id="cantidad" name="cantidad"  disabled />

      </div>
    </div>


<div class="form-group">
      <label class="control-label col-sm-4" for="nom">Comision Empresa:</label>
      <div class="col-sm-2">
        <input class="form-control" type="text" id="comision" name="comision"  disabled />

      </div>
    </div>



<div class="form-group">
      <label class="control-label col-sm-4" for="nom">Movil:</label>
      <div class="col-sm-2">
        <input class="form-control" type="text" id="mobil" name="mobil"  disabled />

      </div>
    </div>


    <div class="form-group">
      <label class="control-label col-sm-4" for="nom">Credito:</label>
      <div class="col-sm-2">
        <input class="form-control" type="text" id="credito" name="credito"  disabled />

      </div>
    </div>



    <div class="form-group">
      <label class="control-label col-sm-4" for="nom">Producido:</label>
      <div class="col-sm-2">
        <input class="form-control" type="text" id="producido" name="producido"  disabled />

      </div>
    </div>


<div class="form-group">
      <label class="control-label col-sm-6" for="nom">Real Movil:</label>
      <div class="col-sm-2">
        <input class="form-control" type="text" id="realmobil" name="realmobil"  disabled />

      </div>
    </div>




</fieldset>


<div class="form-group">
      
        <button class="btn btn-primary" type="button" id="registro" name="registro" onclick="guardar()" class="btn btn-default">Liquidar</button>
      
    </div>

</form>


</body>
</html>

<?php }

else{ header('Location: 404.php');
    
      unset($_SESSION['usu_cod']);
        
        // DESTROY COOKIE
        if (isset($_COOKIE['key'])) {
    unset($_COOKIE['key']);
    setcookie('key', '', time() - 3600, '/'); // empty value and old timestamp
        }
    
    
    
}

 ?>
