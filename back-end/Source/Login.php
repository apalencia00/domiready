<?php

error_reporting(0);
session_start(); 

$cadena = explode("/",$_SERVER["DOCUMENT_ROOT"]  );

var_dump($_SERVER["DOCUMENT_ROOT"]);
var_dump($cadena[2]); exit();

if ($cadena[2] == "domiready") {
    require_once($_SERVER["DOCUMENT_ROOT"] . '/back-end/ConexionBD/Conexion.php');
}
else{
    require_once($_SERVER["DOCUMENT_ROOT"].'/domiready' . '/back-end/ConexionBD/Conexion.php');
}


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


    pg_close($conn);

?>
