<?php

require_once('../third-party/nusoap.php');
include('../ConexionBD/Conexion.php');

session_start();

$server = new soap_server();
$server->configureWSDL("despacho","urn:despacho");


$server->wsdl->schemaTargetNamespace = 'urn:despacho';

// PARAMETROS DE ENTRADA

$server->wsdl->addComplexType(
	'datos_entrada',
	'complexType',
	'struct',
	'all',
	'',
	array(

		'tipo_servicio'    => array('name' => 'tipo_servicio',     'type' => 'xsd:integer' ),
 		'num_servicio' => array('name' => 'num_servicio' , 'type' => 'xsd:string' ),
 		'n_ide' => array('name' => 'n_ide' , 'type' => 'xsd:integer' ),
 		't_pago' => array('name' => 't_pago' , 'type' => 'xsd:integer' ),
 		'total' => array('name' => 'total' , 'type' => 'xsd:string' ),
 		'p_comi' => array('name' => 'p_comi' , 'type' => 'xsd:integer' ),
 		'obs' => array('name' => 'obs' , 'type' => 'xsd:string' ),
 		'estado_serv' => array('name' => 'estado_serv' , 'type' => 'xsd:integer' ),
 		'usuario' => array('name' => 'num_servicio' , 'type' => 'xsd:integer' ),
 		'fk_empleado' => array('name' => 'fk_empleado' , 'type' => 'xsd:integer' ),
 		'estado_desp' => array('name' => 'estado_desp' , 'type' => 'xsd:integer' ),
 		'local_cn' => array('name' => 'local_cn' , 'type' => 'xsd:string' ),
 		'dir_proc' => array('name' => 'dir_proc' , 'type' => 'xsd:string' ),
 		'dir_dest' => array('name' => 'dir_dest' , 'type' => 'xsd:string' ),
 		'dir_rta1' => array('name' => 'dir_rta1' , 'type' => 'xsd:string' ),
 		'dir_rta2' => array('name' => 'dir_rta2' , 'type' => 'xsd:string' ),
 		'dir_rta3' => array('name' => 'dir_rta3' , 'type' => 'xsd:string' ),
 		'dir_rta4' => array('name' => 'dir_rta4' , 'type' => 'xsd:string' ),
 		'dir_rta5' => array('name' => 'dir_rta5' , 'type' => 'xsd:string' ),
 		'dir_rta6' => array('name' => 'dir_rta6' , 'type' => 'xsd:string' ),
 		'dir_rta7' => array('name' => 'dir_rta7' , 'type' => 'xsd:string' ),
 		'distancia' => array('name' => 'distancia' , 'type' => 'xsd:string' ),
 		'tiempo' => array('name' => 'tiempo' , 'type' => 'xsd:string' ),
 		'obs' => array('name' => 'obs' , 'type' => 'xsd:string' ),
        'comp_dire' => array('name' => 'comp_dire' , 'type' => 'xsd:string' ),
        'comp_diredest' => array('name' => 'comp_diredest' , 'type' => 'xsd:string' ),
        'regresa' => array('name' => 'regresa' , 'type' => 'xsd:string' )
		)

	);


// PARAMETROS DE SALIDA

$server->wsdl->addComplexType(
 'datos_salida',
 'complexType',
 'struct',
 'all',
 '',
 array(
 		'success' => array('name' => 'success', 'type' => 'xsd:string'),
 		'root' => array('name' => 'root' , 'type' => 'xsd:string' )
 	)

	);



$server->register(
	'registroDespacho',
	array( 'datos_entrada' => 'tns:datos_entrada' ),
	array( 'return' => 'tns:datos_salida' ),
	'urn:despacho',
	'urn:ingreso#registroDespacho',
	'rpc',
	'encoded',
	'Registro Despachos'
	);


// METODO DE CONSULTA DEL USUARIO ENTRANTE

function registroDespacho($datos){
      
   $bd = new Conexion();
//   
   $bd->conectar();

   $outArray = $bd->executePL('service.fun_reg_servicio',$datos);
   $salida = array( "success" => $outArray[0]['success'] , "root" => $outArray[0]['mensaje']);

   return $salida;

   pg_close($bd);


}



$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);


?> 