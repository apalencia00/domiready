<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../Model/Liquidar.php';




if(isset($_GET['oper'])){
    
    if($_GET['oper'] != 0){
        
        $liquidar = new Liquidar();
    
        
        $i = $_GET['oper'];
        
        switch ($i) {

          case $i == 1: 
        
        $empleado_id = $_GET['fk_empleado'];
        $total = $_GET['total'];
        $cantidad = $_GET['cantidad'];
        $usuario = $_GET['usuario'];
        $fliquidacion = $_GET['fliquidar'];
        $parqueo      = $_GET['parqueo'];
        $valorealmov  = $_GET['valor'];
        $porcentaje   = $_GET['porce'];

        $datos = array("fk_empleado" => $empleado_id, 
                       "fecha_liq" => $fliquidacion, 
                       "fecha_sys" => date('Y-m-d h:m:s'), 
                        "cantidad_serv" => $cantidad, 
                        "total_liq" => $total, 
                         "estado" => 'S', 
                         "usuario" => $usuario,
                          "valparqueo" => '',
                         "varealmovil" => '',
                         "parqueo" => '',
                        "comision_empin" => '',
                      "ahorroin" => '' );
        
          echo json_encode(array(
                      "success" => true,
            "root" => $liquidar->liquidar($datos))
          );
        
          break;


          case $i == 2:

          $empleado_id = $_GET['fk_empleado'];
        $total = $_GET['total'];
        $cantidad = $_GET['cantidad'];
        $usuario = $_GET['usuario'];
        $fliquidacion = $_GET['fliquidar'];

        $datos = array("fk_empleado" => $empleado_id, 
                       "fecha_liq" => $fliquidacion, 
                       "fecha_sys" => date('Y-m-d h:m:s'), 
                        "cantidad_serv" => $cantidad, 
                        "total_liq" => $total, 
                         "estado" => 'S', 
                         "usuario" => $usuario );
        
          echo json_encode(array(
                      "success" => true,
            "root" => $liquidar->liquidarNorte($datos))
          );


          break;
                
        
}
        
                
           
            
        
        
        
        
    }
    
}
