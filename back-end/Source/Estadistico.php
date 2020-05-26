<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

error_reporting(0);

require '../Model/Cliente.php';

include_once '../ConexionBD/Conexion.php';

session_start();

if($_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "")  {

$permisos = $_SESSION['admon_mod'];
$datos_mod = json_decode($permisos,true);

$usuario = $datos_mod["usuadoc"];

// RECOJO LAS VARIABLES
	
	$oper = $_GET["method"];

	switch ($oper) {

		case  1:
			# code...

		llamarGrafo();
			break;
		
		default:
			# code...
			break;
	}


	


	


}else{

header("Location: ../View/404.php");

 unset($_SESSION['cod_usu']);
        
        // DESTROY COOKIE
        if (isset($_COOKIE['key'])) {
    unset($_COOKIE['key']);
    setcookie('key', '', time() - 3600, '/');

}

}

function llamarGrafo(){

		$conn = new Conexion();

		$conn->conectar();

		$valores = array("n" => 0);

		$resultado = $conn->sql("service.\"ESTADISTICO\"","\"ANNO\",\"A\",\"B\"");


		echo json_encode($resultado);

}