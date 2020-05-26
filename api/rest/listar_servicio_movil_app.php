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

$conn = new Conexion();

$conn->conectar();

$result = $conn->query("SELECT *, s.total::numeric as totalt FROM service.\"EMPLEADO\" e, service.\"DESPACHO\" d, service.\"SERVICIO\" s WHERE s.num_servicio = d.num_servicio and e.n_ide = '$usuario' AND d.fk_empleado = e.n_ide AND d.fecha_desp = now()::date ORDER BY s.id_servicio DESC");

    if($result != null){
            
        http_response_code(200);
        echo json_encode($result);

}
    else {
        http_response_code(404);
        echo json_encode(array("success"=> false , "data" =>"Error No Hay Datos a Mostrar"));
}
    //echo $result;


    pg_close($conn);

?>