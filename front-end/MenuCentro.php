<?php 

require ("../ConexionBD/Conexion.php");

session_start(); 

if($_SESSION['cod_usu'] != 0 || $_SESSION['cod_usu'] != "" )  {

      $usuario = $_SESSION['cod_usu'];
 
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
       
            <td style="font: Verdana, Geneva, sans-serif; text-align: start; text-align:"> <img id="imagen" class="avatar" src="<?php echo '../images/usuarios/' . $usuario . ".jpg" ?>"   />  </td>
            
            <td>
           
             <td>
             <?php echo date('Y-m-d : H:m:s'); ?>
            </td>
            
        </tr> 
        
               
    </table>
    
    <div id="cssmenu" >
<ul id="">
            <li><a href="#" onClick="llamarPhp('Despacho_Norte.php')">Desp. Norte</a></li>
            <li><a href="#" onClick="llamarPhp('Consultas.php')">Consultas</a> </li>      
            <li><a href="#" onClick="llamarPhp('Servicio_Despacho.php')" >Gen. Despacho</a></li>
            <li><a href="#" onClick="llamarPhp('Lista_Servicios.php')" > Servicios</a></li>
            <li><a href="#" onClick="llamarPhp('Liquidacion_Diaria.php')" >Liquidar Mensajero</a></li>  
            <li><a href="#" onClick="llamarPhp('programar_servicio.php')" >Programar</a></li>   
            <li><a href="#" onClick="llamarPhp('Cliente.php')" >Reg. Cliente</a></li>
            <li><a href="#" onClick="llamarPhp('Empleado.php')">Reg. Empleado</a></li>
            <li><a href="#" onClick="llamarPhp('Caja_Menor.php')">Caja</a></li>
            <li><a href="#" onClick="llamarPhp('Ahorro.php')">Ahorro</a></li>
            <li><a href="#" onClick="llamarPhp('Lista_CajaMenor.php')">Trazabilidad Caja</a></li>
                
   <!-- <li><a href="../index.php?user=<?php echo $_SESSION['usuario']; ?> " >Salir</a></li>
   
   -->
</ul>
</div>



<iframe frameborder="0" scrolling="no" width="100%" height="150%" name="servicio"></iframe>   
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