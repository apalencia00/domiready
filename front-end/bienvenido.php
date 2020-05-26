
<?php 

error_reporting(E_ALL);

require_once '../backend/Model/Module.php';

session_start(); 

if( $_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "" || $_SESSION['admon_mod'] != null  )  {

      $usuario = $_SESSION['admon_mod'];
      $datos_mod = json_decode($usuario,true);
      
      $us = $datos_mod['id_usuario'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>DomiReady</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-notifications.css">
  <script src="js/jquery-1.9.1.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="bootstrap/css/docs.js" ></script>


  <script type="text/javascript">
    
    function callPaget(page){

        if(page != ""){
            
            window.frames[0].location.href = page;
        }
    }

    function CerrarSesion(){

      var r = confirm("¿Desea cerrar sesión?");
if (r == true) {
  
   $.ajax({ url: "../back-end/Source/CerrarSession.php", 
           type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: {}, 

              success: function(json){
           
           var res = json.success;                     
                  
           if(res){
              window.location = '../index.php';
           }else{
            alert(json.root[0].mensaje);
           }

         }

       });

} else {
    alert("Error al intentar cerrar sesión");
}

     

    }

  </script>

</head>
<body onload="" >

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        
 <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">

            <?php            

            $mod = new Modulo();
            
            foreach ($mod->getModule() as $v) {  ?>
                  <li class="dropdown">
               <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo $v['ID_MODULE'] ?>"> <?php echo $v['MODULOS'] ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">

                <?php
                 
                  foreach ($mod->getSubMenu($us,$v['ID_MODULE']) as $s) {  ?>
                 <li><a href="#" onclick="callPaget('<?php echo $s['mod'] ?>')" ><?php echo $s['MODULO']  ?></a></li> 

                 <?php } ?>


            

                </ul>
                </li>

             <?php }  ?>


           


         <ul class="nav navbar-nav navbar-right">
        
       

      

      <li><a href="#" onclick="CerrarSesion();" ><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
    </ul>
      </div>
    </div>
  </nav>


  
<div class="container">
  




</div>

<iframe frameborder="0" align="top" scrolling="no" width="100%" height="1000px" target="_parent" name="servicio" id="servicio" ></iframe>   

</body>

<script>
$(function(){
  $('.sw-aside').affix({
    offset: {
      top: $('.sw-header').outerHeight() - 45 // margin
    }
  })
})
</script>

<script>

$(function(){

  $("#actionmenu").click( function(){ //3042457504 -- cra74 n 81 92

    var className = $("#actionmenu").attr('class');

      if(className == 'dropdown dropdown-notifications' ){

      $("#actionmenu").removeClass('dropdown dropdown-notifications');
      $("#actionmenu").addClass('dropdown dropdown-notifications open');

    }else{

        $("#actionmenu").removeClass('dropdown dropdown-notifications open');
      $("#actionmenu").addClass('dropdown dropdown-notifications');


    }

      });

  });



  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-72436545-1', 'auto');
  ga('send', 'pageview');

</script>

</html>

<?php }
else{

header("Location: 500.php");

 unset($_SESSION['admon_mod']);
        
        // DESTROY COOKIE
        if (isset($_COOKIE['key'])) {
    unset($_COOKIE['key']);
    setcookie('key', '', time() - 3600, '/');

  }


} ?>