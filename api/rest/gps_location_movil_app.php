<?php

require '../../vendor/autoload.php';

error_reporting(0);
session_start(); 


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$lat = $_POST['latitud'];
$lng = $_POST['longitud'];



$options = array(
    'cluster' => 'us2',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    'ee3dc23c8d4d2bb6cbd6',
    '9567a4eeba9f925a0700',
    '993913',
    $options
  );

  $data['message'] = array("latitud" => $lat, "longitud" => $lng);
  $pusher->trigger('my-ubication-channel', 'my-event-ubication', $data);


    if($lat != null || $lng != null ){
            
        http_response_code(200);
        echo json_encode(array(
            "latitud"   => $lat,
            "longitud"  => $lng
        ));

}
    else {
        http_response_code(404);
        echo json_encode(array("success"=> false , "data" =>"Datos no Encontrados"));
}
    //echo $result;


    pg_close($conn);

?>