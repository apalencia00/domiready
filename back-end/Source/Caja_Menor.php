<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../Model/Caja_Menor.php';

error_reporting(0);

session_start();

if($_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "")  {

$permisos = $_SESSION['admon_mod'];
$datos_mod = json_decode($permisos,true);

$usuario = $datos_mod["usuadoc"];
$crud_cajamenor = new Caja_Menor();

// RECOJO LAS VARIABLES

$oper = $_GET["oper"];
$tipo = $_GET['tipo'];
$descripcion = $_GET['motivo'];
$valor = $_GET['valor'];
$fecha = date('Y-m-d') ;
$cedula = $_GET['cedula'];
$saldo  = $_GET['saldo'];

// INGRESO _ EGRESO CAJA CENTRO

if($oper == 1){

      $arrayName = array('tipo' => $tipo , 'descripcion' => strtoupper($descripcion), 'valor' => $valor, 'fk_empleado' => $cedula  ,'saldo_caja_menor' => $saldo , 'usuario_creador' => $usuario );

echo json_encode(
    array(
        "data"=>$crud_cajamenor->regCajaMenor('service.fun_reg_cajamenor_auditoria',$arrayName)));
}

// BASE - EGRESO CAJA CENTRO

if ($oper == 2){

$arrayBase = array('tipo' => $tipo , 'descripcion' => strtoupper($descripcion), 'valor' => $valor, 'fk_empleado' => $cedula  ,'saldo_caja_menor' => $saldo , 'usuario_creador' => $usuario );

echo json_encode(
    array(
        "data"=>$crud_cajamenor->regCajaMenor('service.fun_reg_cajamenor_auditoria',$arrayBase)));


}

// INGRESO - EGRESO CAJA NORTE
if($oper == 3){


$arrayMov = array('tipo' => $tipo , 'descripcion' => strtoupper($descripcion), 'valor' => $valor, 'fk_empleado' => $cedula  ,'saldo_caja_menor' => $saldo , 'usuario_creador' => $usuario );

echo json_encode(
    array(
        "data"=>$crud_cajamenor->regCajaMenor('service_norte.fun_reg_cajamenor_auditoria',$arrayMov)));

 

}

// BASE CAJA NORTE
if($oper == 4){

	$arrayBaseNorte = array('tipo' => $tipo , 'descripcion' => strtoupper($descripcion), 'valor' => $valor, 'fk_empleado' => $cedula  ,'saldo_caja_menor' => $saldo , 'usuario_creador' => $usuario );

echo json_encode(
    array(
        "data"=>$crud_cajamenor->regCajaMenor('service_norte.fun_reg_cajamenor_auditoria',$arrayBaseNorte)));

 


}





if($oper == 5){

    $tipo = $_GET['tipo'];
$descripcion = $_GET['motivo'];
$valor = $_GET['valor'];
$fecha = date('Y-m-d') ;
$cedula = $_GET['cedula'];
$saldo  = $_GET['saldo'];


$arrayName2 = array('tipo' => $tipo , 'descripcion' => strtoupper($descripcion), 'valor' => $valor, 'fk_empleado' => $cedula,'saldo_caja_menor' => $saldo , 'usuario_creador' => $usuario );


echo json_encode(
array("data"=>$crud_cajamenor->regCajaMenorNorte('service_norte.fun_reg_cajamenor_auditoria',$arrayName2)));

}

if($oper == 6){

    $fecha_ini = $_GET["fecha_ini"];
    $fecha_fin = $_GET["fecha_fin"];
    $param     = $_GET["param"];


   $res =  $crud_cajamenor->listarCajaMenorCentro($fecha_ini, $fecha_fin, $param);

    echo json_encode(array("success" => true, "root" => $res));

}


if($oper == 7){

    $fecha_ini = $_GET["fecha_ini"];
    $fecha_fin = $_GET["fecha_fin"];
    $param     = $_GET["param"];


   $res =  $crud_cajamenor->listarCajaMenorNorte($fecha_ini, $fecha_fin,$param);

    echo json_encode(array("success" => true, "root" => $res));

}
      
      

}else{

header("Location: ../View/404.php");

 unset($_SESSION['admon_mod']);
        
        // DESTROY COOKIE
        if (isset($_COOKIE['key'])) {
    unset($_COOKIE['key']);
    setcookie('key', '', time() - 3600, '/');

}

}

