 <?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../back-end/Model/Cliente.php';

session_start();

if($_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "")  {

$permisos = $_SESSION['admon_mod'];
$datos_mod = json_decode($permisos,true);

$usuario = $datos_mod[0]["nusuadoc"];

// RECOJO LAS VARIABLES




try{

$name =  $_GET['term'];

$cliente = new Cliente();

$res = $cliente->getLastNameCliente($name);

echo $res['cliapell']."\n";


}catch (Exception $ex) {
      echo json_encode(array(
         "success" => false, 
                "data" => $ex->getMessage()
            )
        );
      
        unset($_SESSION['cod_usu']);
        
        // DESTROY COOKIE
        if (isset($_COOKIE['key'])) {
    unset($_COOKIE['key']);
    setcookie('key', '', time() - 3600, '/'); // empty value and old timestamp
}

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

