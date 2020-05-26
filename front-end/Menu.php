<?php 

require ("../ConexionBD/Conexion.php");

session_start(); 

if( $_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "" || $_SESSION['admon_mod'] != null  )  {

      $usuario = $_SESSION['admon_mod'];
      $datos_mod = json_decode($usuario,true);

      

      $salir = '../index.php?user=';

     
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>:: YOUCODE</title>

<style>

    img.avatar {
    /* cambia estos dos valores para definir el tamaño de tu círculo */
    height: 35px;
    width: 35px;
    /* los siguientes valores son independientes del tamaño del círculo */
    background-repeat: no-repeat;
    background-position: 50%;
    border-radius: 50%;
    background-size: 100% auto;
}

</style>

<script type="text/javascript">
    function llamarPhp(page){

        if(page != ""){
            
            window.frames[0].location.href = page;
        }
    }
</script>

<link href="../css/style_menu.css" rel="stylesheet" type="text/css" />
</head>

<body>
    
    <table width="100%" height="25px" >
        <tr>
       
            <td style="font: Verdana, Geneva, sans-serif; text-align: start; "> <img id="imagen" class="avatar" src="<?php echo '../images/usuarios/' . $usuario . ".jpg" ?>"   />  </td>
            
            <td>
           
             <td>
             <?php echo date('Y-m-d : H:m:s'); ?>
            </td>
            
        </tr> 
        
               
    </table>
    
    <div id="cssmenu" >
<ul id="">

<li><a href="#" onClick="llamarPhp('Estadistico.php')">ESTADISTICAS</a></li>
           
           <?php

           foreach ($datos_mod as $key => $value) { ?>

          <li><a href="#" onClick="llamarPhp('<?php echo $value["nombre"] ?>')"><?php echo $value["descripcion"] ?></a></li>
          

          <?php }  ?>


          
          <li><a href="<?php echo $salir ?><?php echo $_SESSION['usuario']; ?> " >Salir</a></li>      
   
  
</ul>
</div>



<iframe frameborder="0" align="top" scrolling="no" width="100%" height="150%" target="_parent" name="servicio" id="servicio" ></iframe>   
</body>
</html>

<?php
}

else{

    header('Location: 404.php');
    
      unset($_SESSION['usu_cod']);
        
        // DESTROY COOKIE
        if (isset($_COOKIE['key'])) {
    unset($_COOKIE['key']);
    setcookie('key', '', time() - 3600, '/'); // empty value and old timestamp
        }
    
}
?>