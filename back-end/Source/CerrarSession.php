<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

error_reporting(0);

session_start();

if($_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "")  {

$permisos = $_SESSION['admon_mod'];
$datos_mod = json_decode($permisos,true);

$usuario = $datos_mod["usuadoc"];



     echo json_encode(array("success" => true, "mensaje" => "" ));


     unset($permisos);
     session_unset();
     session_destroy();


}else{

header("Location: 404.php");

 unset($_SESSION['admon_mod']);
        
        // DESTROY COOKIE
        if (isset($_COOKIE['key'])) {
    unset($_COOKIE['key']);
    setcookie('key', '', time() - 3600, '/');

}

}

