<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style type="text/css">
  
  form input[type="select"]:required:valid{
     border:2px solid green;
  }

form input[type="text"]:required:valid{
 border:2px solid green;
 /* otras propiedades */
}
/*caso contrario, el color sera rojo*/
form input[type="text"]:focus:required:invalid{
 border:2px solid red;
 /* otras propiedades */
}

select.invalid ~ .select-dropdown {
 border:2px solid red;
 /* otras propiedades */
}



</style>

<link rel="stylesheet" type="text/css" href="../css/observacion.css" />

 <script src="../js/jquery-1.10.2.js"></script>
  <script src="../js/jquery-ui.js"></script>

<script> 

function obtenerDatos(){

    var num_ide = document.getElementById("num").value;

    $.ajax({ url: "../Source/Servicio_Despacho.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "oper" : 6, "num" : num_ide},
     
      success: function(json){ 
         
         document.getElementById("ide").value = json.data[0].n_ide;

       
         document.getElementById("nomb").value = json.data[0].clinom;

        document.getElementById("tele").value = json.data[0].clitel;

        document.getElementById("cel").value = json.data[0].clicel;

        
    
    }


});



}

 $(document).ready(function(){
      
obtenerDatos();

     
     
    });


</script>

</head>

<body>

<form id="form" name="form" method="post" action="" class="register" onSubmit="return false">

  <h1>Observacion Servicio   # <?php echo $_GET['idser'] ?></h1>
            
  <fieldset class="row1">
                <legend>Datos Cliente
            </legend>
                
            
                
                
<p>
  <label>SERVICIO</label>
      <input id="num" name="num" type="text" value="<?php echo $_GET['idser'] ?>" readonly  />
   
           <label>NOMBRE COMPLETO</label>
		<input width="500px" id="nomb" name="nomb" type="text"   /> 
        
        
                
    </p>
                
                
   <p>
   
      
     <label>TELEFONO</label>
		<input id="tele" name="tele" type="text"   />   

<label>CELULAR</label>
		<input id="cel" name="cel" type="text"   />
        
        
   
   </p>   
   
   <p>
   
   <textarea id="servicio" name="servicio" cols="100" rows="5" style="background:#999" onKeyUp="javascript:this.value=this.value.toUpperCase();" ></textarea>
   
   </p>
        
                
  </fieldset>
      <input type="submit" id="save" name="save" value="Aceptar" onClick="proceder()" class="button_registrar" />

</form>


</body>
</html>