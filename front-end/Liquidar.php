

<!DOCTYPE html>
<html>
<head>
	<title>:: YOUCODE</title>

<link rel="stylesheet" type="text/css" href="css/style_consultas.css" />
<link title="win2k-cold-1" media=all href="css/calendario.css" type="text/css" rel="stylesheet"/>

<script type="text/javascript" src="js/jquery.js" ></script>

<script type="text/javascript" src="js/ajax2.js"  ></script>

<script>

$(document).ready(function(){

  document.body.style.zoom = "75%";

});



</script>



<script type="text/javascript">
  
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
         data: { "oper" : 3, "num_mobil" : getselect_emp }, 

              success: function(json){
           
           var res = json.success;                     
                  
           if(res){
            var json_string = JSON.stringify(json.root);
            var jsonObj = JSON.parse(json_string);
      var html = '<table border="0">';
                        html += '';
      $.each(jsonObj, function(key, value){

         total = jsonObj[key].total;
         tipo_pago = parseInt(jsonObj[key].t_pago); 
         comr = parseInt(jsonObj[key].porcentaje_com); 

         come = 100 - parseInt(comr);

          if(tipo_pago == 1 ) {

      tr = parseInt(tr) + (total * comr/100);
      te = parseInt(te) + (total * come/100);

          }else{

            tr = tr + (total * comr/100);
            te = te + (total * come/100);

              cr=cr + total;
                    sw=1;

          }

           pr = pr + total;
                i= i + 1;

                if(sw == 1){
                 if( porcentaje != 0 ){
               valparq_porc = valor * ( porcentaje/100 );
               rm = te - cr - valparq_porc;
              }else{
                  rm =  te - cr;
              }
                
            }else{
                 rm = te;
            }


        
        html += '<tr> <td width="15%"  >' + jsonObj[key].num_servicio + '</td>' +  '<td width="15%">' +  jsonObj[key].n_des + '</td>' + '<td width="10%">' +  jsonObj[key].fecha_desp + '</td>' + '<td width="15%">'  + jsonObj[key].clienom + '</td>' + '<td width="15%">'  + jsonObj[key].total + '</td>'  ;
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
    }
        
});

}

function validarParqueo(){

  if(document.getElementById('parqueo').value == 'SI'){
      alert("Digite valor del parqueo");
    document.getElementById("valor").disabled = false;
    document.getElementById("valor").focus();
  }else{
  document.getElementById("valor").disabled = true;
  document.getElementById("valor").value = '';

}
}


function buscarRepartidor(){

$.ajax({ url: "../back-end/Source/Parametrico.php", 
      
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
            data: {"oper":5 },         
         success: function(json){
             
             //console.log(json);
             
              var $select = $('#num_mobilre'); 
                $select.find('option').remove();  
                
                for(var i = 0; json.length; i ++){
                
                $select.append('<option value=' + json[i]['n_ide'] + '>' + json[i]['num_mob'] + '</option>');
            }
             
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
             
              var $select = $('#repartidor'); 
                $select.find('option').remove();  
                                
                $select.append('<option value=' + json['n_ide'] + '>' + json['empnom'] + '</option>');
            
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


<body>
<center>
            <form id="">
            <fieldset>
            <legend><strong>LIQUIDACION DIARIA </strong></legend>
            <table width="905" border="0" style="height:auto; width:auto" align="center" >
  <tr>
    <td width="93"><p class=""><label for="fliquidar">FECHA LIQUIDAR</label></p></td>
    <td width="152"><label for="fliquidar"></label>
      <input type="text" name="fliquidar" id="fliquidar" value="<?php echo date('Y-m-d') ?>" ></td>
    <td width="134"><p class=""><label for="factual">FECHA ACTUAL</label></p></td>
    <td width="159"><label for="factual"></label>
      <input type="text" name="factual" id="factual" value="<?php echo date('Y-m-d h:i:s') ?>" ></td>
  </tr>
  <tr>
    <td><p class=""><label for="emp">EMPLEADO</label></p></td>
    <td>
    
      <p>
                <label> Mobil * </label>
                
                <select style="width:auto" id="num_mobilre" name="num_mobilre" class="select-style" onchange="cargarDatos();" >
          
                   <option value="0"> SELECCIONE </option> 
                    
              </select>
            
    </p>
                
                <p>
                <label> Nombre * </label>
                <select style="width:200px" id="repartidor" class="select-style"> </select>
           
                
                </p>
 
                
  
    
    </td>
    <td><p class="">
      <label for="ahorro">AHORRO</label>
    </p></td>
    <td><input id="ahorro" name="ahorro" type="text"></td>
  </tr>
  <tr>
    <td>
      <p class="">
        <label for="parqueo2">PARQUEOS</label>
      </p>
    </td>
    <td><select id="parqueo" name="parqueo" class="select-style" onchange="validarParqueo()">
      <option value="NO">NO</option>
      <option value="SI">SI</option>
    </select></td>
    <td>
       <p class="">
         <label for="valor2">VALOR</label>
       </p>
    </td>
    <td><input onKeyPress="" id="valor" name="valor" type="text" disabled></td>
    </tr>
  <tr>
    <td>
    
     <p class="">
    
     <label for="porcen">PORCENTAJE</label>
    </p>
    <select id="porce" name="porce" class="select-style" onchange="validarParqueo()">
      <option value="0">0</option>
      <option value="30">30</option>
      <option value="40">40</option>
      <option value="50">50</option>
      <option value="60">60</option>
      <option value="70">70</option>
      <option value="80">80</option>
    </select>
    
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

<tr>
  
 <table width="100%" height="70%" border="0" style="display:inline-block;">
              <tr>
                <td height="40" colspan="7">
                 <h1>Servicios Express</h1>
                </td>
              </tr>
              <tr>
      
                <td width="12%"></td>
                <td width="12%"></td>
                <td width="12%"></td>
                <td width="12%"></td>
                <td width="12%"></td>
                <td width="12%"></td>
              </tr>
              <tr>
                <td height="226" colspan="8">
                   <fieldset class="row1">
                 
                  <table width="100%" height="100%" border="0" align="center" cellspacing="1" class="" id ="tablaservi">
                    <tr>
                      <td width="25%" align="center" height="17">SERVICIO</td>
                      <td width="25%" align="center">N.DESPACHO</td>
                      <td width="25%" align="center">FECHA</td>
                      <td width="25%" align="center">CLIENTE</td>

                      <td width="25%" align="center">VALOR</td>
  
                    </tr>
                    <tr>
                      <td  colspan="8"><div id="act_table" style="width: 100%; height: 70px; overflow-y: scroll;" > </div></td>
                    </tr>
                  </table>
                </fieldset>
                </td>
              </tr>
  </table>

              <form id="contactform">
            <fieldset>

            <table width="1050" border="0" style="height:auto; width:auto" align="center">
  <tr>
    <td width="119"><p class="">
      <label for="fliquidar">CANTIDAD SERVICIOS </label></p></td>
    <td width="180"><label for="fliquidar"></label>
      <input type="text" name="cantidad" id="cantidad"  ></td>
    <td width="132"><p class="">
      <label for="factual">COMISION EMPRESA</label></p></td>
    <td width="214">
      <input type="text" name="comision" id="comision"  ></td>
    <td width="105"><label for="emp">MOBIL</label></td>
    <td width="274">
      <input type="text" name="mobil" id="mobil"  /></td>
  </tr>
  <tr>
    <td><p class="">
      <label for="ahorro2">CREDITO</label>
    </p></td>
    <td><input id="credito" name="credito" type="text"  /></td>
    <td><p class="">
      <label for="valor3">PRODUCIDO</label>
    </p></td>
    <td><input id="producido" name="producido" type="text" /></td>
    <td>
    <p class="">
      <label for="ahorro2">REAL MOBIL</label>
    </p>
    </td>
    <td><label for="textfield"></label>
      <input type="text" name="realmobil" id="realmobil"  /></td>
  </tr>
  <tr>
    <td>
      <p class="">
      <input id="botonLiquidar" name="botonLiquidar" value="LIQUIDAR" type="button" class="buttom" onclick="liquidarTotal()" /> 
      </p>
    </td>
    <td>
      
      <p class="">
      <input id="botonActualizar" name="botonActualizar" value="ACTUALIZAR" type="button" class="buttom" onclick="actualizar()" /> 
      </p>

    </td>
    <td>
       <p class="">&nbsp;</p>
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>

<tr>
  

  </td>
  
</tr>

</table>

</fieldset>
            

             
                </form>
                </div>

  </td>
  
</tr>

            

             
                </form>


</body>
</center>
</html>
