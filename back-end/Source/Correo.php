<?php


class Correo {

	public function comprobar_envio(){

			return;

	}

	public function enviar_correo($email,$obs,$recogida,$telefono, $nom, $ape, $dire, $fi, $ff){

$mail = "Hola $nom $ape ! gracias por utilizar el servicio de mandaos Express !. Nuestra base de datos registra que tiene un servicio programado para el dia $fi finalizando el dia $ff " ;
//Titulo
$titulo = "Servicios Mandaos Express";
//cabecera
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
//dirección del remitente 
$headers .= "From: Mandaos Express <mandaosexpress1@hotmail.com>\r\n";

//Enviamos el mensaje a tu_dirección_email 
$bool = mail($email,$titulo,$mail,$headers);

	return $bool;

}




		}



?>
