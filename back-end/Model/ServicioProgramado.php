<?php

$cadena = explode("/",$_SERVER["DOCUMENT_ROOT"]  );

if ($cadena[3] == "domiready") {
    require_once($_SERVER["DOCUMENT_ROOT"] . '/back-end/ConexionBD/Conexion.php');
}
else{
    require_once($_SERVER["DOCUMENT_ROOT"].'/domiready' . '/back-end/ConexionBD/Conexion.php');
}


class ServicioProgramado {
    
    
    public function __construct() {
        
    }

    public function getProgramado(){

    	$conn = new Conexion();

    	$conn->conectar();

     $result 	= $conn->sql('calendar."PROGRAMADO"' , '*');
     //print_r($result);
     return $result;

     pg_close($conn);


    }


    public function regServProgramado($pl,$datos){

        $conn = new Conexion();
        
        $conn->conectar();
        
       $res = $conn->executePL($pl, $datos);

        return $res;

        pg_close($conn);

    }

    public function listarProgramado(){

        $conn = new Conexion();
        $conn->conectar();

       
     $result    = $conn->query("SELECT id, cid, title, notes, email, locationsc, remeber, fecha_registro, 
       estado, usuario, cliente_telefono, p.inicio::date as start, p.final::date as end,hinicio,hfinal
  FROM calendar.\"PROGRAMADO\" p WHERE fecha_registro::date > current_date - interval '10' day
");

        return $result;

        pg_close($conn);
    }


    public function listarProgramadoPorId($id){


        $conn = new Conexion();
        $conn->conectar();

       
     $result    = $conn->query("SELECT id, cid, title, notes, email, locationsc, remeber, fecha_registro, 
       estado, usuario, cliente_telefono, p.inicio::date as start, p.final::date as end,hinicio,hfinal,c.*
  FROM calendar.\"PROGRAMADO\" p, service.\"CLIENTE\" c WHERE p.id = $id AND c.clitel = p.cliente_telefono ");

        return $result;

        pg_close($conn);

    }

    public function asignarProgramadoToDespacho($pl, $data){

         $conn = new Conexion();

        $conn->conectar();

        $res = $conn->executePL($pl, $data);
	
        return $res;

        pg_close($conn);
    }
    


    
    
}
