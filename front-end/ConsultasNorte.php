<?php

session_start();


?>

<!DOCTYPE html>
<html>
<head>
	<title>:: E&L Solutions</title>

<style type="text/css">
      .calendar {
        font-family: 'Trebuchet MS', Tahoma, Verdana, Arial, sans-serif;
        font-size: 0.9em;
        background-color: #EEE;
        color: #333;
        border: 1px solid #DDD;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
        padding: 0.2em;
        width: 14em;
      }
      
      .calendar .months {
        background-color: #F6AF3A;
        border: 1px solid #E78F08;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
        color: #FFF;
        padding: 0.2em;
        text-align: center;
      }
      
      .calendar .prev-month,
      .calendar .next-month {
        padding: 0;
      }
      
      .calendar .prev-month {
        float: left;
      }
      
      .calendar .next-month {
        float: right;
      }
      
      .calendar .current-month {
        margin: 0 auto;
      }
      
      .calendar .months .prev-month,
      .calendar .months .next-month {
        color: #FFF;
        text-decoration: none;
        padding: 0 0.4em;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
        cursor: pointer;
      }
      
      .calendar .months .prev-month:hover,
      .calendar .months .next-month:hover {
        background-color: #FDF5CE;
        color: #C77405;
      }
      
      .calendar table {
        border-collapse: collapse;
        padding: 0;
        font-size: 0.8em;
        width: 100%;
      }
      
      .calendar th {
        text-align: center;
      }
      
      .calendar td {
        text-align: right;
        padding: 1px;
        width: 14.3%;
      }
      
      .calendar td span {
        display: block;
        color: #1C94C4;
        background-color: #F6F6F6;
        border: 1px solid #CCC;
        text-decoration: none;
        padding: 0.2em;
        cursor: pointer;
      }
      
      .calendar td span:hover {
        color: #C77405;
        background-color: #FDF5CE;
        border: 1px solid #FBCB09;
      }
      
      .calendar td.today span {
        background-color: #FFF0A5;
        border: 1px solid #FED22F;
        color: #363636;
      }
    </style>

<link rel="stylesheet" type="text/css" href="../css/style_consultas.css" />
<link title="win2k-cold-1" media=all href="../css/calendario.css" type="text/css" rel="stylesheet"/>

<script type="text/javascript" src="../js/jquery.js" ></script>

<script>

$(document).ready(function(){

  document.body.style.zoom = "75%";

})

</script>

<script src="../js/jquery.growl.js" type="text/javascript"></script>
<link href="../css/jquery.growl.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/calendario.js" ></script>


<script type="text/javascript">




function buscarFechas(){

  var parametro = document.getElementById("parametro").value;
  var fecha_ini = document.getElementById("fechai").value;
  var fecha_fin = document.getElementById("fechaf").value;


if(fechai != '' && fechaf != ''){

  $.ajax({ url: "../Source/Servicio_Despacho_Norte.php", 
               type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "oper" : 11, "fechai" : fecha_ini, "fechaf" : fecha_fin, "param" : parametro },
                 
         success: function(json){


         var res = json.success;
         var param = json.param;

        if(res){

             // console.log(json);

             if(param == 1){

                    var json_string = JSON.stringify(json.data);
            var jsonObj = JSON.parse(json_string);
      var html = '<table border="0">';
                        html += '<td align="center">SERVICIO</td>';
                        html += '<td align="center">FECHA</td>';
                        html += '<td align="center">CLIENTE</td>';
                        html += '<td align="center">VALOR</td>';
                        html += '<td align="center">REPARTIDOR</td>';
                        html += '<td align="center">ESTADO</td>';
                        html += '<td align="center">IMPRIMIR</td>';
    
      $.each(jsonObj, function(key, value){
        
        console.log(jsonObj[key]);
        html += '<tr> <td width="20%"  align="center" >' + jsonObj[key].num_servicio + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].fecha_serv + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].nombre_completo + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].total + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].descripcion + '</td>' + '<td onclick="imprimir_report('+jsonObj[key].num_servicio+')"  > <img src="../images/pdf.png" alt="" border=3 height=30 width=30></img> </td>';
        html += '</tr>';
        
      });
                        
      html += '</table>';

      $('#tablaid').html(html);

    }else{

         var json_string = JSON.stringify(json.data);
            var jsonObj = JSON.parse(json_string);
      var html = '<table border="0">';
                        html += '<td> # Liquidacion </td>';
                        html += '<td> Empleado </td>';
                        html += '<td> # Fecha Liquidacion </td>';
                        html += '<td> Cantidad Serv </td>';
                        html += '<td> Total </td>';
      $.each(jsonObj, function(key, value){
        
        //console.log(jsonObj[key]);
        html += '<tr> <td width="20%"  align="center" >' + jsonObj[key].id_liquidacion + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].fk_empleado + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].fecha_liq + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].cantidad_serv + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].total_liq + '</td>' ;
        html += '</tr>';
        
      });
                        
      html += '</table>';

      $('#tablaid').html(html);


    }
              
        } 


              
    }});
 

}else{
  alert("Debe definir fechas para consultar");
}

}

function imprimir_report(serv){

 form=document.getElementById('form');
        
        form.action='../Source/imprimir.php?oper=1&serv='+serv;
        form.submit();
        //event.preventDefault()


}

</script>


	
</head>
<body onload="">

  
<form id="form" name="form" method="post" action="" class="register">  

 <h1>Consultas Generales</h1>
 
 <fieldset class="row1">
 <legend> Criterios de Busqueda </legend>
 
 <p>
 
                    <label> Telefono 
                    </label>
 <input value="" id="tel" name="tel"  required="" tabindex="1" type="text" onkeypress="" >

 <label>
  Nombre
 </label>

 <td><input type="text" id="nom" name="nom"  onkeypress="consultarServicio(event)" value="" /></td>
 </p>

 <p>
<label>
Parametro
</label>

 <select id="parametro"> 
    
    <option value="1"> Servicios Dia </option>
    <option value="2"> Liquidacion Dia </option>
    
    </select>


</p>

<p>
<label>
Fecha
</label>

<input  id="fechai" name="fechai" type="text" value="<?php echo date('Y-m-d'); ?>"  style=" width:100px;  background-position:center; background-repeat:no-repeat; color:#333333; text-align:center" onKeyUp="mascara(this,'/',true)"   />

       <input name="btfechaO" type="button" id="btfechaO" value="..." style="width:25px; text-align:center" onclick="displayCalendar(document.forms[0].fechai,'yyyy-mm-dd',this)"/>
             
     <input  id="fechaf" name="fechaf" type="text" value="<?php echo date('Y-m-d'); ?>" style=" width:100px;  background-position:center; background-repeat:no-repeat; color:#333333; text-align:center" onKeyUp="mascara(this,'/',true)"   />
      <input name="btfechaF" type="button" id="btfechaF" value="..." style="width:25px; text-align:center" onclick="displayCalendar(document.forms[0].fechaf,'yyyy-mm-dd',this)" />
    
<input type="button" value="Buscar" onClick="buscarFechas()" />

</p>

<p>
<label>
Mobil
</label>

<select id="num_mobilre" name="num_mobilre" class="select-style" onChange="buscarRepartidor()" >
  
</select></td>

<td><select id="repartidor" name="repartidor" class="select-style">
 
</select>

</p>

 
 </fieldset>
 
            <fieldset class="row4">
                <legend>Servicios Despachados</legend>
                <p>
<table width="100%" cellspacing="1" height="100%" border="0" align="center"  class="" id="tablaid" >
  <tr>

  
 
    <td width="20%" align="center">SERVICIO</td>
    <td width="20%" align="center">FECHA</td>
    <td width="20%" align="center">CLIENTE</td>
     <td width="20%" align="center">VALOR</td>
    <td width="20%" align="center">REPARTIDOR</td>
   
    <td width="20%" align="center">ESTADO</td>
    <td width="20%" align="center">IMPRIMIR</td>
  </tr>
  <tr>
    <td colspan="7"><div id="actualize" style="width: 900px; height: 80px; overflow-y: scroll;"> </div></td>
  </tr>
  <tr>

  
  </tr>
</table>
<br>

</p>
</fieldset>

</form>

<table>
<tr>

<td>

</td>

<td></td>

</tr>
 </table> 


</body>
</html>