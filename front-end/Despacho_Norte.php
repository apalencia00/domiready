<!DOCTYPE html>
<html>
<head>
	<title>Menu Despacho</title>

<link rel="stylesheet" href="css/minified/jquery-ui.min.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js" ></script>


<script type="text/javascript" src="js/ajax.js"  ></script>


</head>

<script>setTimeout('document.location.reload()',50000); </script>

<script type="text/javascript">
    
    function loadpp()
    {

  $.ajax({ url: "../back-end/Source/Servicio_Despacho_Norte.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "oper" : 1 },
     
      success: function(json){ 
          
               
        var res = json.success;
        var respuesta = json.root;
       
        if(res){

          if(respuesta != null){

            var json_string = JSON.stringify(respuesta);
               console.log(respuesta);
                 
                playSound();
            var jsonObj = JSON.parse(json_string);
      var html = '<table class="table table-bordered" border="0">';
                        
      $.each(jsonObj, function(key, value){
       
         //
        html += '<tr> <td width="20%" ondblclick="windowModal('+jsonObj[key].num_servicio+')" align="center" >' + jsonObj[key].num_servicio + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].fecha_serv + '</td>'   +'<td width="20%" align="center">' +  jsonObj[key].nombre_completo + '</td>' +  '<td width="20%" align="center">' +  jsonObj[key].total + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].descripcion + '</td>' + '<td width="20%" align="center">' +  jsonObj[key].usuanom + '</td>' ;
        html += '</tr>';

      

    });

      
      html += '</table>';
         $('#actualize').html(html);     
        }

      }
    
    }

});
    }

    function windowModal(valor){


window.open("windowModal.php?id_orden="+valor, "_blank", "toolbar=yes, scrollbars=no, resizable=yes, top=500, left=500, width=1100, height=400");


    }
    
    function serviciosNorteDespachados()
    {
        
        $.ajax({ url: "../back-end/Source/Servicio_Despacho_Norte.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "oper" : 2  },
     
      success: function(json){ 
          
        var res = json.success;
        var respuesta = json.root;
        if(res){

              //  console.log(json);
                if(respuesta != null){
                    var json_string = JSON.stringify(respuesta);
            var jsonObj = JSON.parse(json_string);
      var html = '<table class="table table-bordered" border="0">';
                        html += '';
      $.each(jsonObj, function(key, value){
        
        //console.log(jsonObj[key]);
        html += '<tr> <td width="10%"  align="center" >' + jsonObj[key].num_servicio + '</td>' + '<td width="10%" align="center">' +  jsonObj[key].fecha_serv + '</td>'  +'<td width="10%" align="center">' +  jsonObj[key].fecha + '</td>' + '<td width="10%" align="center">' +  jsonObj[key].hora + '</td>'   +'<td width="10%" align="center">' +  jsonObj[key].nombre_completo + '</td>' + '<td width="10%" align="center">' +  jsonObj[key].total + '</td>' + '<td width="10%" align="center">' +  jsonObj[key].descripcion + '</td>' + '<td width="10%" align="center">' +  jsonObj[key].num_mob + '</td>' + '<td width="10%" align="center" onclick="imprimir_report('+jsonObj[key].num_servicio+')"  > <img src="images/pdf.png" alt="" border=3 height=30 width=30></img> </td>' ;
        html += '</tr>';
        
      });
                        
      html += '</table>';

      $('#norte').html(html);
              
        }

      }
    }

});
        
    }

</script>

<script>
 $(document).ready(function(){
 
     loadpp();
     serviciosNorteDespachados();
     
    });


 function imprimir_report(serv){

  $('.dialog').css('display','block');
 // $('#dialog').load('http://198.46.152.223:8080/JasperPrint/webresources/print/imprimir #dialog');
  $('#myframe').attr('src', 'http://198.46.152.223:8080/JasperPrint/webresources/print/imprimirServicio?serv='+serv);

  var dialog1 = $("#dialog").dialog({ 
   autoOpen: false,
   height: 600,
   width: 650,
   modal: true,

 });

  dialog1.dialog('open');


}

    
  
</script>

<script type="text/javascript">
  
   function playSound() {
  var sound=document.getElementById("audio1");
  sound.play();
}


</script>

<body onload="">

<form id="form" name="form" method="post" action="" class="">
<audio id="audio1" type="audio/mpeg" src="http://www.soundjay.com/button/beep-07.wav" autostart="false" ></audio>
            <h1>Despacho Norte</h1>
            
            <fieldset class="row1">
            
            <legend>
            Servicios Norte Despachados
            </legend>

 <div class="datagrid">
            
<table class="table table-bordered" id="tableID"  width="1000px" height="300px"border="0"  >
  <tr>
    <th width="10%" align="center" >SERVICIO</th>
    <th width="10%" align="center" >F.SERVICIO</th>
    <th width="10%" align="center">DESPACHO</th>
    <th width="10%" align="center">HORA</th>
    <th width="10%" align="center">NOMBRE COMPLETO </th>
    <th width="10%" align="center">VALOR</th>
    <th width="10%" align="center">ESTADO</th>
    <th width="10%" align="center">MOVIL</th>
    <th width="10%" align="center">IMPRIMIR</th>
  </tr>
  <tr>
    <td  colspan="9">
      <div id="norte" style="width: 100%; height: 300px; overflow-y: scroll;"  > </div></td>
  </tr>
  <tr>

      <!-- <td colspan="4" ><input type="button" id="acept" name="acept" value="Consultar" onClick="mostrarConsulta()" /></td> -->



  </tr>
</table> 

</div>
            
            
            </fieldset>
            
            
            <fieldset class="row4">
                <legend>Listado servicios
                </legend>
                <p>

           <div class="datagrid">
     
     <table class="table table-bordered" id="tableID" width="800px" height="200px" >
<thead>

<tr>
<th width="20%" >SERVICIO</th>
<th width="20%">FECHA</th>
<th width="20%">NOMBRE</th>
<th width="20%">VALOR</th>
<th width="20%">ESTADO</th>
<th width="20%">USUARIO</th>

</tr>

</thead>
<tfoot>
<tr>
<td colspan="6"></tr></tfoot>
<tbody>
<tr>
<td height="5" colspan="6"> 

<div id="actualize" style="width: 100%; height: 200px; overflow-y: scroll;" > </div> 

</td>

</tr>

</tbody>
</table></div>
    

                </p>

              </fieldset>

            </form>

<div id="dialog"  style="display:none" title="Impresion Norte">
<iframe id="myframe" src="" width="100%" height="100%">
  
</iframe>
</div>

</body>
</html>
