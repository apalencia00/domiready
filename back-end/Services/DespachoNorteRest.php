<?php

require_once('../third-party/nusoap.php');
require_once('../Source/DespachoNorteRest.php');



$server = new soap_server();
$server->configureWSDL("despachosn","urn:despachosn");

$server->register("despachosNorte",
array("num_serv" =>"xsd:string", "repartidorn" => "xsd:string"),
array("return" => "xsd:array"),
"urn:despachosn",
"urn:despachosn#despachosNorte",
"rpc",
"encoded",
"Metodo registrar y despacha servicio en norte"
	);

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);


?> 