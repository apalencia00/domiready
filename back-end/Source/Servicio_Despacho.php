<?php


require '../Model/Servicio_Despacho.php';

require '../../vendor/autoload.php';

error_reporting(0);

session_start();

if($_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "")  {



  $permisos = $_SESSION['admon_mod'];
  $usuario = intval($permisos[0]["id_usuario"]);



  $oper = $_GET['oper'];

// DATOS SERVICIO
  $tipo_serv = $_GET['tipo_serv'];
  $orden_serv = $_GET['idserv'];
  $id = $_GET['ide'];
  $fecha_servi = $_GET['fecha'];
  $tip_pago = $_GET['tipo_pago'];
  $valor = $_GET['valor'];
  $comision = $_GET['comision'];
  $serv = $_GET['observacion'];



// DATOS DESPACHO

  $tel= $_GET['tel'];



  $regresar = $_GET['regresar'];
  $repartidor = $_GET['repartidor'];
  $nomb = $_GET['nomb'];



  $dir_proc = strtoupper($_GET['dirini']);
  $dir_dest = strtoupper($_GET['dirdest']);

  $dir1 = strtoupper($_GET['dir1']);
  $dir2 = strtoupper($_GET['dir2']);
  $dir3 = strtoupper($_GET['dir3']);
  $dir4 = strtoupper($_GET['dir4']);
  $dir5 = strtoupper($_GET['dir5']);
  $dir6 = strtoupper($_GET['dir6']);
  $dir7 = strtoupper($_GET['dir7']);

  $distancia = $_GET['distance'];
  $tiempo = $_GET['time'];

// REGISTRA SERVICIO

  try{

   $crud_servicio_desp = new Servicio_Despacho();
   
   switch ($oper) {

    case $oper == 1:
        # code...

    
    
    // REGISTRO SERVICIO
    
    $_serv = array(
      "tipo_servicio" => $tipo_serv, 
      "num_servicio" => $orden_serv, 
      "n_ide" =>$id, 
      "fecha_serv" => $fecha_servi, 
      "fecha_ent" => $fecha_servi, 
      "t_pago" => $tip_pago, 
      "total" => $valor, 
      "p_comi" => $comision, 
      "obs" => 'ORDEN DE SERVICIO CREADA CON EL NUMERO' . $orden_serv,
      "estado_serv" => $_GET['operacionserv'], 
      "usuario" => ''.$usuario , 
      "n_des" => 'DES' . $orden_serv  , 
      "fk_empleado" =>$repartidor, 
      "fecha_sys" => $fecha_servi, 
      "fecha_desp" => $fecha_servi, 
      "estado_desp" => '1', 
      "local_cn" => 'C', 
      "dir_proc" => $dir_proc, 
      "dir_dest" => $dir_dest, 
      "dir_rta1" => $dir1 ,
      "dir_rta2" => $dir2,
      "dir_rta3" => $dir3,
      "dir_rta4" => $dir4,
      "dir_rta5" => $dir5,
      "dir_rta6"  => $dir6,
      "dir_rta7" => $dir7,
      "distancia" => $distancia,
      "tiempo" => $tiempo,
      "obsd" => $serv,
      "comp_dire" => $_GET['comp_dire'],
      "comp_diredest" => $_GET['comp_diredest'],
      "regresar" => $_GET['regresar']
      );

    #var_dump($_serv);
    $res = $crud_servicio_desp->registrarServicio('service.fun_reg_servicio',$_serv);

//   var_dump($res);

      $options = array(
        'cluster' => 'us2',
        'useTLS' => true
      );
      $pusher = new Pusher\Pusher(
        'ee3dc23c8d4d2bb6cbd6',
        '9567a4eeba9f925a0700',
        '993913',
        $options
      );

      $data['message'] = 'Un servicio ha sido generado y asignado a usted';
      $pusher->trigger('service'.$repartidor, 'event-service', $data);
    
    echo json_encode(array(
      
      "success" => $res[0]["success"],
      "mensaje" => $res[0]["mensaje"],
      "code" => $res[0]["code"]

      )
    );

    break;


    case $oper == 5:

    $ide = $_GET['ide'];
    $tel = $_GET['telefono'];
    $comp = $_GET['comp'];

    echo json_encode(array("success" =>true,
      "data" =>$crud_servicio_desp->clienteServicio($ide, $tel, $comp)
      ) 
    ); 


    break;

    case $oper == 6:

    $numero = $_GET['num'];

    echo json_encode(array("success" =>true,
      "data" =>$crud_servicio_desp->getOS($numero)
      ) 
    ); 

    break;

    case $oper == 7:

    $estado_serv = $_GET['operacion'];

    $num = $_GET['num'];
    $valor = $_GET['valor'];
    $tpago = $_GET['tpago'];
    $ide = $_GET['ide'];
    $fecha_servi = $_GET['fecha'];
    $nomb = $_GET['nomb'];
    $tele = $_GET['tele'];
    $cel = $_GET['cel'];
    $num_mob = $_GET['num_mobilre'];
    
    $diro = strtoupper($_GET['diro']);
    $dird = strtoupper($_GET['dird']);
    
    $dirdesv1 = strtoupper($_GET['dirdesv1']);
    $dirdesv2 = strtoupper($_GET['dirdesv2']);
    $dirdesv3 = strtoupper($_GET['dirdesv3']);
    $dirdesv4 = strtoupper($_GET['dirdesv4']);
    $dirdesv5 = strtoupper($_GET['dirdesv5']);
    $dirdesv6 = strtoupper($_GET['dirdesv6']);
    $dirdesv7 = strtoupper($_GET['dirdesv7']);

    $idavuelta = $_GET["idavuelta"];
    
    
    $obs = $_GET['obs'];
    
    $t_pago = 0;
    $local_cn = '';  
    
    
    $estado_desp= 0 ; 

    $datos = array(   
      
                      "num_serv"      => $num, 
                      "valor"         =>$valor , 
                      "tipo_pago"     => $tpago ,
                      "ide"           => $ide, 
                      "ndes"          => 'DES'.$num , 
                      "nomb"          => $nomb, 
                      "telein"        => $tele, 
                      "cel"           => $cel, 
                      "num_mobil"     => $num_mob, 
                      "estado_serv"   => $estado_serv, 
                      "diro"          => $diro,
                      "dird"          => $dird, 
                      "dirdesv1"      => $dirdesv1, 
                      "dirdesv2"      => $dirdesv2, 
                      "dirdesv3"      => $dirdesv3, 
                      "dirdesv4"      => $dirdesv4, 
                      "dirdesv5"      => $dirdesv5, 
                      "dirdesv6"      => $dirdesv6, 
                      "dirdesv7"      => $dirdesv7, 
                      "obs"           => $obs, 
                      "usuario"       => $usuario, 
                      "comp_dire"     => strtoupper($_GET['comp_dir']), 
                      "comp_diredest" => strtoupper($_GET['comp_diredest']), 
                      "idavuelta"     => $idavuelta 
                    
                    );

#var_dump($datos);

    echo json_encode($crud_servicio_desp->actOS('service.fun_act_servicio',$datos)); 

    break;


    case $oper == 10:

    $idserr = $_GET['idserr'];

    echo json_encode(array("success" =>true,
      "data" =>$crud_servicio_desp->buscarOS($idserr)
      ) 
    ); 

    break;

    case $oper == 11:
    
    $fechai = $_GET['fechai'];
    $fechaf = $_GET['fechaf'];
    $movil  = $_GET['movil'];
    $telefono = $_GET['telefono'];
    $nomb   = $_GET['nomb'];
    $tpago  = $_GET['tpago']; 

    $newDatei = date("Y-m-d", strtotime($fechai));
    $newDatef = date("Y-m-d", strtotime($fechaf));

    
    $param  = $_GET['param'];

    if($param == 1){

     echo json_encode(array("success" =>true,
      "param" => 1,
      "data" =>$crud_servicio_desp->buscarByFecha($newDatei , $newDatef, $movil,$telefono,$nomb,$tpago)
      ) 
     ); 

   }
   else{ 
    echo json_encode(array("success" =>true,
      "param" => 2,
      "data" =>$crud_servicio_desp->buscarLiquidados($fechai ,$fechaf, $movil)
      ) 
    );   }


    


    
    break;

    case $oper == 13:

    $valor = $_GET['valor'];
    $tele = $_GET['tele'];

    echo json_encode(array("success" =>true,
      "data" =>$crud_servicio_desp->localizar_cliente_historial($valor,$tele)
      ) 
    ); 


    break;

    case $oper == 14:

    $servicio = $_GET['servicio'];

    echo json_encode(array("success" =>true,
      "data" =>$crud_servicio_desp->localizar_cliente_historial_byID_servicio($servicio)
      ) 
    ); 

    break;


    case $oper == 15:

             // REGISTRO SERVICIO
    
    $_serv = array(
      "tipo_servicio" => $tipo_serv, 
      "num_servicio" => $orden_serv, 
      "n_ide" =>$id, 
      "fecha_serv" => $fecha_servi, 
      "fecha_ent" => $fecha_servi, 
      "t_pago" => $tip_pago, 
      "total" => $valor, 
      "p_comi" => $comision, 
      "obs" => 'ORDEN DE SERVICIO CREADA CON EL NUMERO' . $orden_serv,
      "estado_serv" => '5', 
      "usuario" => ''.$usuario , 
      "n_des" => 'DES' . $orden_serv  , 
      "fk_empleado" =>$repartidor, 
      "fecha_sys" => $fecha_servi, 
      "fecha_desp" => $fecha_servi, 
      "estado_desp" => '1', 
      "local_cn" => 'C', 
      "dir_proc" => $dir_proc, 
      "dir_dest" => $dir_dest, 
      "dir_rta1" => $dir1 ,
      "dir_rta2" => $dir2,
      "dir_rta3" => $dir3,
      "dir_rta4" => $dir4,
      "dir_rta5" => $dir5,
      "dir_rta6"  => $dir6,
      "dir_rta7" => $dir7,
      "distancia" => $distancia,
      "tiempo" => $tiempo,
      "obsd" => $serv,
      "comp_dire" => strtoupper($_GET['comp_dire']),
      "comp_diredest" => strtoupper($_GET['comp_diredest']),
      "regresar" => $_GET['regresar']
      );


    $res = $crud_servicio_desp->registrarServicio('service.fun_reg_servicio',$_serv);

    
    echo json_encode(array(
      
      "success" => $res[0]["success"],
      "mensaje" => $res[0]["mensaje"],
      "code" => $res[0]["code"]

      )
    );



    break;

    case $oper == 16:
    
    $serv  = $_GET["serv"];
    $fecha = $_GET["fecha"];
    
    $_usu  = $_GET["usu"];
    $obs   = $_GET["obs"];
    $estado = $_GET["estado"];

    $datos_rete = array("fk_id_serv" =>$serv ,"fk_estado_in" => intval($estado) ,"descripcion_in" => $obs , "usuario_in" => $_usu);

    $res = $crud_servicio_desp->registrarServicio('service.fun_reg_retencion',$datos_rete);


    echo json_encode($res);

    break;

    case $oper == 17:

    $_serv_rete = array(
      "tipo_servicio" => $tipo_serv, 
      "num_servicio" => $orden_serv, 
      "n_ide" =>$id, 
      "fecha_serv" => $fecha_servi, 
      "fecha_ent" => $fecha_servi, 
      "t_pago" => $tip_pago, 
      "total" => $valor, 
      "p_comi" => $comision, 
      "obs" => 'ORDEN DE SERVICIO CREADA CON EL NUMERO' . $orden_serv,
      "estado_serv" => 3, 
      "usuario" => $usuario , 
      "n_des" => 'DES' . $orden_serv, 
      "fk_empleado" =>0, 
      "fecha_sys" => $fecha_servi, 
      "fecha_desp" => $fecha_servi, 
      "estado_desp" => 3, 
      "local_cn" => 'C', 
      "dir_proc" => $dir_proc, 
      "dir_dest" => $dir_dest, 
      "dir_rta1" => $dir1 ,
      "dir_rta2" => $dir2,
      "dir_rta3" => $dir3,
      "dir_rta4" => $dir4,
      "dir_rta5" => $dir5,
      "dir_rta6"  => $dir6,
      "dir_rta7" => $dir7,
      "distancia" => $distancia,
      "tiempo" => $tiempo,
      "obsd" => $serv,
      "comp_dire" => strtoupper($_GET['comp_dire']),
      "comp_diredest" => strtoupper($_GET['comp_diredest']),
      "regresar" => $_GET["regresar"]
      );


    $res = $crud_servicio_desp->registrarServicio('service.fun_reg_servicio',$_serv_rete);

    echo json_encode($res);

    break;


    case $oper == 18:
    
    echo json_encode(array("root" =>$crud_servicio_desp->listarServiciosRetenidos()));



    break;

    case $oper == 19:
                 # code...

    $servicio = $_GET["servicio"];

    echo json_encode(array("root" =>$crud_servicio_desp->listarServiciosRetenidosDatos($servicio)));

    break;


    case $oper ==20:
    
    $telef = $_GET["telef"];

    echo json_encode(array("root" =>$crud_servicio_desp->getServicioPorTel($telef)));

    break;

    case $oper == 21:
                     # code...
    $nom = $_GET["nom"];
    echo json_encode(array("root" =>$crud_servicio_desp->getServicioPorNombre($nom)));
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

  header("Location=> ../View/404.php");

  unset($_SESSION['usu_cod']);
  
        // DESTROY COOKIE
  if (isset($_COOKIE['key'])) {
    unset($_COOKIE['key']);
    setcookie('key', '', time() - 3600, '/');

  }

}


