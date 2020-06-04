<?php

$cadena = explode("/",$_SERVER["DOCUMENT_ROOT"]  );

if ($cadena[3] == "domiready") {
    require_once($_SERVER["DOCUMENT_ROOT"] . '/back-end/ConexionBD/Conexion.php');
}
else{
    require_once($_SERVER["DOCUMENT_ROOT"].'/domiready' . '/back-end/ConexionBD/Conexion.php');
}


class Liquidar {
    
    
    public function __construct() {
        
    }

    public function liquidar($datos){

    	$conn = new Conexion();

    	$conn->conectar();

     $result 	= $conn->executePL('service.fun_reg_liquidacion', $datos);

     return $result;

     pg_close($conn);
     
    }

    public function liquidarNorte($datos){

    	$conn = new Conexion();

    	$conn->conectar();

     $result 	= $conn->executePL('service_norte.fun_reg_liquidacion_norte', $datos);

     return $result;

     pg_close($conn);
     
    }


    
}