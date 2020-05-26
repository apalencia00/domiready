<?php
// Connecting, selecting database
   

$numero = $_GET['numero'];
$post['to'] = array($numero); 
$tipo = $_GET['tipo'];   
if ($tipo=='1'){
$post['text'] = "Tu Domicilio ha sido agendado! Gracias por preferirnos. Mandaos Call Center 3411111, Ahora puedes agendar tu domi en linea: http://www.mandaos.co"; 
}
else{
$post['text'] = "Registrado exitosamente en Mandaos! Gracias por preferirnos. Mandaos Call Center 3411111, Ahora puedes agendar tu domi en linea: http://www.mandaos.co"; 

}

//$post['to'] = array('573004642098'); 
//$post['text'] = "Tu Domicilio ha sido agendado correctamente! Gracias por preferirnos :) Callcenter 3411111 http://www.mandaos.co"; 
$post['from'] = "Mandaos"; 
$user ="mandaos"; 
$password = 'mandaos'; 
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL,            
"https://gateway.plusmms.net/rest/message"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_POST,           1); 
curl_setopt($ch, CURLOPT_HEADER,          1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post)); 
curl_setopt($ch, CURLOPT_HTTPHEADER,     array( 
    "Accept: application/json", 
    "Authorization: Basic ".base64_encode($user.":"
.$password) 
)); 
$result = curl_exec ($ch); 

echo json_encode($result);

?>