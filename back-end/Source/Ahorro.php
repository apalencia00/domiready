<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../Model/Ahorro.php';

session_start();

if($_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "")  {

$permisos = $_SESSION['admon_mod'];
$datos_mod = json_decode($permisos,true);

$oper = $_GET["oper"];

$usuario = $datos_mod["usuadoc"];
$crud_ahorro = new Ahorro();

// RECOJO LAS VARIABLES



// INGRESO _ EGRESO CAJA CENTRO

if($oper == 1){

$ide = $_GET["id"];
$val = $_GET["valor"];
$fecha = $_GET["fecha"];

$datos = array("id" => $ide, "fecha" => '', "valor" => $val, "usu" => $usuario);

echo json_encode($crud_ahorro->regAhorroCentro('service.reg_ahorro_centro',$datos));
     
}

// BASE - EGRESO CAJA CENTRO

if ($oper == 2){


    $ide = $_GET["id"];
$val = $_GET["valor"];
$fecha = $_GET["fecha"];

$datos = array("id" => $ide, "fecha" => '', "valor" => $val,  "usu" => $usuario);

echo json_encode($crud_ahorro->regAhorroNorte('service_norte.reg_ahorro_norte',$datos));



}


//MOVIMIENTO AHORRNO CENTRO

if($oper == 3){

	$fi = $_GET['fecha_ini']; 
	$ff = $_GET['fecha_fin'];

	$mov = $_GET['movil'];

	echo json_encode(array("success" => true, "root" => $crud_ahorro->buscarFechaAhorro($fi, $ff, $mov)));



}

//MOVIMIENTO AHORRNO NORTE

if($oper == 4){

$fi = $_GET["fecha_ini"]; 
	$ff = $_GET["fecha_fin"];

	$mov= $_GET["movil"];

	echo json_encode(array("success" => true, "root" => $crud_ahorro->buscarFechaAhorroNorte($fi, $ff, $mov)));


}


      
      

}else{

header("Location: 404.php");

 unset($_SESSION['admon_mod']);
        
        // DESTROY COOKIE
        if (isset($_COOKIE['key'])) {
    unset($_COOKIE['key']);
    setcookie('key', '', time() - 3600, '/');

}

}

