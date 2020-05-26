<!DOCTYPE html>
<html>
<head>
	<title>Observacion</title>

 <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js" ></script>

</head>

<script type="text/javascript">
	
function aceptar(){

        var vserv = document.getElementById("idser").value;
        var vusu  = document.getElementById("user").value;
        var value = document.getElementById("obs").value;
        var fecha = document.getElementById("fecha").value;


	 $.ajax({ 
         url: "../back-end/Source/Servicio_Despacho.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: {"oper": 16, "serv" : vserv, "fecha" : fecha, "usu" : vusu, "obs" : value, "estado" : 3 }, 

         success : function(json){

                if(json[0].mensaje){

                 document.getElementById("mensaje").innerHTML= "Orden Guardada como Pendente";

                 window.opener.location.reload(false);
                   //window.close();
                }

         }
          
        });
}

</script>

<body>


<form class="">
	
<input type="hidden" id="idser" readonly="" name="idser" value="<?php echo $_GET['serv'] ?>" >


<input type="hidden" id="user" readonly="" name="user" value="<?php echo $_GET['user'] ?>" >

<input type="hidden" id="fecha" readonly="" name="fecha" value="<?php echo date('Y-m-d') ?>" >

<textarea style="background:#CCC;text-transform: uppercase" id="obs" rows="10" cols="50"></textarea>

<div id="mensaje" ></div>


<input type="button" name="save" onclick="aceptar()" value="Aceptar" >

</form>



</body>
</html>