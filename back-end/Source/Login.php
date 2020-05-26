<?php

error_reporting(0);
session_start(); 

require '../ConexionBD/Conexion.php';


$usuario    = $_GET['un'];
$contrasena = $_GET['pw'];

$conn = new Conexion();

$conn->conectar();

$arrayName = array('usuanom' => $usuario , 'contrasenna' => $contrasena );

$result    = $conn->executePL('autentication.validar_login' , $arrayName);



    if($result != null){
        
        $_SESSION["admon_mod"] = $result;
    
    echo json_encode(array("success"=> true , "data" =>$result));

}
    else {
    echo json_encode(array("success"=> false , "data" =>"Usuario/Contrasena invalido"));
}
    //echo $result;

    curl_close($curl);

    pg_close($conn);

?>
