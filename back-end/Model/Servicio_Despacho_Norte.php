 <?php


require '../ConexionBD/Conexion.php';

class Servicio_Despacho_Norte {
    
    
    private $op;
    
    public function __construct() {
        
    }
    
    public function getServicioID(){

         $conn = new Conexion();
        
        $conn->conectar();
        
       $res = $conn->executeView('SELECT MAX(num_servicio::integer) + 1 as nservi FROM service.\"SERVICIO\"');

        return $res;

        pg_close($conn);
                
    }

   
    
    public function listMobil(){
        
         $conn = new Conexion();
        
        $conn->conectar();
              
        $result = $conn->executeSql('service."EMPLEADO"', 'estado', 'A', 'n_ide,num_mob');
        
        
        return $result;

        pg_close($conn);
        
    }
    
    public function listNombById($dato_ide){
        
         $conn = new Conexion();
        
        $conn->conectar();
              
        $result = $conn->getObjectsBy2ID('service."EMPLEADO"', 'estado', 'n_ide', 'A' , $dato_ide ,'empnom,n_ide');
        
        
        return $result; // 304

        pg_close($conn);
        
    }

    public function serviciosAll(){

         $conn = new Conexion();
        
        $conn->conectar();

        $fecha_actual = date('Y-m-d');
              
        $result = $conn->query("SELECT s.num_servicio, s.fecha_serv, c.clinom || ' ' || c.cliapell as nombre_completo, s.total, ed.descripcion, u.usuanom 
FROM service.\"SERVICIO\" s, service.\"CLIENTE\" c, service_norte.\"DESPACHO\" d, service.\"ESTADO_DESPACHO\" ed,autentication.\"USUARIO\" u  WHERE d.estado_desp = 3 
AND d.num_servicio = s.num_servicio AND s.usuario = u.usuadoc   AND fecha_serv::date = '$fecha_actual'::date  AND d.estado_desp = ed.id_estado_desp AND c.n_ide = s.n_ide ORDER BY 1 DESC");
        
        //var_dump("SELECT * FROM service.\"SERVICIO\" WHERE estado_serv in(1,2,3,4,5) AND fecha_serv::date = '$fecha_actual'::date ");
        
        return $result;

        pg_close($conn);


    }

      public function getOSDespachado(){

            $conn = new Conexion();
        
        $conn->conectar();

        $fecha_actual = date('Y-m-d');
             
        $result = $conn->query("SELECT s.num_servicio, s.fecha_serv,to_char(now(),'YYYY-MM-DD') as fecha, to_char(s.fecha_serv,'HH12:MI') as hora , c.clinom || ' ' || c.cliapell as nombre_completo, s.total, des.descripcion, emp.num_mob
FROM service.\"SERVICIO\" s, service.\"CLIENTE\" c, service_norte.\"DESPACHO\" d, service.\"ESTADO_DESPACHO\" des, service_norte.\"EMPLEADO\" emp   WHERE estado_serv = 5 AND fecha_serv::date = '$fecha_actual'::date  AND c.n_ide = s.n_ide AND d.num_servicio = s.num_servicio AND d.estado_desp = 4 AND des.id_estado_desp = d.estado_desp AND emp.n_ide = d.fk_empleado ORDER BY 1 DESC");
        
        //var_dump("SELECT * FROM service.\"SERVICIO\" WHERE estado_serv in(1,2,3,4,5) AND fecha_serv::date = '$fecha_actual'::date ");
        
        return $result;

        pg_close($conn);

    }

    public function getOs($os){

         $conn = new Conexion();
        
        $conn->conectar();

                   
        $result = $conn->query("SELECT s.num_servicio, s.fecha_serv, c.clinom || ' ' || c.cliapell as nombre_completo, c.n_ide, c.clitel, c.clicel, d.obs,
            d.dir_proc, d.dir_dest, d.dir_rta1, d.dir_rta2,d.dir_rta3,d.dir_rta4,d.dir_rta5,d.dir_rta6,d.dir_rta7,d.comp_dire,d.comp_diredest
FROM service.\"SERVICIO\" s, service.\"CLIENTE\" c, service_norte.\"DESPACHO\" d WHERE s.num_servicio = d.num_servicio AND s.n_ide = c.n_ide  AND s.num_servicio = '$os'::text  ");
        
        //var_dump("SELECT * FROM service.\"SERVICIO\" WHERE estado_serv in(1,2,3,4,5) AND fecha_serv::date = '$fecha_actual'::date ");
        
        return $result;

        pg_close($conn);


    }

    public function actDespacho($pl, $datos){

             $conn = new Conexion();
        
        $conn->conectar();
        
       $res = $conn->executePL($pl, $datos);

        return $res;

        pg_close($conn);

    }

      public function buscarByFechaNorte($fi, $ff){


         $conn = new Conexion();
        
        $conn->conectar();
             
        $result = $conn->query("SELECT s.num_servicio, s.fecha_serv, c.clinom || ' ' || c.cliapell as nombre_completo, c.clitel, c.clicel, s.total, d.dir_proc, d.dir_dest, d.dir_rta1, d.dir_rta1,
            d.dir_rta1, d.dir_rta1,d.dir_rta1, d.dir_rta1, d.dir_rta1
            FROM service.\"SERVICIO\" s, service.\"CLIENTE\" c, service_norte.\"DESPACHO\" d 
            WHERE   s.n_ide = c.n_ide AND s.num_servicio = d.num_servicio AND s.fecha_ent BETWEEN '$fi' AND '$ff' ");
      
        return $result;

        pg_close($conn);

    }

    public function buscarLiquidadosNorte($fi, $ff){

         $conn = new Conexion();
        
        $conn->conectar();
             
        $result = $conn->query("SELECT id_liquidacion, fk_empleado, fecha_liq, fecha_sys, cantidad_serv, 
       total_liq, estado, usuario
  FROM service_norte.\"LIQUIDACION_DIARIAN\" WHERE fecha_liq::date BETWEEN '$fi' AND '$ff'
 ");

        return $result;

        pg_close($conn);

    }

   
    
}
