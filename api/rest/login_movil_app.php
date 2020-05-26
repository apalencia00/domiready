<?php

error_reporting(0);
session_start(); 

require '../../back-end/ConexionBD/Conexion.php';


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$final = explode( '/', $uri );

$usuario = $_GET['usuario'];
$contrasena   = $_GET['passw'];



$conn = new Conexion();

$conn->conectar();

$arrayName = array('usuanom' => $usuario , 'contrasenna' => $contrasena );

$result    = $conn->executePL('autentication.validar_login' , $arrayName);



    if($result != null){
        $_SESSION["admon_mod"] = $result;
        // set response code - 200 OK
        http_response_code(200);
    
        echo json_encode($result);

}
    else {
        http_response_code(404);
        echo json_encode(array("success"=> false , "data" =>"Usuario/Contrasena invalido"));
}
    //echo $result;


    pg_close($conn);

?>