<?php

require '../ConexionBD/Conexion.php';

class Ahorro {
    
    
    public function __construct() {
        
    }

    public function regAhorroCentro($pl, $data){

    	$conn = new Conexion();

    	$conn->conectar(); 

        $result = $conn->executePl($pl, $data);

     return $result;

     pg_close($conn);




    }


    public function regAhorroNorte($pl, $data){

    	$conn = new Conexion();

    	$conn->conectar(); 

     $result 	= $conn->executePl($pl, $data);

     return $result;

     pg_close($conn);


    }

    public function buscarFechaAhorro($fi, $ff, $mov)

    {

        $conn = new Conexion();

        

        if($mov != -1 ){

            $sql = ' num_mob = ' . $mov;


        }else{

          $sql = ' num_mob::text like ' . "'%'";
        }

        $conn->conectar(); 


     $result  = $conn->query("SELECT id_ahorro, kf_empleado, num_mob ,fecha_ahorro, valor, usuario
  FROM service.\"AHORRO\", service.\"EMPLEADO\" WHERE fecha_ahorro::date BETWEEN '$fi'::date AND '$ff'::date AND kf_empleado = n_ide AND $sql");

     return $result;

     pg_close($conn);




    }


    public function buscarFechaAhorroNorte($fi, $ff, $mov){


        $conn = new Conexion();

        

         if($mov != -1 ){

            $sql = ' num_mob = ' . $mov;


        }else{

          $sql = ' num_mob::text like ' . "'%'";
        }

        $conn->conectar(); 

  

     $result = $conn->query("SELECT id_ahorro, fk_empleado, num_mob ,fecha_ahorro, valor, usuario
  FROM service_norte.\"AHORRON\",service_norte.\"EMPLEADO\" WHERE fecha_ahorro::date BETWEEN '$fi'::date AND '$ff'::date AND fk_empleado = n_ide AND $sql");

     return $result;

     pg_close($conn);

    }

}


