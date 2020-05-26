<?php

$op = $_GET['oper'];

if($op != 1){

 $base1 = 'http://' . $_SERVER['SERVER_ADDR'].':8080/JasperPrint/webresources/print/';

$link = '<script>window.open("<?php echo $base1 ?>", "width=710,height=555,left=160,top=170")</script>';

}else{

 $serv = $_GET['serv'];

 $base2 = 'http://' . $_SERVER['SERVER_ADDR'].':8080/JasperPrint/webresources/imprimirServicio?serv='.$serv;

	$link = "<script>window.open('<?php echo $base2 ?>', 'width=710,height=555,left=160,top=170')</script>";
}

echo $link;

?>