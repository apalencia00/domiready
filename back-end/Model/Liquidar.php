<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/back-end/ConexionBD/Conexion.php');

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