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
        
        
          echo json_encode($serv_des->comision());
        
        break;
       
    case $i == 2: 
        
        echo json_encode($serv_des->tipoPago());
        
        break;
        
    case $i == 3: 
             
        echo json_encode($serv_des->tipoServicio());
        
        break;
        
    case $i == 4:
       
                           
        echo json_encode($serv_des->operacionServicio());
        
        break;
    
    case $i == 5:
        
        echo json_encode($serv_des->listMobil());
        
        break;
    
    case $i == 6:
        $mobil_identificacion = $_GET['mobil_ide'];
        echo json_encode($serv_des->listNombById($mobil_identificacion));
        
        break;

        case $i == 7:

        echo json_encode($serv_des->getServicioID());


        break;

        case $i == 19:
echo json_encode($serv_des->listMobilNorte());

        break;

        case $i == 20:

            echo json_encode($serv_des->listTipoPago());
        break;

          case $i == 21:

            echo json_encode($serv_des->listMobilNorteCaja());
        break;

        case $i == 22:
            # code...

        $mob = $_GET["mobil"];

        echo json_encode($serv_des->totalAhorroMobil($mob));
            break;

            case $i == 23:
                # code...
$mob = $_GET["mobil"];
             echo json_encode($serv_des->totalAhorroMobilNorte($mob));

                break;

                case $i == 24:

                $fechai = $_GET['fechai'];
                $fechaf = $_GET['fechaf'];

                $telefono = $_GET['telefono'];
                $nomb     = $_GET['nomb'];
                $tpago    = $_GET['tpago'];

                echo json_encode($serv_des->totalServicioDiario($fechai, $fechaf,$telefono,$nomb,$tpago));
                    # code...
                    break;

                    case $i == 25:

                    $fechai = $_GET['fechai'];
                    $fechaf = $_GET['fechaf'];

                    $mob = $_GET["mob"];

                echo json_encode($serv_des->totalServiciosoloMovil($mob,$fechai, $fechaf));
                    # code...
                    break;

                    case $i == 26:
        
        echo json_encode($serv_des->listAllMobil());
        
        break;

        case  $i == 27:
            # code...

        echo json_encode($serv_des->listEstados());

            break;

        
        case  $i == 28:
            # code...

        echo json_encode($serv_des->listSucursales());

            break;             
        
}
       
    }
    
}
