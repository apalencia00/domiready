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

$empleado = $_GET['documento'];


$conn = new Conexion();

$conn->conectar();

$result = $conn->query("SELECT count(1) as cantidad_despacho, d.num_servicio,   d.n_des,  
d.fecha_desp, c.clinom || '' || c.cliapell as clienom , d.obs, s.total::numeric,tp.descripcion as tpago, 
comi.porcentaje_com,s.t_pago, ed.descripcion,d.dir_proc,d.dir_dest
FROM service.\"DESPACHO\" d, service.\"SERVICIO\" s , service.\"CLIENTE\" c, service.\"PARAM_COM\" comi,service.\"TIPO_PAGO\" tp, service.\"ESTADO_DESPACHO\" ed
WHERE d.fk_empleado = $empleado  AND s.n_ide = c.n_ide AND s.num_servicio = d.num_servicio
AND s.p_comi = comi.id_com AND d.fecha_desp::date = '$fliquida'::date AND tp.id_tipopago = s.t_pago AND ed.id_estado_desp = d.estado_desp AND s.estado_serv not in(2,3) 
GROUP BY c.clinom, c.cliapell , d.n_des,  d.fecha_desp, d.obs, s.total,tp.descripcion,comi.porcentaje_com,s.t_pago, ed.descripcion,d.dir_proc,d.dir_dest

UNION

SELECT count(1) as cantidad_despacho, d.num_servicio,   d.n_des,  
d.fecha_desp, c.clinom || '' || c.cliapell as clienom , d.obs, s.total::numeric,tp.descripcion as tpago, 
comi.porcentaje_com,s.t_pago,ed.descripcion,d.dir_proc,d.dir_dest
FROM service_norte.\"DESPACHO\" d, service.\"SERVICIO\" s , service.\"CLIENTE\" c, service.\"PARAM_COM\" comi,service.\"TIPO_PAGO\" tp, service.\"ESTADO_DESPACHO\" ed
WHERE d.fk_empleado = $empleado  AND s.n_ide = c.n_ide AND s.num_servicio = d.num_servicio
AND s.p_comi = comi.id_com AND d.fecha_desp::date = '$fliquida'::date AND tp.id_tipopago = s.t_pago AND ed.id_estado_desp = d.estado_desp AND s.estado_serv not in(2,3) 
GROUP BY c.clinom, c.cliapell , d.n_des,  d.fecha_desp, d.obs, s.total,tp.descripcion,comi.porcentaje_com,s.t_pago, ed.descripcion,d.dir_proc,d.dir_dest ORDER BY 1 DESC");

    if($result != null){
            
        http_response_code(200);
        echo json_encode($result);

}
    else {
        http_response_code(404);
        echo json_encode(array("success"=> false , "data" =>"Datos no Encontrados"));
}
    //echo $result;


    pg_close($conn);

?>