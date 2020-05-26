<?php

require_once('../third-party/nusoap.php');
include('../ConexionBD/Conexion.php');

session_start();

$server = new soap_server();
$server->configureWSDL("login","urn:login");


$server->wsdl->schemaTargetNamespace = 'urn:login';

// PARAMETROS DE ENTRADA

$server->wsdl->addComplexType(
	'datos_entrada',
	'complexType',
	'struct',
	'all',
	'',
	array(

		'usuario'    => array('name' => 'usuario',     'type' => 'xsd:string' ),
 		'contrasena' => array('name' => 'contrasena' , 'type' => 'xsd:string' )

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
 		'usuariodoc' => array('name' => 'usuariodoc', 'type' => 'xsd:string'),
 		'permisos' => array('name' => 'permisos' , 'type' => 'xsd:string' )
 	)

	);



$server->register(
	'onLogin',
	array( 'datos_entrada' => 'tns:datos_entrada' ),
	array( 'return' => 'tns:datos_salida' ),
	'urn:login',
	'urn:ingreso#onLogin',
	'rpc',
	'encoded',
	'consulta id usuario en session'
	);


// METODO DE CONSULTA DEL USUARIO ENTRANTE

function onLogin($datos){
    
    $_SESSION['un'] = $datos['usuario'];
    $_SESSION['pw'] = $datos['contrasena'];

    $usuario_con = $datos['usuario'];
    
   $bd = new Conexion();
//   
   $bd->conectar();

   $usuario_db = $bd->query("SELECT usuadoc, permisos FROM autentication.\"USUARIO\" WHERE usuanom = '$usuario_con' ");
   $outArray = array( "usuariodoc" => $usuario_db[0]['usuadoc'] , "permisos" => $usuario_db[0]['permisos']);

   ///var_dump($outArray);

   return $outArray;


}


$server->register("logout",
array("id_user" => "xsd:string"),
array("return" => "xsd:string"),
"urn:login",
"urn:login#logout",
"rpc",
"encoded",
"Metodo que cierra session usuario"
	);

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);


?> 