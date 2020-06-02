<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/domiready/back-end/ConexionBD/Conexion.php');

class Cliente {
    
    
    public function __construct() {
        
    }

    public function getTipoID(){

    	$conn = new Conexion();

    	$conn->conectar();

     $result 	= $conn->sql('service."TIPO_DOC"' , '*');

     return $result;

     pg_close($conn);


    }

 
    
    public function regCliente($pl,$data){

        $conn = new Conexion();

        $conn->conectar();

        $res = $conn->executePL($pl, $data);

        return $res;

        pg_close($conn);

        
    }

    public function eliminarCliente(){

    	
    }

    public function getNameCliente($name){

         $conn = new Conexion();

        $conn->conectar();

      $result =  $conn->query("SELECT clinom FROM service.\"CLIENTE\" WHERE clinom LIKE upper('$name%')");

            
      return $result;

      pg_close($conn);



    }


     public function getLastNameCliente($name){

         $conn = new Conexion();

        $conn->conectar();

      $result =  $conn->query("SELECT cliapell FROM service.\"CLIENTE\" WHERE cliapell LIKE upper('%$name%')");

      //json_encode($result);

      return $result;

      pg_close($conn);

    }

    public function getBusquedaClienteCriteria($ide, $tel, $nom, $ape,$cel, $comp){

      $byCriteria = "";

       $conn = new Conexion();

        $conn->conectar();

        if($ide !== ""){

        $byCriteria = "n_ide = $ide";

      }

      if($nom !== ""){
        $byCriteria = "clinom LIKE  '%$nom%'";
      }

      if($tel !== ""){
        $byCriteria = "clitel =  '$tel' OR clicel = '$tel'  ORDER BY n_ide DESC  LIMIT 1 ";
      }

      if($ape !== ""){
        $byCriteria = "cliapell LIKE '%$ape%'";
      }

       if($cel !== ""){
        $byCriteria = "clicel = '$cel'";
      }

      if($comp !== ""){



        $byCriteria = "nomb_completo LIKE '%$comp%'";
      }


      $result =  $conn->query("SELECT n_ide, clinom, cliapell ,clitel, clicel,clidire,comp_dire,clicorreo,nomb_completo
        FROM service.\"CLIENTE\" WHERE $byCriteria ");

     // var_dump("SELECT n_ide, clinom, cliapell ,clitel, clicel FROM service.\"CLIENTE\" WHERE $byCriteria");

      return $result;

      pg_close($conn);


    }

    public function buscarNombreCliente($name){

         $conn = new Conexion();

        $conn->conectar();

      $result =  $conn->query("SELECT clinom,cliapell FROM service.\"CLIENTE\" WHERE cliapell LIKE upper('%$name%') ORDER BY clinom ASC LIMIT 10");

      //json_encode($result);

      return $result;

      pg_close($conn);

    }

    public function getClienteByTelefono($tel){

       $conn = new Conexion();

        $conn->conectar();

      $result =  $conn->query("SELECT clinom,cliapell FROM service.\"CLIENTE\" WHERE clitel = '$tel'  ORDER BY clinom ASC LIMIT 10");

      pg_close($conn);


    }

    public function getBusquedaClienteCriteriaTelefono($tel){

         $conn = new Conexion();

        $conn->conectar();

      $result =  $conn->query("SELECT s.num_servicio, s.fecha_serv, c.clinom || ' ' || c.cliapell as nombre_completo, s.total, e.num_mob, s.estado_serv, ed.descripcion
            FROM service.\"SERVICIO\" s, service.\"CLIENTE\" c, service.\"DESPACHO\" d, service.\"EMPLEADO\" e,service.\"ESTADO_DESPACHO\" ed 
            WHERE ed.id_estado_desp = d.estado_desp  AND s.n_ide = c.n_ide AND s.num_servicio = d.num_servicio AND c.clitel = '$tel'::text AND d.fk_empleado = e.n_ide");


      return $result;

      pg_close($conn);

    }


    public function buscarDatosCliente($tel){

      $conn = new Conexion();

        $conn->conectar();

      $result =  $conn->query("SELECT * FROM service.\"CLIENTE\" WHERE clitel = '$tel' LIMIT 1 ");

      return $result;


    }

    public function getLastId(){

      $conn = new Conexion();

        $conn->conectar();

      $result =  $conn->query("SELECT id_cliente FROM service.\"CLIENTE\" ORDER BY id_cliente DESC LIMIT 1; ");

      return $result;

      pg_close($conn);


    }

    public function buscarCLienteCriterias($tel, $nom){


      $conn = new Conexion();

        $conn->conectar();

        if($tel != ""){

          $sql = "clitel = '$tel' ";

        }else{

          $sql = " nomb_completo like upper('%$nom%') ";

        }

        
      $result =  $conn->query("SELECT * FROM service.\"CLIENTE\" WHERE $sql ");

      return $result;

      pg_close($conn);



    }

    public function actualizarDatosCliente($pl,$data){


      $conn = new Conexion();

        $conn->conectar();

        $res = $conn->executePL($pl, $data);

        return $res;

        pg_close($conn);

    }

public function buscarDatosClienteByIdentificacion($id){

      $conn = new Conexion();

        $conn->conectar();

              
      $result =  $conn->query("SELECT * FROM service.\"CLIENTE\" WHERE n_ide = $id ");

      return $result;

      pg_close($conn);


    }
    
    
    
}
