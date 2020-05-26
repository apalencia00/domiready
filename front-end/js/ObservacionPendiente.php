<!DOCTYPE html>
<html>
<head>
	<title>Observacion</title>
</head>

<script type="text/javascript">
	
function aceptar(){

        var vserv = document.getElementById("idser").value;
        var usu   = document.getElementById("user").value;
        var value = document.getElementById("obs").value;


	 $.ajax({ 
         url: "../back-end/Source/Servicio_Despacho.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: {"oper": 16, "serv" : vserv,  "usu" : vusu, "obs" : value, "estado" : 3 }, 
          
        });
}

</script>

<body>


<form class="">
	
<input type="hidden" id="idser" readonly="" name="idser" value="<?php echo $_GET['serv'] ?>" >


<input type="hidden" id="user" readonly="" name="user" value="<?php echo $_GET['user'] ?>" >

<textarea id="obs" rows="10" cols="50"></textarea>

<input type="button" name="save" onclick="aceptar()" >

</form>



</body>
</html>