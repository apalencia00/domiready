
<?php


require '../Model/Caja_MenorNorte.php';

if(isset($_GET['oper'])){

    if($_GET['oper'] != 0){


        $caja_menorNorte = new Caja_MenorNorte();

        $i = $_GET['oper'];

        switch ($i) {
    case $i == 1:

         echo json_encode($caja_menorNorte->getConcetoCaja());

    break;

    case $i == 5:

        echo json_encode($caja_menorNorte->saldoCajaActual());

    break;


    case $i == 3:
      # code...

       echo json_encode($caja_menorNorte->getConcetoContable());

      break;

        }

    }

}
