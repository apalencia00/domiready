<?php

$cadena = explode("/",$_SERVER["DOCUMENT_ROOT"]  );

if ($cadena[3] == "domiready") {
    require_once($_SERVER["DOCUMENT_ROOT"] . '/back-end/ConexionBD/Conexion.php');
}
else{
    require_once($_SERVER["DOCUMENT_ROOT"].'/domiready' . '/back-end/ConexionBD/Conexion.php');
}


class Caja_MenorNorte {


    public function __construct() {

    }

    public function getTipoID(){

    	$conn = new Conexion();

    	$conn->conectar();

     $result 	= $conn->sql('service."TIPO_DOC"' , '*');

     return $result;

     pg_close($conn);


    }

    public function validarCaja($pl,$data){

        $conn = new Conexion();

        $conn->conectar();

       $result = $conn->executePL($pl, $data);


       return $result;

       pg_close($conn);

    }

    public function regCajaMenor($pl,$data){

        $conn = new Conexion();

        $conn->conectar();

       $result = $conn->executePL($pl, $data);


       return $result;

       pg_close($conn);

    }



    public function actualizarCajaMenor(){


    }

    public function getConcetoCaja(){

        $conn = new Conexion();

        $conn->conectar();

     $result    = $conn->query('SELECT * FROM service."CONCEPTO_CAJA" WHERE id_concepto_caja in(0,11,200) ORDER BY 1');

     return $result;

     pg_close($conn);


    }

    public function getConcetoContable(){

        $conn = new Conexion();

        $conn->conectar();

     $result    = $conn->query("SELECT * FROM service.\"CONCEPTO_CAJA\" WHERE id_concepto_caja not in (0,11,200) AND WHERE estado = 'A' ORDER BY 1");

     return $result;

     pg_close($conn);


    }

    public function saldoCajaActual(){

             $conn = new Conexion();

        $conn->conectar();

     $result    = $conn->executeView('SELECT saldo_caja_actual FROM service_norte."CAJA_MENORN" c  ORDER BY id_caja_menor DESC limit 1');

        return $result;

        pg_close($conn);

    }








}
