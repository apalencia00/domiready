<?php


require '../ConexionBD/Conexion.php';

class Servicio_Despacho {
    
    
    private $op;
    
    public function __construct() {
        
    }
    
    public function getServicioID(){

       $conn = new Conexion();
       
       $conn->conectar();
       
       $res = $conn->query("SELECT MAX(num_servicio::integer) + 1 as nservi FROM service.\"SERVICIO\" ");

       return $res;

       pg_close($conn);
       
   }

   public function clienteServicio($ide, $tel,$comp){

       $conn = new Conexion();
       
       $conn->conectar();

       $sql = '';

       if($tel != ""){

        $sql = "c.clitel =  '$tel' ";

    }

    if($comp != ""){
        $sql = "c.nomb_completo LIKE '%$comp%'" ;
    }

    if($ide != ""){

        $sql = 'c.n_ide =' .$ide;

    }

    
    $result = $conn->query("SELECT s.id_servicio,d.dir_proc, d.dir_dest, to_char(s.fecha_serv,'YYYY-MM-DD') as fecha_serv , s.total FROM service.\"SERVICIO\" s, service.\"DESPACHO\" d, service.\"CLIENTE\" c 
        WHERE s.n_ide = c.n_ide AND $sql AND d.num_servicio = s.num_servicio 

        UNION

            SELECT s.id_servicio,dn.dir_proc, dn.dir_dest, to_char(s.fecha_serv,'YYYY-MM-DD') as fecha_serv , s.total FROM service.\"SERVICIO\" s, service_norte.\"DESPACHO\" dn, service.\"CLIENTE\" c 
        WHERE s.n_ide = c.n_ide AND $sql AND dn.num_servicio = s.num_servicio 

        ORDER BY 1 ");
    
    
        //var_dump('SELECT * FROM service."\SERVICIO" WHERE n_ide = $ide ');
    return $result;

    pg_close($conn);

}


public function registrarServicio($pl,$datos) {
    
    $conn = new Conexion();
    
    $conn->conectar();
    
    $res = $conn->executePL($pl, $datos);

    return $res;

    pg_close($conn);
    
}


public function operacionServicio(){
    
    
    $conn = new Conexion();
    
    $conn->conectar();
    
    $result = $conn->query('SELECT * FROM service."ESTADO_ORDEN_SERV" WHERE estado = \'A\' ORDER BY 1');
    
    
    return $result;

    pg_close($conn);
    
    
}

public function tipoServicio(){
    
    $conn = new Conexion();
    
    $conn->conectar();
    
    $result = $conn->executeSql('service."TIPO_SERVICIO"', 'estado', 'A', '*');
    
    
    return $result;

    pg_close($conn);
    
}

public function tipoPago(){
    
    $conn = new Conexion();
    
    $conn->conectar();
    
    $result = $conn->executeSql('service."TIPO_PAGO"', 'estado', 'A', '*');
    
    
    return $result;

    pg_close($conn);
    
}

public function comision(){
    
   $conn = new Conexion();
   
   $conn->conectar();
   
   $result = $conn->query("SELECT id_com, porcentaje_com, estado
  FROM service.\"PARAM_COM\" WHERE estado = 'A' order by 1");
   
   
   return $result;

   pg_close($conn);
   
}

public function listMobil(){
    
   $conn = new Conexion();
   
   $conn->conectar();
   
   $result = $conn->query("SELECT n_ide,num_mob FROM service.\"EMPLEADO\" WHERE empsucursal in ('CN','C') AND tipo_empleo = 1 AND estado = 'A' ORDER BY num_mob ASC ");
   
   
   return $result;

   pg_close($conn);
   
}

public function listMobilNorte(){
    
   $conn = new Conexion();
   
   $conn->conectar();
   
   $result = $conn->query("SELECT n_ide,num_mob FROM service_norte.\"EMPLEADO\" WHERE empsucursal = 'CN' AND tipo_empleo = 1 AND estado = 'A' ORDER BY num_mob ASC");


   
   
   return $result;

   pg_close($conn);
   
}


public function listNombById($dato_ide){
    
   $conn = new Conexion();
   
   $conn->conectar();
   
   $result = $conn->query("SELECT s.empnom,s.n_ide FROM service.\"EMPLEADO\" s  WHERE s.n_ide = $dato_ide ORDER BY 1 ");
   
   
        return $result; // 304

        pg_close($conn);
        
    }

    public function serviciosAll(){

       $conn = new Conexion();
       
       $conn->conectar();

       $fecha_actual = date('Y-m-d');
       
       $result = $conn->query("SELECT  s.id_servicio,s.num_servicio, s.fecha_serv, c.nomb_completo as nombre_completo, emp.num_mob, tp.descripcion as t_pago , s.total, es.descripcion, u.usuanom,d.dir_proc,d.dir_dest,u.usuadoc
        FROM service.\"SERVICIO\" s, autentication.\"USUARIO\" u, service.\"ESTADO_ORDEN_SERV\" es, service.\"CLIENTE\" c, service.\"EMPLEADO\" emp, service.\"DESPACHO\" d, service.\"TIPO_PAGO\" tp WHERE estado_serv in(1,2,3,4,5) 
        AND fecha_serv::date = NOW()::date AND s.usuario = u.usuadoc  AND s.estado_serv = es.id_estado_orden AND c.n_ide = s.n_ide AND d.num_servicio = s.num_servicio AND d.fk_empleado = emp.n_ide AND s.t_pago = tp.id_tipopago
        UNION
        SELECT  s.id_servicio,s.num_servicio, s.fecha_serv, c.nomb_completo as nombre_completo, emp.num_mob, tp.descripcion as t_pago , s.total, es.descripcion, u.usuanom,dn.dir_proc,dn.dir_dest,u.usuadoc
        FROM service.\"SERVICIO\" s, autentication.\"USUARIO\" u, service.\"ESTADO_ORDEN_SERV\" es, service.\"CLIENTE\" c, service.\"EMPLEADO\" emp, service_norte.\"DESPACHO\" dn, service.\"TIPO_PAGO\" tp WHERE estado_serv in(2,3,5) 
        AND fecha_serv::date = NOW()::date AND s.usuario = u.usuadoc  AND s.estado_serv = es.id_estado_orden AND c.n_ide = s.n_ide AND dn.num_servicio = s.num_servicio AND dn.fk_empleado = emp.n_ide AND s.t_pago = tp.id_tipopago
        ORDER BY id_servicio DESC

        ");
       
        #var_dump("SELECT * FROM service.\"SERVICIO\" WHERE estado_serv in(1,2,3,4,5) AND fecha_serv::date = NOW()::date::date ");
       
       return $result;

       pg_close($conn);


   }

   public function cancelarServicio($datos){


      $conn = new Conexion();
      
      $conn->conectar();
      
      $res = $conn->insertSQL('service."SERVICIO"', $datos);

      return $res;

      pg_close($conn);

  }

  public function getOS($os){

    $conn = new Conexion();
    
    $conn->conectar();
    
    $result = $conn->query("SELECT s.tipo_servicio,tp.descripcion as desc_servicio,c.n_ide, c.clinom, ep.n_ide, ep.num_mob ,c.clitel, c.clicel, s.total, s.t_pago, d.dir_proc, d.dir_dest, d.obs, d.dir_rta1,d.dir_rta2, d.dir_rta3, d.dir_rta4, d.dir_rta5,d.dir_rta6,d.dir_rta7,d.comp_dire,d.comp_diredest
        FROM service.\"SERVICIO\" s, service.\"CLIENTE\" c, service.\"DESPACHO\" d, service.\"EMPLEADO\" ep, service.\"ESTADO_ORDEN_SERV\" tp
        WHERE s.num_servicio = '$os' AND  s.n_ide = c.n_ide AND s.num_servicio = d.num_servicio AND ep.n_ide = d.fk_empleado AND tp.id_estado_orden = s.tipo_servicio

        UNION

        SELECT s.tipo_servicio,tp.descripcion as desc_servicio ,c.n_ide, c.clinom, epn.n_ide, epn.num_mob, c.clitel, c.clicel, s.total, s.t_pago, dn.dir_proc, dn.dir_dest,dn.obs ,dn.dir_rta1,dn.dir_rta2, dn.dir_rta3, dn.dir_rta4, dn.dir_rta5,dn.dir_rta6,dn.dir_rta7,dn.comp_dire,dn.comp_diredest
        FROM service.\"SERVICIO\" s, service.\"CLIENTE\" c, service_norte.\"DESPACHO\" dn,service_norte.\"EMPLEADO\" epn,service.\"ESTADO_ORDEN_SERV\" tp
        WHERE s.num_servicio = '$os' AND  s.n_ide = c.n_ide AND s.num_servicio = dn.num_servicio AND epn.n_ide = dn.fk_empleado AND tp.id_estado_orden = s.tipo_servicio");
    
        //var_dump("SELECT * FROM service.\"SERVICIO\" WHERE estado_serv in(1,2,3,4,5) AND fecha_serv::date = NOW()::date::date ");
    
    return $result;

    pg_close($conn);

}

public function actOS($pl, $datos){

   $conn = new Conexion();
   
   $conn->conectar();
   
   $res = $conn->executePL($pl, $datos);

   return $res;

   pg_close($conn);

}

public function buscarOS($idserr){


   $conn = new Conexion();
   
   $conn->conectar();
   
   $result = $conn->query("SELECT c.n_ide, c.clinom, c.cliapell , c.clitel, c.clicel, s.total, d.dir_proc, d.dir_dest, d.dir_rta1, d.dir_rta1,
    d.dir_rta1, d.dir_rta1,d.dir_rta1, d.dir_rta1, d.dir_rta1
    FROM service.\"SERVICIO\" s, service.\"CLIENTE\" c, service.\"DESPACHO\" d 
    WHERE s.num_servicio = '$idserr' AND  s.n_ide = c.n_ide AND s.num_servicio = d.num_servicio ");
   
   return $result;

   pg_close($conn);



}

public function imprimir(){


    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://localhost:8080/JasperPrint/webresources/print/imprimir');
}

public function buscarByFecha($fi, $ff,$mov,$telefono,$nomb,$tpago) {


   $conn = new Conexion();


 if($tpago != 3){
    
    $sql4 = ' t_pago ='. $tpago;
    $sqln4= ' t_pago ='. $tpago;


}else{
    $sql4 = ' t_pago::text like ' . "'%'";
    $sqln4 = ' t_pago::text like ' . "'%'";
}




     if($nomb != ""){
    
    $sql3 = ' nomb_completo ='. "'$nomb'";
    $sqln3= ' nomb_completo ='. "'$nomb'";


}else{
    $sql3 = ' nomb_completo::text like ' . "'%'";
    $sqln3 = ' nomb_completo::text like ' . "'%'";
}


   if($telefono != ""){
    
    $sql2 = ' clitel ='. "'$telefono'";
    $sqln2= ' clitel ='. "'$telefono'";


}else{
    $sql2 = ' clitel::text like ' . "'%'";
    $sqln2 = ' clitel::text like ' . "'%'";
}


   if($mov != -1){
    
    $sql = ' e.num_mob ='. $mov;
    $sqln= 'en.num_mob ='. $mov;


}else{
    $sql = ' e.num_mob::text like ' . "'%'";
    $sqln = ' en.num_mob::text like ' . "'%'";
}
$conn->conectar();


$result = $conn->query("SELECT s.num_servicio, s.fecha_serv, c.clinom || ' ' || c.cliapell as nombre_completo, c.clitel, c.clicel, s.total, d.dir_proc, d.dir_dest, d.dir_rta1, d.dir_rta1,
    d.dir_rta1, d.dir_rta1,d.dir_rta1, d.dir_rta1, d.dir_rta1,e.num_mob,ed.descripcion,tps.descripcion as tpagos
    FROM service.\"SERVICIO\" s, service.\"CLIENTE\" c, service.\"DESPACHO\" d, service.\"EMPLEADO\" e, service.\"ESTADO_DESPACHO\" ed,service.\"TIPO_PAGO\" tps 
    WHERE ed.id_estado_desp = d.estado_desp AND d.fk_empleado = e.n_ide AND s.n_ide = c.n_ide AND s.num_servicio = d.num_servicio AND $sql AND s.fecha_ent::date BETWEEN '$fi'::date AND '$ff'::date AND tps.id_tipopago = s.t_pago AND $sql2 AND $sql3 AND $sql4

    UNION

    SELECT s.num_servicio, s.fecha_serv, c.clinom || ' ' || c.cliapell as nombre_completo, c.clitel, c.clicel, s.total, dn.dir_proc, dn.dir_dest, dn.dir_rta1, dn.dir_rta1,
    dn.dir_rta1, dn.dir_rta1,dn.dir_rta1, dn.dir_rta1, dn.dir_rta1,en.num_mob,ed.descripcion,tps.descripcion as tpagos
    FROM service.\"SERVICIO\" s, service.\"CLIENTE\" c, service_norte.\"DESPACHO\" dn, service_norte.\"EMPLEADO\" en, service.\"ESTADO_DESPACHO\" ed,service.\"TIPO_PAGO\" tps 
    WHERE ed.id_estado_desp = dn.estado_desp AND dn.fk_empleado = en.n_ide AND s.n_ide = c.n_ide AND s.num_servicio = dn.num_servicio AND $sqln AND s.fecha_ent::date BETWEEN '$fi'::date AND '$ff'::date AND tps.id_tipopago = s.t_pago AND $sqln2 AND $sqln3 AND $sqln4

    ");


return $result;

pg_close($conn);
}

public function buscarLiquidados($fi, $ff, $mov){

   $conn = new Conexion();

   if($mov != -1){
    
    $sql = ' e.num_mob ='. $mov;


}else{
   $sql = ' e.num_mob::text like ' . "'%'";
}

$conn->conectar();


$result = $conn->query("SELECT lq.id_liquidacion, lq.fk_empleado, e.num_mob ,lq.fecha_liq, lq.fecha_sys, lq.cantidad_serv,  lq.total_liq, lq.estado, lq.usuario FROM service.\"LIQUIDACION_DIARIA\" lq , service.\"EMPLEADO\" e WHERE e.n_ide = lq.fk_empleado AND $sql AND fecha_liq::date BETWEEN '$fi'::date AND '$ff'::date;");

return $result;

pg_close($conn);

}



public function localizar_cliente_historial($valor,$tele){

   $conn = new Conexion();


   
   $conn->conectar();
   
   $result = $conn->query("SELECT s.id_servicio,d.dir_proc, d.dir_dest, to_char(s.fecha_serv,'YYYY-MM-DD') as fecha_serv , s.total FROM service.\"SERVICIO\" s, service.\"DESPACHO\" d, service.\"CLIENTE\" c 
    WHERE s.n_ide = c.n_ide AND  d.dir_proc like '%$valor%' AND d.num_servicio = s.num_servicio AND c.clitel = '$tele'

    UNION

    SELECT s.id_servicio,d.dir_proc, d.dir_dest,  to_char(s.fecha_serv,'YYYY-MM-DD') as fecha_serv , s.total FROM service.\"SERVICIO\" s, service.\"DESPACHO\" d, service.\"CLIENTE\" c 
    WHERE s.n_ide = c.n_ide AND  d.dir_dest like '%$valor%' AND d.num_servicio = s.num_servicio AND c.clitel = '$tele' 

    UNION

    SELECT s.id_servicio,d.dir_proc, d.dir_dest,  to_char(s.fecha_serv,'YYYY-MM-DD') as fecha_serv , s.total FROM service.\"SERVICIO\" s, service.\"DESPACHO\" d, service.\"CLIENTE\" c 
    WHERE s.n_ide = c.n_ide AND  d.obs like '%$valor%' AND d.num_servicio = s.num_servicio AND c.clitel = '$tele'

    UNION

    SELECT s.id_servicio,d.dir_proc, d.dir_dest, to_char(s.fecha_serv,'YYYY-MM-DD') as fecha_serv , s.total FROM service.\"SERVICIO\" s, service_norte.\"DESPACHO\" d, service.\"CLIENTE\" c 
    WHERE s.n_ide = c.n_ide AND  d.dir_proc like '%$valor%' AND d.num_servicio = s.num_servicio AND c.clitel = '$tele'

    UNION

    SELECT s.id_servicio,d.dir_proc, d.dir_dest,  to_char(s.fecha_serv,'YYYY-MM-DD') as fecha_serv , s.total FROM service.\"SERVICIO\" s, service_norte.\"DESPACHO\" d, service.\"CLIENTE\" c 
    WHERE s.n_ide = c.n_ide AND  d.dir_dest like '%$valor%' AND d.num_servicio = s.num_servicio AND c.clitel = '$tele'

    UNION


     SELECT s.id_servicio,d.dir_proc, d.dir_dest,  to_char(s.fecha_serv,'YYYY-MM-DD') as fecha_serv , s.total FROM service.\"SERVICIO\" s, service_norte.\"DESPACHO\" d, service.\"CLIENTE\" c 
    WHERE s.n_ide = c.n_ide AND  d.obs like '%$valor%' AND d.num_servicio = s.num_servicio AND c.clitel = '$tele'




    ");

   

   return $result;

   pg_close($conn);

}

public function localizar_cliente_historial_byID_servicio($servicio){

   $conn = new Conexion();
   
   $conn->conectar();
   
   $result = $conn->query("SELECT s.id_servicio,d.dir_proc, d.dir_dest, c.n_ide,c.clinom,c.cliapell,c.clitel,c.clicel,c.nomb_completo, s.total, d.comp_dire, d.comp_diredest  FROM service.\"SERVICIO\" s, service.\"DESPACHO\" d, service.\"CLIENTE\" c
    WHERE s.n_ide = c.n_ide AND  s.id_servicio = $servicio AND d.num_servicio = s.num_servicio

    UNION


    SELECT s.id_servicio,dn.dir_proc, dn.dir_dest, c.n_ide,c.clinom,c.cliapell,c.clitel,c.clicel,c.nomb_completo, s.total, dn.comp_dire, dn.comp_diredest  FROM service.\"SERVICIO\" s, service_norte.\"DESPACHO\" dn, service.\"CLIENTE\" c
    WHERE s.n_ide = c.n_ide AND  s.id_servicio = $servicio AND dn.num_servicio = s.num_servicio");

   return $result;

   pg_close($conn);


}

public function listTipoPago(){

   $conn = new Conexion();
   
   $conn->conectar();
   
   $result = $conn->query("SELECT id_tipopago, descripcion, estado FROM service.\"TIPO_PAGO\"");

   return $result;

   $conn = null;

   pg_close($conn);



}

public function getServiciosByMovil($movil){


    $conn = new Conexion();
    
    $conn->conectar();
    
    $result = $conn->query("SELECT s.num_servicio, s.fecha_serv, c.clinom || ' ' || c.cliapell as nombre_completo, emp.num_mob, tp.descripcion as t_pago , s.total, es.descripcion, d.dir_proc, d.dir_dest
        FROM service.\"SERVICIO\" s, service.\"ESTADO_ORDEN_SERV\" es, service.\"CLIENTE\" c, service.\"EMPLEADO\" emp, service.\"DESPACHO\" d, service.\"TIPO_PAGO\" tp WHERE estado_serv in(1,2,3,4,5) 
        AND fecha_serv::date = now()::date  AND s.estado_serv = es.id_estado_orden AND c.n_ide = s.n_ide AND d.num_servicio = s.num_servicio AND d.fk_empleado = emp.n_ide AND d.fk_empleado = $movil::integer AND s.t_pago = tp.id_tipopago
        UNION 
        SELECT s.num_servicio, s.fecha_serv, c.clinom || ' ' || c.cliapell as nombre_completo, emp.num_mob, tp.descripcion as t_pago , s.total, es.descripcion, dn.dir_proc, dn.dir_dest 
        FROM service.\"SERVICIO\" s, service.\"ESTADO_ORDEN_SERV\" es, service.\"CLIENTE\" c, service.\"EMPLEADO\" emp, service_norte.\"DESPACHO\" dn, service.\"TIPO_PAGO\" tp WHERE estado_serv in(2,3,5) 
        AND fecha_serv::date = now()::date  AND s.estado_serv = es.id_estado_orden AND c.n_ide = s.n_ide AND dn.num_servicio = s.num_servicio AND dn.fk_empleado = emp.n_ide AND dn.fk_empleado = $movil::integer AND s.t_pago = tp.id_tipopago");

    return $result;

    $conn = null;

    pg_close($conn);


}

public function listMobilNorteCaja(){

    $conn = new Conexion();
    
    $conn->conectar();
    
    $result = $conn->query("SELECT n_ide,num_mob FROM service_norte.\"EMPLEADO\"");

    return $result;

    pg_close($conn);

}

public function listMobilCentroCajaAhorro(){

    $conn = new Conexion();
    
    $conn->conectar();
    
    $result = $conn->query("SELECT n_ide,num_mob FROM service.\"EMPLEADO\"");

    return $result;

    pg_close($conn);

}

public function totalAhorroMobil($mob){

    $conn = new Conexion();
    
    $conn->conectar();
    
    $result = $conn->query("select sum(valor) as total from service.\"AHORRO\" WHERE kf_empleado = $mob ");

    return $result;

    pg_close($conn);

}

public function totalAhorroMobilNorte($mob){

  $conn = new Conexion();
  
  $conn->conectar();

  
  $result = $conn->query("select sum(valor) as total from service_norte.\"AHORRON\" WHERE fk_empleado = $mob ");

  return $result;

  pg_close($conn);


}

public function totalServicioDiario($fi,$ff,$telefono,$nomb,$tpago){

   $conn = new Conexion();
   
   $conn->conectar();

   if($tpago != 3){
    
    $sql4 = ' t_pago ='. $tpago;
    


}else{
    $sql4 = ' t_pago::text like ' . "'%'";
   
}




     if($nomb != ""){
    
    $sql3 = ' nomb_completo ='. "'$nomb'";
   


}else{
    $sql3 = ' nomb_completo::text like ' . "'%'";
    
}


   if($telefono != ""){
    
    $sql2 = ' clitel ='. "'$telefono'";
    


}else{
    $sql2 = ' clitel::text like ' . "'%'";
    
}


   
   $result = $conn->query("SELECT SUM(s.total),COUNT(s.num_servicio) FROM service.\"SERVICIO\" s, service.\"CLIENTE\" c WHERE s.fecha_serv::date BETWEEN '$fi'::date AND '$ff'::date AND s.estado_serv not in(2,3) AND c.n_ide = s.n_ide AND $sql3  AND $sql2 AND $sql4 ");

   #var_dump("SELECT SUM(s.total),COUNT(s.num_servicio) FROM service.\"SERVICIO\" s, service.\"CLIENTE\" c WHERE s.fecha_serv::date BETWEEN '$fi'::date AND '$ff'::date AND s.estado_serv not in(2,3) AND c.n_ide = s.n_ide AND $sql3  AND $sql2 AND $sql4 ");

   return $result;

   pg_close($conn);


}

public function totalServiciosoloMovil($mob,$fi, $ff)

{


    $conn = new Conexion();
    
    $conn->conectar();

    
    $result = $conn->query("SELECT SUM(s.total),COUNT(s.num_servicio) FROM service.\"SERVICIO\" s, service.\"EMPLEADO\" e, service.\"DESPACHO\" d WHERE fecha_serv::date BETWEEN '$fi'::date AND '$ff'::date AND d.fk_empleado = $mob::bigint  AND e.n_ide = d.fk_empleado AND s.num_servicio = d.num_servicio AND s.estado_serv not in(2,3)

        UNION

        select SUM(s.total),COUNT(s.num_servicio) FROM service.\"SERVICIO\" s, service_norte.\"EMPLEADO\" en, service_norte.\"DESPACHO\" dn WHERE fecha_serv::date = now()::date AND dn.fk_empleado = $mob::bigint AND en.n_ide = dn.fk_empleado AND s.num_servicio = dn.num_servicio AND s.estado_serv not in(2,3)");

    return $result;

    pg_close($conn);

}


public function listarServiciosRetenidos(){

    $fecha_actual = date('Y-m-d');

    $conn = new Conexion();
    
    $conn->conectar();


    $result = $conn->query("SELECT  s.id_servicio, s.tipo_servicio, s.num_servicio, c.nomb_completo, s.fecha_serv, 
     s.fecha_ent, s.t_pago, s.total, s.p_comi, s.obs, est.descripcion, s.usuario
     FROM service.\"SERVICIO\" s , service.\"CLIENTE\" c, service.\"ESTADO_ORDEN_SERV\" est where c.n_ide = s.n_ide AND s.estado_serv in (2,3) AND est.id_estado_orden = s.estado_serv AND s.fecha_ent BETWEEN NOW()::date AND NOW()::date " );

#var_dump($result);

    return $result;

    pg_close($conn);


}


public function listarServiciosRetenidosDatos($servicio){

    $fecha_actual = date('Y-m-d');

    $conn = new Conexion();
    
    $conn->conectar();


    $result = $conn->query("SELECT  s.id_servicio, s.tipo_servicio, s.num_servicio, c.nomb_completo, s.fecha_serv, 
     s.fecha_ent, s.t_pago, s.total, s.p_comi, rete.\"DESCRIPCION\", est.descripcion, s.usuario,c.clitel
     FROM service.\"SERVICIO\" s , service.\"CLIENTE\" c, service.\"ESTADO_ORDEN_SERV\" est , service.\"CAUSAL_RETENCION_SERVICIO\" rete where c.n_ide = s.n_ide AND s.estado_serv in (2,3) AND est.id_estado_orden = s.estado_serv AND s.fecha_ent BETWEEN NOW()::date AND NOW()::date AND s.num_servicio = '$servicio' AND rete.\"FK_NUM_SERVICIO\" = s.num_servicio" );

#var_dump($result);

    return $result;

    pg_close($conn);


}


public function getServicioPorTel($tel){

    $conn = new Conexion();
    
    $conn->conectar();
    
    $result = $conn->query("SELECT s.num_servicio, s.fecha_serv, c.clinom || ' ' || c.cliapell as nombre_completo, emp.num_mob, tp.descripcion as t_pago , s.total, es.descripcion 
        FROM service.\"SERVICIO\" s, service.\"ESTADO_ORDEN_SERV\" es, service.\"CLIENTE\" c, service.\"EMPLEADO\" emp, service.\"DESPACHO\" d, service.\"TIPO_PAGO\" tp WHERE c.clitel = '$tel'
        AND fecha_serv::date = now()::date  AND s.estado_serv = es.id_estado_orden AND c.n_ide = s.n_ide AND d.num_servicio = s.num_servicio AND d.fk_empleado = emp.n_ide AND s.t_pago = tp.id_tipopago
        UNION 
        SELECT s.num_servicio, s.fecha_serv, c.clinom || ' ' || c.cliapell as nombre_completo, emp.num_mob, tp.descripcion as t_pago , s.total, es.descripcion 
        FROM service.\"SERVICIO\" s, service.\"ESTADO_ORDEN_SERV\" es, service.\"CLIENTE\" c, service.\"EMPLEADO\" emp, service_norte.\"DESPACHO\" dn, service.\"TIPO_PAGO\" tp WHERE c.clitel = '$tel'
        AND fecha_serv::date = now()::date  AND s.estado_serv = es.id_estado_orden AND c.n_ide = s.n_ide AND dn.num_servicio = s.num_servicio AND dn.fk_empleado = emp.n_ide AND s.t_pago = tp.id_tipopago");

    return $result;

    $conn = null;

    pg_close($conn);

}


public function getServicioPorNombre($nom){

    $conn = new Conexion();
    
    $conn->conectar();
    
    $result = $conn->query(" SELECT  s.id_servicio,s.num_servicio, s.fecha_serv, c.nomb_completo as nombre_completo, emp.num_mob, tp.descripcion as t_pago , s.total, es.descripcion, u.usuanom,d.dir_proc,d.dir_dest,u.usuadoc
        FROM service.\"SERVICIO\" s, autentication.\"USUARIO\" u, service.\"ESTADO_ORDEN_SERV\" es, service.\"CLIENTE\" c, service.\"EMPLEADO\" emp, service.\"DESPACHO\" d, service.\"TIPO_PAGO\" tp WHERE c.clinom like '%$nom%' AND estado_serv in(1,2,3,4,5) 
        AND fecha_serv::date = now()::date AND s.usuario = u.usuadoc  AND s.estado_serv = es.id_estado_orden AND c.n_ide = s.n_ide AND d.num_servicio = s.num_servicio AND d.fk_empleado = emp.n_ide AND s.t_pago = tp.id_tipopago
        UNION
        SELECT  s.id_servicio,s.num_servicio, s.fecha_serv, c.nomb_completo as nombre_completo, emp.num_mob, tp.descripcion as t_pago , s.total, es.descripcion, u.usuanom,dn.dir_proc,dn.dir_dest,u.usuadoc
        FROM service.\"SERVICIO\" s, autentication.\"USUARIO\" u, service.\"ESTADO_ORDEN_SERV\" es, service.\"CLIENTE\" c, service.\"EMPLEADO\" emp, service_norte.\"DESPACHO\" dn, service.\"TIPO_PAGO\" tp WHERE c.clinom like '%$nom%' AND estado_serv in(2,3,5) 
        AND fecha_serv::date = now()::date AND s.usuario = u.usuadoc  AND s.estado_serv = es.id_estado_orden AND c.n_ide = s.n_ide AND dn.num_servicio = s.num_servicio AND dn.fk_empleado = emp.n_ide AND s.t_pago = tp.id_tipopago
        ORDER BY id_servicio DESC");


    return $result;

    pg_close($conn);

}

public function listAllMobil(){

    $conn = new Conexion();
    
    $conn->conectar();
    
    $result = $conn->query("SELECT n_ide,num_mob FROM service.\"EMPLEADO\" WHERE empsucursal in ('CN', 'C') ORDER BY num_mob ASC ");
    
    
    return $result;

    pg_close($conn);

}

public function getServiciosEstado($estado){

   $conn = new Conexion();
   
   $conn->conectar();

   $actual = date('Y-m-d');
   
   $result = $conn->query("SELECT s.num_servicio, s.fecha_serv, c.clinom || ' ' || c.cliapell as nombre_completo, c.clitel, c.clicel, s.total, d.dir_proc, d.dir_dest, d.dir_rta1, d.dir_rta1,
    d.dir_rta1, d.dir_rta1,d.dir_rta1, d.dir_rta1, d.dir_rta1,e.num_mob,ed.descripcion,tps.descripcion as tpagos
    FROM service.\"SERVICIO\" s, service.\"CLIENTE\" c, service.\"DESPACHO\" d, service.\"EMPLEADO\" e, service.\"ESTADO_DESPACHO\" ed,service.\"TIPO_PAGO\" tps 
    WHERE ed.id_estado_desp = d.estado_desp AND d.fk_empleado = e.n_ide AND s.n_ide = c.n_ide AND s.num_servicio = d.num_servicio AND s.fecha_ent::date BETWEEN '$actual'::date AND '$actual'::date AND tps.id_tipopago = s.t_pago AND s.estado_serv = $estado

    UNION

    SELECT s.num_servicio, s.fecha_serv, c.clinom || ' ' || c.cliapell as nombre_completo, c.clitel, c.clicel, s.total, dn.dir_proc, dn.dir_dest, dn.dir_rta1, dn.dir_rta1,
    dn.dir_rta1, dn.dir_rta1,dn.dir_rta1, dn.dir_rta1, dn.dir_rta1,en.num_mob,ed.descripcion,tps.descripcion as tpagos
    FROM service.\"SERVICIO\" s, service.\"CLIENTE\" c, service_norte.\"DESPACHO\" dn, service_norte.\"EMPLEADO\" en, service.\"ESTADO_DESPACHO\" ed,service.\"TIPO_PAGO\" tps 
    WHERE ed.id_estado_desp = dn.estado_desp AND dn.fk_empleado = en.n_ide AND s.n_ide = c.n_ide AND s.num_servicio = dn.num_servicio AND s.fecha_ent::date BETWEEN '$actual'::date AND '$actual'::date AND tps.id_tipopago = s.t_pago AND s.estado_serv = $estado");
   
   
   return $result;

   pg_close($conn); 

}

function listEstados(){

    $conn = new Conexion();
    
    $conn->conectar();
    
      $result = $conn->query("SELECT *
    FROM service.\"ESTADOS\";
 ");
    
    
    return $result;

    pg_close($conn);


}

function listSucursales(){

    $conn = new Conexion();
    
    $conn->conectar();
    
    $result = $conn->query("SELECT *
  FROM service.\"SUCURSAL\" ");
    
    
    return $result;

    pg_close($conn);


}




}
