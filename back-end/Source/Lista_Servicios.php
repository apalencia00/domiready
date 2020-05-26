<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../Model/Servicio_Despacho.php';




if(isset($_GET['oper'])){
    
    if($_GET['oper'] != 0){
        
        $serv_des = new Servicio_Despacho();
    
        
        $i = $_GET['oper'];
        
        switch ($i) {
          
    case $i == 1: 
        
        
          echo json_encode(array(
                      "success" => true,
            "root" => $serv_des->serviciosAll())
          );
        
        break;

        case $i == 2:
          # code...}

        $movil = $_GET["movil"];

        echo json_encode(array("success" => true, "root" =>$serv_des->getServiciosByMovil($movil)));

          break;

          case $i == 3:

          $estado = $_GET['estado'];
            # code...

          echo json_encode(array("success" => true, "root" =>$serv_des->getServiciosEstado($estado)));
            break;
                
        
}
        
                
           
            
        
        
        
        
    }
    
}
