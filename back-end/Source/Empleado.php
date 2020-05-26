<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../Model/Empleado.php';

error_reporting(0);

session_start();



if($_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "")  {

    $permisos = $_SESSION['admon_mod'];

    $datos_mod = json_decode($permisos,true);

    $usuario = $datos_mod["usuadoc"];

    $oper = $_GET["oper"];

// RECOJO LAS VARIABLES
    $tipodoc = $_GET['tipo'];
    $identificacion = $_GET['id'];
    $nomb = $_GET['nomb'];
    $ape = $_GET['apellido'];
    $dire = $_GET['dire'];
    $tel  = $_GET['tel'];
    $cel  = $_GET['cel'];
    $suc   = $_GET['suc'];

    $mobil = $_GET['mobil'];
    $tipo = $_GET['tipo'];

    $crud_empleado = new Empleado();


    switch ($oper) {

        case $oper == 1:

        if($tipodoc != 0 && $identificacion != 0  && $nomb !="" && $dire != "" && $tel != "")

        {



            $arrayName = array('n_ide' => $identificacion , 'empnom' => strtoupper($nomb), 'empapell' => strtoupper($ape), 'empdire' => $dire, 'emptel' => strtoupper($tel), 'empcel' => strtoupper($cel) , 'tipo_empleo' => $tipo, 'num_mob' => $mobil , 'estado' => 'A' , 'empsucursal' => $suc, 'empdispo' => 'D' );


            $res = $crud_empleado->regEmpleado('service.fun_reg_empleado',$arrayName);

            echo json_encode($res);

        }

        
        break;

        case $oper == 2:
            # code...

        $mobil = $_GET["mobil"];

        $res = $crud_empleado->listarAhorro($mobil);

        echo json_encode(array("success" => true, "root" => $res));

        break;


        case $oper == 3:

        $mobil = $_GET["mobil"];

        $res = $crud_empleado->listarAhorrosNorte($mobil);

        echo json_encode(array("success" => true, "root" => $res));



                # code...
        break;

        case $oper == 4:

        $id = $_GET["iden"];

        $res = $crud_empleado->getInfoEmpleadoCentro($id);
                #var_dump($res);
        echo json_encode(array("success" => true, "root" => $res));



                    # code...
        break;

                    // PENDIENTE RECOGER VARIABLES


        case $oper == 7:
                        # code...
        $nom = $_GET["nomb"]; 
        $ape = $_GET["ape"];
        $dir = $_GET["dire"];
        $tel = $_GET["tel"];
        $nmobil = $_GET["mob"];
        $est = $_GET["est"];
        $suc = $_GET["suc"];
        $id  = $_GET["id"];
        $cel = $_GET["cel"];

$datos = array("id" => intval($id),"nomb" => $nomb, "apell" => $ape, "dire" => $dir, "tele" => $tel, "cele" => $cel ,"mobil"=> $nmobil, "estado_in" => $est, "sucursal" => $suc);

        $res = $crud_empleado->actualizarDatoEmpleado('service.actinfoempleado',$datos);

        echo json_encode($res);

        break;


        case $oper == 8:

        $mob = $_GET["mob"];
        $tpago = $_GET["tpago"];

        echo json_encode(array("success" => true, "data" => $crud_empleado->buscarDespachoMobil($mob,$tpago)));

                            # code...
        break;

        case $oper == 9:
                                # code...

        echo json_encode(array("success" => true, "root" => $crud_empleado->listarEmpleadoOficina()));

        break;


        case $oper == 10:
                                    # code...
        $suc = $_GET["suc"];
        echo json_encode($crud_empleado->listoMovilBySucursal($suc));


        break;

        case $oper == 11:
            # code...

        $emp = $_GET['id_emp'];

           echo json_encode($crud_empleado->traerInfoEmpleadoById($emp));   

            break;



        default:
        # code...
        break;
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

