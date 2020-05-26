
<?php


require '../Model/Caja_Menor.php';

if(isset($_GET['oper'])){

    if($_GET['oper'] != 0){


        $caja_menor = new Caja_Menor();

        $i = $_GET['oper'];

        switch ($i) {
    case $i == 1:

         echo json_encode($caja_menor->getConcetoCaja());

    break;

    case $i == 2:

        echo json_encode($caja_menor->saldoCajaActual());

    break;

    case $i == 3:
      # code...

       echo json_encode($caja_menor->getConcetoContable());

      break;


        }

    }

}
