 <?php

require '../Model/Cliente.php';

session_start();

if($_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "")  {

$permisos = $_SESSION['admon_mod'];

try{

    $bd_host = "localhost"; 
$bd_usuario = "apalencia"; 
$bd_password = "apalencia"; 
$bd_base = "mandaos_db"; 

$_GET['term'];
 $return_arr = array();

$conn = new PDO("pgsql:dbname=$bd_base;host=$bd_host", $bd_usuario, $bd_password); 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("SELECT n_ide FROM service.\"CLIENTE\" WHERE nomb_completo LIKE upper(:term) ORDER BY clinom ASC LIMIT 20");
        $stmt->execute(array('term' => '%'.$_GET['term'].'%'));

          while($row = $stmt->fetch()) {
            $return_arr[] =  $row['n_ide'];
        }

    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }


    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);

      
}else{

header("Location: ../View/404.php");

 unset($_SESSION['admon_mod']);
        
        // DESTROY COOKIE
        if (isset($_COOKIE['key'])) {
    unset($_COOKIE['key']);
    setcookie('key', '', time() - 3600, '/');

}

}

