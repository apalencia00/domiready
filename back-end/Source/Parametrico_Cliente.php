
<?php



require '../Model/Cliente.php';

if(isset($_GET['oper'])){
    
    if($_GET['oper'] != 0){
        

        $cliente = new Cliente();
        
        $i = $_GET['oper'];
        
        switch ($i) {
    case $i == 1: 
        
         echo json_encode($cliente->getTipoID());

    break;

    case  $i == 2:
    	# code...

    $ide = $_GET['ide'];

    $tel = $_GET['tel'];

    $nom = $_GET['nom'];

    $ape = $_GET['ape'];

    $cel = $_GET['cel'];

    $nomb_completo = $_GET['comp'];

    if($cliente->getBusquedaClienteCriteria($ide, $tel, $nom, $ape,$cel, $nomb_completo) != null ) {

    	echo json_encode(array("success" =>true, "data" =>$cliente->getBusquedaClienteCriteria($ide, $tel, $nom, $ape,$cel, $nomb_completo)) );

    }else{
        echo json_encode(array("success" =>true,"data" =>""));
    }

    	break;

        case $i == 21:
            
            $tel = $_GET['telefono'];

                echo json_encode(array("success" => true, "data" => $cliente->getBusquedaClienteCriteriaTelefono($tel)));


            break;


            case $i == 4:
                # code...

                   $tel = $_GET['telefono'];

                echo json_encode(array("success" => true, "data" => $cliente->buscarDatosCliente($tel)));

                break;


                case $i == 5:

                echo json_encode(array("success" => true, "data" => $cliente->getLastId()));

                    # code...
                    break;


                    case $i == 6:
                        # code...

                    $tel = $_GET["tel"];
                    $nom = $_GET["nom"];

                    echo json_encode(array("success" => true, "root" => $cliente->buscarCLienteCriterias($tel, $nom)));

                        break;

                        case $i == 7:
                            # code...
                        $ident = $_GET["ident"];
                        $nomb =  $_GET["nomb"];
                        $ape  =  $_GET["ape"];
                        $dire =  $_GET["dire"];
                        $tel  =  $_GET["tel"];
                        $email=  $_GET["email"];
                        $compdire = $_GET["comp_dire"];
                        $celular = $_GET["celular"];

$data = array('ident' => $ident, 'clinom' => strtoupper($nomb), 'ape' => strtoupper($ape), 'dire' => $dire, 'tel' => $tel, 'email' => $email, 'compdire' => $compdire , 'celular' => $celular );

$res = $cliente->actualizarDatosCliente("service.fun_actualizar_cliente",$data);


break;


case $i == 8: 


$ident = $_GET["ident"];

  echo json_encode(array("success" => true, "data" => $cliente->buscarDatosClienteByIdentificacion($ident)));


break;

      

        }

    }

}
