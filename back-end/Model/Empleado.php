<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../ConexionBD/Conexion.php';

class Empleado {


  public function __construct() {

  }

  public function getTipoID(){

   $conn = new Conexion();

   $conn->conectar();

   $result 	= $conn->sql('service."TIPO_DOC"' , '*');

   return $result;

   pg_close($conn);


 }

 public function regEmpleado($pl,$data){

  $conn = new Conexion();

  $conn->conectar();

  $res = $conn->executePL($pl, $data);



  return $res;

  pg_close($conn);


}

public function eliminarCliente(){


}

public function getTipoEmpleo(){

  $conn = new Conexion();

  $conn->conectar();

  $result    = $conn->executeSql('service."TIPO_EMPLEO"' , 'estado' , 'A', '*');

  return $result;

  pg_close($conn);

}

public function cargarMobilDisponible(){

 $conn = new Conexion();

 $conn->conectar();

 $result    = $conn->executeSql('service."EMPLEADO"' , 'estado' , 'A', 'num_mob');

 return $result;

 pg_close($conn);



}


public function cargarDatosEmpDespacho($empleado,$fliquida){

  $conn = new Conexion();

  $conn->conectar();

  $fecha_actual = $fliquida;



  $result = $conn->query("SELECT count(1) as cantidad_despacho, d.num_servicio,   d.n_des,  
    d.fecha_desp, c.clinom || '' || c.cliapell as clienom , d.obs, s.total::numeric,tp.descripcion as tpago, 
    comi.porcentaje_com,s.t_pago, ed.descripcion,d.dir_proc,d.dir_dest
    FROM service.\"DESPACHO\" d, service.\"SERVICIO\" s , service.\"CLIENTE\" c, service.\"PARAM_COM\" comi,service.\"TIPO_PAGO\" tp, service.\"ESTADO_DESPACHO\" ed
    WHERE d.fk_empleado = $empleado  AND s.n_ide = c.n_ide AND s.num_servicio = d.num_servicio
    AND s.p_comi = comi.id_com AND d.fecha_desp::date = '$fliquida'::date AND tp.id_tipopago = s.t_pago AND ed.id_estado_desp = d.estado_desp AND s.estado_serv not in(2,3) 
    GROUP BY c.clinom, c.cliapell , d.n_des,  d.fecha_desp, d.obs, s.total,tp.descripcion,comi.porcentaje_com,s.t_pago, ed.descripcion,d.dir_proc,d.dir_dest

    UNION

    SELECT count(1) as cantidad_despacho, d.num_servicio,   d.n_des,  
    d.fecha_desp, c.clinom || '' || c.cliapell as clienom , d.obs, s.total::numeric,tp.descripcion as tpago, 
    comi.porcentaje_com,s.t_pago,ed.descripcion,d.dir_proc,d.dir_dest
    FROM service_norte.\"DESPACHO\" d, service.\"SERVICIO\" s , service.\"CLIENTE\" c, service.\"PARAM_COM\" comi,service.\"TIPO_PAGO\" tp, service.\"ESTADO_DESPACHO\" ed
    WHERE d.fk_empleado = $empleado  AND s.n_ide = c.n_ide AND s.num_servicio = d.num_servicio
    AND s.p_comi = comi.id_com AND d.fecha_desp::date = '$fliquida'::date AND tp.id_tipopago = s.t_pago AND ed.id_estado_desp = d.estado_desp AND s.estado_serv not in(2,3) 
    GROUP BY c.clinom, c.cliapell , d.n_des,  d.fecha_desp, d.obs, s.total,tp.descripcion,comi.porcentaje_com,s.t_pago, ed.descripcion,d.dir_proc,d.dir_dest ORDER BY 1 DESC


    ");

  return $result;

  pg_close($conn);


}

public function cargarDatosEmpDespachoNorte($empleado,$fliquida){

  $conn = new Conexion();

  $conn->conectar();

  $fecha_actual = date('Y-m-d');

  $result = $conn->query("SELECT count(1) as cantidad_despacho, d.num_servicio,   d.n_des,  
    d.fecha_desp, c.clinom || '' || c.cliapell as clienom , d.obs, s.total::numeric,tp.descripcion as tpago, 
    comi.porcentaje_com,s.t_pago, ed.descripcion,d.dir_proc,d.dir_dest
    FROM service.\"DESPACHO\" d, service.\"SERVICIO\" s , service.\"CLIENTE\" c, service.\"PARAM_COM\" comi,service.\"TIPO_PAGO\" tp, service.\"ESTADO_DESPACHO\" ed
    WHERE d.fk_empleado = $empleado  AND s.n_ide = c.n_ide AND s.num_servicio = d.num_servicio
    AND s.p_comi = comi.id_com AND d.fecha_desp::date = '$fliquida'::date AND tp.id_tipopago = s.t_pago AND ed.id_estado_desp = d.estado_desp AND s.estado_serv not in(2,3) 
    GROUP BY c.clinom, c.cliapell , d.n_des,  d.fecha_desp, d.obs, s.total,tp.descripcion,comi.porcentaje_com,s.t_pago, ed.descripcion,d.dir_proc,d.dir_dest

    UNION

    SELECT count(1) as cantidad_despacho, d.num_servicio,   d.n_des,  
    d.fecha_desp, c.clinom || '' || c.cliapell as clienom , d.obs, s.total::numeric,tp.descripcion as tpago, 
    comi.porcentaje_com,s.t_pago,ed.descripcion,d.dir_proc,d.dir_dest
    FROM service_norte.\"DESPACHO\" d, service.\"SERVICIO\" s , service.\"CLIENTE\" c, service.\"PARAM_COM\" comi,service.\"TIPO_PAGO\" tp, service.\"ESTADO_DESPACHO\" ed
    WHERE d.fk_empleado = $empleado  AND s.n_ide = c.n_ide AND s.num_servicio = d.num_servicio
    AND s.p_comi = comi.id_com AND d.fecha_desp::date = '$fliquida'::date AND tp.id_tipopago = s.t_pago AND ed.id_estado_desp = d.estado_desp AND s.estado_serv not in(2,3) 
    GROUP BY c.clinom, c.cliapell , d.n_des,  d.fecha_desp, d.obs, s.total,tp.descripcion,comi.porcentaje_com,s.t_pago, ed.descripcion,d.dir_proc,d.dir_dest ORDER BY 1 DESC
    ");


        //var_dump("SELECT * FROM service.\"SERVICIO\" WHERE estado_serv in(1,2,3,4,5) AND fecha_serv::date = '$fecha_actual'::date ");

  return $result;

  pg_close($conn);


}

public function listarAhorro($emp){

  $conn = new Conexion();

  $conn->conectar();

  $result = $conn->query("SELECT a.*, e.* FROM service.\"AHORRO\" a, service.\"EMPLEADO\" e  WHERE kf_empleado =  $emp::integer AND a.kf_empleado = e.n_ide ");


        //var_dump("SELECT * FROM service.\"SERVICIO\" WHERE estado_serv in(1,2,3,4,5) AND fecha_serv::date = '$fecha_actual'::date ");

  return $result;

  pg_close($conn);




}


public function listarAhorrosNorte($emp){

  $conn = new Conexion();

  $conn->conectar();

  $result = $conn->query("SELECT * FROM service_norte.\"AHORRON\" WHERE fk_empleado =  $emp::integer ");


        //var_dump("SELECT * FROM service.\"SERVICIO\" WHERE estado_serv in(1,2,3,4,5) AND fecha_serv::date = '$fecha_actual'::date ");

  return $result;

  pg_close($conn);


}


public function getBusquedaDespachoCriteriaTelefono($mobil){

  $conn = new Conexion();

  $conn->conectar();

  $result = $conn->query("SELECT * FROM service_norte.\"AHORRO\" WHERE kf_empleado =  $emp::integer ");


        //var_dump("SELECT * FROM service.\"SERVICIO\" WHERE estado_serv in(1,2,3,4,5) AND fecha_serv::date = '$fecha_actual'::date ");

  return $result;

  pg_close($conn);


}

public function getInfoEmpleadoCentro($emp){


  $conn = new Conexion();

  $conn->conectar();

  $result = $conn->query("SELECT * FROM service.\"EMPLEADO\" WHERE n_ide =  $emp::bigint ");


  return $result;

  pg_close($conn);


}

public function getInfoEmpleadoNorte($emp){


  $conn = new Conexion();

  $conn->conectar();

  $result = $conn->query("SELECT * FROM service_norte.\"EMPLEADO\" WHERE n_ide =  $emp::bigint AND empsucursal = 'N' ");


  return $result;

  pg_close($conn);


}

public function getInfoEmpleadoCentro_Norte($emp){


  $conn = new Conexion();

  $conn->conectar();

  $result = $conn->query("SELECT * FROM service.\"EMPLEADO\" WHERE n_ide =  $emp::bigint UNION SELECT * FROM service_norte.\"EMPLEADO\" WHERE n_ide =  $emp::integer ");


  return $result;

  pg_close($conn);


}

public function actualizarDatoEmpleado($pl, $data){

  $conn = new Conexion();

  $conn->conectar();

  $res = $conn->executePL($pl, $data);



  return $res;

  pg_close($conn);
}

public function buscarDespachoMobil($mob,$tpago){


  $conn = new Conexion();

  $conn->conectar();

  if($mob != "-1"){

  

     $mobilc = " d.fk_empleado  = '$mob'::bigint";
     $mobiln = " dn.fk_empleado = $mob::bigint";


  }else{

   $mobilc = ' d.fk_empleado::text like ' . "'%'";
   $mobiln = ' dn.fk_empleado::text like ' . "'%'";

  }

  if($tpago == "3"){

     $sqlc = ' s.t_pago in(1,2)';
     $sqln = ' s.t_pago in(1,2)';
  }else{
    $sqlc = ' s.t_pago = ' . $tpago;
    $sqln = ' s.t_pago = ' . $tpago;
  }

  
  $result = $conn->query("SELECT s.num_servicio, s.fecha_serv, c.clinom || ' ' || c.cliapell as nombre_completo, c.clitel, c.clicel, s.total, d.dir_proc, d.dir_dest, d.dir_rta1, d.dir_rta1,tps.descripcion as tpagos,
    d.dir_rta1, d.dir_rta1,d.dir_rta1, d.dir_rta1, d.dir_rta1,e.num_mob,ed.descripcion
    FROM service.\"SERVICIO\" s, service.\"CLIENTE\" c, service.\"DESPACHO\" d, service.\"EMPLEADO\" e, service.\"ESTADO_DESPACHO\" ed,service.\"TIPO_PAGO\" tps
    WHERE ed.id_estado_desp = d.estado_desp AND d.fk_empleado = e.n_ide AND s.n_ide = c.n_ide AND s.num_servicio = d.num_servicio AND s.fecha_ent::date = now()::date AND $mobilc AND $sqlc AND tps.id_tipopago = s.t_pago 

    UNION

   SELECT s.num_servicio, s.fecha_serv, c.clinom || ' ' || c.cliapell as nombre_completo, c.clitel, c.clicel, s.total, dn.dir_proc, dn.dir_dest, dn.dir_rta1, dn.dir_rta1,tps.descripcion as tpagos,
    dn.dir_rta1, dn.dir_rta1,dn.dir_rta1, dn.dir_rta1, dn.dir_rta1,en.num_mob,ed.descripcion
    FROM service.\"SERVICIO\" s, service.\"CLIENTE\" c, service_norte.\"DESPACHO\" dn, service_norte.\"EMPLEADO\" en, service.\"ESTADO_DESPACHO\" ed ,service.\"TIPO_PAGO\" tps 
    WHERE ed.id_estado_desp = dn.estado_desp AND dn.fk_empleado = en.n_ide AND s.n_ide = c.n_ide AND s.num_servicio = dn.num_servicio AND s.fecha_ent::date = now()::date AND $mobiln AND $sqln AND tps.id_tipopago = s.t_pago");


  return $result;

  pg_close($conn);

}


public function listarEmpleadoOficina(){


  $conn = new Conexion();

  $conn->conectar();

  $result = $conn->query("SELECT * FROM service.\"EMPLEADO\" WHERE tipo_empleo = 2 ");


  return $result;

pg_close($conn);

}

public function listoMovilBySucursal($suc){


  $conn = new Conexion();

  $conn->conectar();

  if($suc == "C"){

    $sql = "empsucursal = '$suc' ";

  }else{

    $sql = "empsucursal = 'CN' ";

  }

  $result = $conn->query("SELECT n_ide, num_mob FROM service.\"EMPLEADO\" WHERE $sql AND id_empleado != 1 ORDER BY num_mob asc");


  return $result;

  pg_close($conn);


}

function traerInfoEmpleadoById($idemp){


$conn = new Conexion();

  $conn->conectar();

  

  $result = $conn->query("SELECT * FROM service.\"EMPLEADO\" WHERE n_ide = $idemp ");


  return $result;

  pg_close($conn);


}

}