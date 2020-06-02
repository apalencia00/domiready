<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../ConexionBD/Conexion.php';

class Caja_Menor {


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

     $result    = $conn->query("SELECT * FROM service.\"CONCEPTO_CAJA\" WHERE estado = 'A'  ORDER BY 1");

     return $result;

     pg_close($conn);


    }

    public function saldoCajaActual(){

             $conn = new Conexion();

        $conn->conectar();

     $result    = $conn->executeView('SELECT saldo_caja_menor FROM service."CAJA_MENOR" c  ORDER BY id_caja_menor DESC limit 1');

        return $result;

        pg_close($conn);

    }

    public function regCajaMenorNorte($pl,$data){

         $conn = new Conexion();

        $conn->conectar();

       $result = $conn->executePL($pl, $data);


       return $result;

       pg_close($conn);


    }

    public function listarCajaMenorCentro($fi, $ff, $p){

           $conn = new Conexion();
        $sql = '';
        $conn->conectar();

        if($p == 0 || $p == "0"){
                $sql = 'c.tipo in (11,99,200)';
        }else{
            $sql = 'c.tipo::integer ='. $p ;
        }


     $result    = $conn->query("SELECT cc.descripcion as concepto, c.descripcion as detalle, c.fecha_sys, c.valor, c.saldo_caja_menor, e.num_mob FROM service.\"CAJA_MENOR\" c, service.\"CONCEPTO_CAJA\" cc, service.\"EMPLEADO\" e WHERE fecha_sys::date BETWEEN '$fi'::date AND '$ff'::date AND c.tipo = cc.id_concepto_caja AND $sql AND c.fk_empleado = e.n_ide ORDER BY id_caja_menor DESC");

        return $result;

        pg_close($conn);


    }

     public function listarCajaMenorNorte($fi, $ff,$p){

        $conn = new Conexion();
        $sql = '';
        $conn->conectar();

        if($p == 0 || $p == "0"){
                $sql = 'c.tipo in (11,99,200)';
        }else{
            $sql = 'c.tipo::integer ='. $p ;
        }



     $result    = $conn->query("SELECT cc.descripcion as concepto, c.descripcion as detalle, c.fecha_sys, c.valor, c.saldo_caja_actual, e.num_mob FROM service_norte.\"CAJA_MENORN\" c, service.\"CONCEPTO_CAJA\" cc, service.\"EMPLEADO\" e WHERE fecha_sys::date BETWEEN '$fi'::date AND '$ff'::date AND c.tipo = cc.id_concepto_caja AND c.fk_empleado = e.n_ide AND $sql ORDER BY id_caja_menor DESC");

        return $result;

        pg_close($conn);
    }




}
