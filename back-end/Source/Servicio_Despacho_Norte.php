<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../Model/Servicio_Despacho_Norte.php';

error_reporting(0);

session_start();

if($_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "")  {

$permisos = $_SESSION['admon_mod'];
$datos_mod = json_decode($permisos,true);

$usuario = $datos_mod["usuadoc"];

$oper = $_GET['oper'];


try{

   $crud_servicio_desp = new Servicio_Despacho_Norte();
    
    switch ($oper) {

      case $oper == 1:
        # code...

     echo json_encode(array(
                      "success" => true,
            "root" => $crud_servicio_desp->serviciosAll())
          );

        break;

        case $oper == 2 :

      

     echo json_encode(array(
            "success" =>true,
            "root" => $crud_servicio_desp->getOSDespachado()
            ) 
      ); 

        break;

        case $oper == 7:
        
        $numero = $_GET['num'];
        $mobil = $_GET['num_mobilre'];
        $obs = $_GET['obs'];
        $dirv1 = $_GET['dirv1'];
        $dirv2 = $_GET['dirv2'];
        $dirv3 = $_GET['dirv3'];
        $dirv4 = $_GET['dirv4'];
        $dirv5 = $_GET['dirv5'];
        $dirv6 = $_GET['dirv6'];
        $dirv7 = $_GET['dirv7'];
        $tel   = $_GET['tele'];
        $celular = $_GET['celular'];
        $dir_or  = $_GET['diro'];
        $dir_dest = $_GET['dird'];
        $comp_direo = $_GET['comp_dir'];
        $comp_dired = $_GET['comp_diredest'];

     $dato = array("numero_servicio" => $numero, "fk_empleado" => $mobil, "obs" => $obs,  "usuario" => (string)$usuario   ,"dirv1" => $dirv1, "dirv2" => $dirv2, "dirv3" => $dirv3, "dirv4" => $dirv4, "dirv5" => $dirv5, "dirv6" => $dirv6, "dirv7" => $dirv7, "tel" => $tel, "celular" => $celular, "dir_or" => $dir_or, "dir_dest" => $dir_dest, "comp_direo" => $comp_direo , "comp_dired" => $comp_dired );

              $data = $crud_servicio_desp->actDespacho('service_norte.fun_act_despacho',$dato );

      echo json_encode(array("success" => true, "data" => $data));


        break;

              case $oper == 9 :

      $os_numero = $_GET['num'];

     echo json_encode(array(
            "success" =>true,
            "root" => $crud_servicio_desp->getOs($os_numero)
            ) 
      ); 

        break;

 case $oper == 11:
 
        $fechai = $_GET['fechai'];
        $fechaf = $_GET['fechaf'];
        $param  = $_GET['param'];

        if($param == 1){

         echo json_encode(array("success" =>true,
          "param" => 1,
            "data" =>$crud_servicio_desp->buscarByFechaNorte($fechai , $fechaf)
            ) 
      ); 

       }
       else{ echo json_encode(array("success" =>true,
        "param" => 2,
            "data" =>$crud_servicio_desp->buscarLiquidadosNorte($fechai , $fechaf)
            ) 
      );   }


          
   
        break;




              
      default:
        # code...

      'Opcion incorrecta';
        break;
    }
    
    
    
} catch (Exception $ex) {
      echo json_encode(array(
         "success" => false, 
                "data" => $ex->getMessage()
            )
        );
      
        unset($_SESSION['usu_cod']);
        
        // DESTROY COOKIE
        if (isset($_COOKIE['key'])) {
    unset($_COOKIE['key']);
    setcookie('key', '', time() - 3600, '/'); // empty value and old timestamp
}

}

}else{

header("Location: ../View/404.php");

 unset($_SESSION['usu_cod']);
        
        // DESTROY COOKIE
        if (isset($_COOKIE['key'])) {
    unset($_COOKIE['key']);
    setcookie('key', '', time() - 3600, '/');

}

}


