<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../Model/Cliente.php';

session_start();

if($_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "")  {

$permisos = $_SESSION['admon_mod'];
$datos_mod = json_decode($permisos,true);

$usuario = $datos_mod["usuadoc"];

// RECOJO LAS VARIABLES
$tipodoc = $_GET['tipo'];
$identificacion = $_GET['id'];
$nomb = $_GET['nomb'];
$ape = $_GET['apellido'];
$dire = $_GET['dire'];
$tel  = $_GET['tel'];
$cel  = $_GET['cel'];
$correo = $_GET["correo"];
$compdir = $_GET["compdir"];
//$suc   = $_GET['suc'];

if($tipodoc != 0 && $identificacion != 0  && $nomb !="" && $dire != "" && $tel != ""){

$crud_cliente = new Cliente();

$arrayName = array('n_ide' => $identificacion , 'clinom' => strtoupper($nomb), 'cliapell' => strtoupper($ape), 'tipo_ide' => $tipodoc, 'clidire' => strtoupper($dire), 
    'clitel' => $tel, 'clicel' => $cel, 'nomb_completo' => strtoupper($nomb) . ' ' . strtoupper($ape), 'clicorreo' => $correo, 'compdir' =>  strtoupper($compdir));

$res = $crud_cliente->regCliente('service.fun_reg_cliente',$arrayName);

echo json_encode($res);

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

