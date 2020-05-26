<?php

session_start();

if($_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "")  {

$modulos = $_SESSION['admon_mod'];

?>

<html>
    
    <head>
       <link rel="stylesheet" type="text/css" href="css/stylodes.css" /> 
        <script type="text/javascript" src="js/jquery.js" ></script>

    </head>
    
    <script type="text/javascript">
    
    function historial_cliente(){
        
        
         var vara = document.getElementById('ide').value;
          $.ajax({ url: "../back-end/Source/Servicio_Despacho.php", 
             type: "GET",
         contentType: "application/json",
         dataType: 'json',
               
         data : { "oper" : 5 ,"ide" : vara},
         
           success: function(json){
           
           var res = json.success;                     
                  
           if(res){
            var json_string = JSON.stringify(json.data);
            var jsonObj = JSON.parse(json_string);
      var html = '<table border="0">';
                        html += '';
      $.each(jsonObj, function(key, value){
        
        console.log(jsonObj);
        html += '<tr> <td width="15%" ondblclick="cargarAntiguo('+jsonObj[key].id_servicio+')" >' + jsonObj[key].num_servicio + '</td>' + '<td width="15%">' +  jsonObj[key].fecha_serv + '</td>' + '<td width="15%">' +  jsonObj[key].n_ide + '</td>' + '<td width="10%">' +  "ANDRES F" + '</td>'  + '<td width="15%">' +  jsonObj[key].total + '</td>' + '<td width="10%">' +  jsonObj[key].estado_serv + '</td>' ;
        html += '</tr>';
        
      });
                        
      html += '</table>';

      $('div').html(html);
          
         }    
    }

  });
         }
    
    
    
    function cargaHistoria(val){
    
    window.parent.document.getElementById("ide").value = val;
    
    }
    
    
    </script>

    <script type="text/javascript">
      
 $(document).ready(function(){
     historial_cliente();    
     
    });
     
  
</script>
   
    
    <body >

        <form class="register">

            <table width="100%" height="70%" border="0" style="display:inline-block;">
              <tr>
                <td height="40" colspan="7">
                 <h1>Servicios Express</h1>
                </td>
              </tr>
              <tr>
                  <td> <input type="text" id="ide" name="ide" value ="<?php echo $_GET['id'] ?>" /> </td>
                <td width="12%" height="57"> <button class="button_limpiar" onClick="">Actualizar</button>
               
              </td>
                <td width="12%"></td>
                <td width="12%"></td>
                <td width="12%"></td>
                <td width="12%"></td>
                <td width="12%"></td>
                <td width="12%"></td>
              </tr>
              <tr>
                <td height="226" colspan="7">
                   <fieldset class="row1">
                  <legend>Servicios - Despachos </legend>
                  <table width="100%" height="100%" border="0" align="center" cellspacing="1" class="" id ="tablaservi">
                    <tr>
                      <td width="200px" align="center">SERVICIO</td>
                      <td width="200px" align="center">FECHA</td>
                      <td width="200px" align="center">DIRECCION ORIGEN</td>
                      <td width="200px" align="center">DIRECCION DESTINO</td>
                      <td width="200px" align="center">NOMBRE</td>
                      <td width="200px" align="center">VALOR</td>
                   
                    </tr>
                    <tr>
                      <td  colspan="6"><div id="historico" style="width: 700px; height: 100px; overflow-y: scroll;" > </div></td>
                    </tr>
                  </table>
                </fieldset>
                </td>
              </tr>
  </table>
          
            
            
            
</form>
</body>
</html>

<?php
}else{
     header('Location: 404.php');
    
      unset($_SESSION['usu_cod']);
        
        // DESTROY COOKIE
        if (isset($_COOKIE['key'])) {
    unset($_COOKIE['key']);
    setcookie('key', '', time() - 3600, '/'); // empty value and old timestamp
        }
}

?>
