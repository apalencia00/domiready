 <?php

require '../Model/Cliente.php';

session_start();

if($_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "")  {

$permisos = $_SESSION['admon_mod'];
$datos_mod = json_decode($permisos,true);

$usuario = $datos_mod["usuadoc"];

try{

$name =  $_GET['term'];


$bd_host = "localhost"; 
$bd_usuario = "apalencia"; 
$bd_password = "apalencia"; 
$bd_base = "mandaos_db"; 

$nombre = $_GET['q'];

        $stringConnection="host=".$bd_host." dbname=".$bd_base." user=".$bd_usuario." password=".$bd_password;
        $con = pg_connect($stringConnection)
        or die('No es posible la conexion: ' . pg_last_error());

$result = pg_query($con,"SELECT clinom || ' ' || cliapell as nomb_completo FROM service.\"CLIENTE\" WHERE cliapell LIKE upper('%$nombre%') ORDER BY clinom ASC LIMIT 10");        
        
        if($result) {
           
           $i = 0;
               while( $arr  = pg_fetch_assoc($result) ){


                $i++;
            //    for($i = 0; $i < count($arr); $i++) {

               //     $row_set [] = $arr[$i]['nomb_completo'];

                  echo $arr['nomb_completo']."\n";

                }
                    
                    

        } else {
            echo json_encode(array(
                "success" => false,
                "data" => $this->getSQLError()
                ));
        }



}catch (Exception $ex) {
      echo json_encode(array(
         "success" => false, 
                "data" => $ex->getMessage()
            )
        );
      
        unset($_SESSION['cod_usu']);
        
        // DESTROY COOKIE
        if (isset($_COOKIE['key'])) {
    unset($_COOKIE['key']);
    setcookie('key', '', time() - 3600, '/'); // empty value and old timestamp
}

}

}else{

header("Location: ../View/404.php");

 unset($_SESSION['cod_usu']);
        
        // DESTROY COOKIE
        if (isset($_COOKIE['key'])) {
    unset($_COOKIE['key']);
    setcookie('key', '', time() - 3600, '/');

}

}

