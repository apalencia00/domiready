
<?php


require '../Model/Empleado.php';

if(isset($_GET['oper'])){
    
    if($_GET['oper'] != 0){
        

        $empleado = new Empleado();
        
        $i = $_GET['oper'];
        
        switch ($i) {
    case $i == 1: 
        
         echo json_encode($empleado->getTipoEmpleo());

    break;

     case $i == 2: 
        
        echo json_encode($empleado->cargarMobilDisponible());

    break;

    case $i == 3:

    $emp_mobil = $_GET['num_mobil'];
    $fliquida  = $_GET['fliquida'];

    echo json_encode(array(
        "success" => true,
        
        "root" => $empleado->cargarDatosEmpDespacho($emp_mobil,$fliquida)
        )

    );

    break;

      case $i == 4:

    $emp_mobil = $_GET['num_mobil'];
    $fliquida  = $_GET['fliquida'];

    echo json_encode(array(
        "success" => true,
        
        "root" => $empleado->cargarDatosEmpDespachoNorte($emp_mobil,$fliquida)
        )

    );

    break;

    case $i == 5:

         $mobil = $_GET['mobil'];

                echo json_encode(array("success" => true, "data" => $empleado->getBusquedaDespachoCriteriaTelefono($mobil)));

        # code...
        break;


        }

    }

}