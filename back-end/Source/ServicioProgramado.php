<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL);

require '../Model/ServicioProgramado.php';
include 'Correo.php';

$permisos = $_SESSION['admon_mod'];
$datos_mod = json_decode($permisos,true);

$usuario = $datos_mod["usuadoc"];

$crud_ServicioProgramado = new ServicioProgramado();

$param = $_GET["oper"];

$telefono = $_GET["telefono"];
$nombre   = $_GET["nombre"];
$apellido = $_GET["apellido"];
$titulo   = $_GET["titulo"]; 
$finicial = $_GET["finicial"];
$ffinal   = $_GET["ffinal"];
$horai    = $_GET["hinicial"];
$horaf    = $_GET["hfinal"];
$obs      = $_GET["obs"];     

$recogida = $_GET["recogida"]; 
$entrega  = $_GET["entrega"];
$recordar = $_GET["recordar"];  
$correoemail   = $_GET["correo"]; 

if($param == 1){

	echo json_encode($crud_ServicioProgramado->getProgramado() 
          );


}

if($param == 2){


$arrayObj = array(
	"cid" => 1,
	"title" => $titulo,
	"finicio" => $finicial,
	"hinicio" => $horai,
	"ffinal" => $ffinal,
	"hfinal" => $horaf,
	"notes" => $obs,
	"email" => $correoemail,
	"locationsc" => $recogida,
	"remeber" => $entrega,
	"usuario" => $usuario,
	"param" => 1,
"telefono" => $telefono
 );


$result = $crud_ServicioProgramado->regServProgramado("calendar.fun_reg_servicio_programado",$arrayObj);

if($result[0]["success"]){

	$correo = new Correo();

	$flag = $correo->enviar_correo($correoemail,$obs,$recogida,$telefono, $nombre, $apellido, $direccion, $finicial, $ffinal);

	if($flag){

		echo json_encode(array('success' => true , 'msg' => 'Servicio Programado exitosamente' ));

	}else{

		echo json_encode(array('success' => false , 'msg' => 'Servicio Programado exitosamente, pero no se pudo enviar correo electronico' ));


	}

}


}


if($param == 4){

	$events = $crud_ServicioProgramado->listarProgramado();
	$datos = array();

		foreach ($events as $key => $value) {
		
	array_push($datos, array("id" => $events[$key]["id"], 
						   "title" => $events[$key]["title"],
    					   "start" =>$events[$key]["start"]."T".$events[$key]["hinicio"], 
    					   "end" => $events[$key]["end"]."T".$events[$key]["hfinal"]
    					
    					   ) );
    


		}

		echo json_encode($datos); 



}

if($param == 5){

	$id = $_GET["idecal"];

	$res = $crud_ServicioProgramado->listarProgramadoPorId($id);
	echo json_encode($res);
}

if($param == 6){

	$ident = $_GET["ident"];
	$nomb = $_GET["nomb"];
	$tele = $_GET["tele"];
	$dirini = $_GET["dirini"];
	$dirdest = $_GET["dirdest"];
	$obs = $_GET["obs"];


	$data = array("id" => $ident,  "dirini" => $dirini, "dirdest" => $dirdest, "obs" => $obs, "usuarioin" => $usuario, "tele" => $tele );

	$res = $crud_ServicioProgramado->asignarProgramadoToDespacho('calendar.fun_actualizar_programado_despacho',$data);
}




