
<?php 

error_reporting(E_ALL);

require ('../back-end/Model/Module.php');

session_start(); 

if( $_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "" || $_SESSION['admon_mod'] != null  )  {

      $usuario = $_SESSION['admon_mod'];
      $datos_mod = json_decode($usuario,true);

      //var_dump($datos_mod);

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
<body onload="javascript:callPaget('<?php echo $datos_mod[20]["nombre"] ?>')" >

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <a onclick="callPaget('<?php echo $datos_mod[20]["nombre"] ?>')" class="navbar-brand" href="#"><?php echo $datos_mod[20]["descripcion"] ?></a>
      </div>

      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
         

          <li><a onclick="callPaget('<?php echo $datos_mod[1]["nombre"] ?>')" href="#">Consultas</a></li>


            <?php 

            

            $mod = new Module();


            foreach ($mod as $v) { ?>
                  
               <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo $v['MODULOS'] ?> <span class="caret"></span></a>
        <ul class="dropdown-menu">

             <?php }


            ?>

         
           <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Operacion <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#" onclick="callPaget('<?php echo $datos_mod[2]["nombre"] ?>')" ><?php echo $datos_mod[2]["descripcion"] ?></a></li> 
          <li><a href="#" onclick="callPaget('<?php echo $datos_mod[0]["nombre"] ?>')" ><?php echo $datos_mod[0]["descripcion"] ?></a></li> 
          <li><a href="#" onclick="callPaget('<?php echo $datos_mod[3]["nombre"] ?>')" ><?php echo $datos_mod[3]["descripcion"] ?></a></li>
          <li><a href="#" onclick="callPaget('<?php echo $datos_mod[19]["nombre"] ?>')" ><?php echo $datos_mod[19]["descripcion"] ?></a></li>
        <li class="" > <a href="#" onclick="callPaget('<?php echo $datos_mod[5]["nombre"] ?>')" ><?php echo $datos_mod[5]["descripcion"] ?></a> </li>
           
        </ul>
      </li>

      <!--

          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Empleado <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#" onclick="callPaget('<?php echo $datos_mod[7]["nombre"] ?>')" ><?php echo $datos_mod[7]["descripcion"] ?></a></li> 
          <li><a href="#" onclick="callPaget('<?php echo $datos_mod[17]["nombre"] ?>')" ><?php echo $datos_mod[17]["descripcion"] ?></a></li>
          
        </ul>
      </li>

      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Cliente <span class="caret"></span></a>
        <ul class="dropdown-menu">
      <li><a href="#" onclick="callPaget('<?php echo $datos_mod[6]["nombre"] ?>')"><?php echo $datos_mod[6]["descripcion"] ?></a></li> 
      <li><a href="#" onclick="callPaget('<?php echo $datos_mod[21]["nombre"] ?>')"><?php echo $datos_mod[21]["descripcion"] ?></a></li>
          
        </ul>
      </li>

       


        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Liquidacion <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#" onclick="callPaget('<?php echo $datos_mod[4]["nombre"] ?>')" ><?php echo $datos_mod[4]["descripcion"] ?></a></li> 
          <li><a href="#" onclick="callPaget('<?php echo $datos_mod[11]["nombre"] ?>')" ><?php echo $datos_mod[11]["descripcion"] ?></a></li>
          
        </ul>
      </li>

       <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Caja  <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#" onclick="callPaget('<?php echo $datos_mod[8]["nombre"] ?>')" ><?php echo $datos_mod[8]["descripcion"] ?></a></li> 
          <li><a href="#" onclick="callPaget('<?php echo $datos_mod[10]["nombre"] ?>')" ><?php echo $datos_mod[10]["descripcion"] ?></a></li>
           <li><a href="#" onclick="callPaget('<?php echo $datos_mod[13]["nombre"] ?>')" ><?php echo $datos_mod[13]["descripcion"] ?></a></li>

            <li><a href="#" onclick="callPaget('<?php echo $datos_mod[14]["nombre"] ?>')" ><?php echo $datos_mod[14]["descripcion"] ?></a></li>
          
        </ul>
      </li>

      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Ahorro <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#" onclick="callPaget('<?php echo $datos_mod[9]["nombre"] ?>')" ><?php echo $datos_mod[9]["descripcion"] ?></a></li> 
          <li><a href="#" onclick="callPaget('<?php echo $datos_mod[15]["nombre"] ?>')" ><?php echo $datos_mod[15]["descripcion"] ?></a></li>
           <li><a href="#" onclick="callPaget('<?php echo $datos_mod[18]["nombre"] ?>')" ><?php echo $datos_mod[18]["descripcion"] ?></a></li>

            <li><a href="#" onclick="callPaget('<?php echo $datos_mod[16]["nombre"] ?>')" ><?php echo $datos_mod[16]["descripcion"] ?></a></li>
          
        </ul>
      </li>


        </ul>

        -->

         <ul class="nav navbar-nav navbar-right">
        
        <li id="actionmenu" class="dropdown dropdown-notifications">
            <a href="#notifications-panel" class="dropdown-toggle">
              <i data-count="3" class="glyphicon glyphicon-bell notification-icon"></i>
            </a>

            <div class="dropdown-container">

              <div class="dropdown-toolbar">
                <div class="dropdown-toolbar-actions">
                  <a href="#">Mark all as read</a>
                </div>
                <h3 class="dropdown-toolbar-title">Notifications (3)</h3>
              </div><!-- /dropdown-toolbar -->

              <ul class="dropdown-menu">
                    <li class="notification">
                      <div class="media">
                        <div class="media-left">
                          <div class="media-object">
                            <img data-src="holder.js/50x50?bg=cccccc" class="img-circle" alt="Name" />
                          </div>
                        </div>
                        <div class="media-body">
                          <strong class="notification-title"><a href="#">Dave Lister</a> commented on <a href="#">DWARF-13 - Maintenance</a></strong>
                          <p class="notification-desc">I totally don't wanna do it. Rimmer can do it.</p>

                          <div class="notification-meta">
                            <small class="timestamp">27. 11. 2015, 15:00</small>
                          </div>
                        </div>
                      </div>
                  </li>

                  <li class="notification active">
                      <div class="media">
                        <div class="media-left">
                          <div class="media-object">
                            <img data-src="holder.js/50x50?bg=cccccc" class="img-circle" alt="Name" />
                          </div>
                        </div>
                        <div class="media-body">
                          <strong class="notification-title"><a href="#">Nikola Tesla</a> resolved <a href="#">T-14 - Awesome stuff</a></strong>

                          <p class="notification-desc">Resolution: Fixed, Work log: 4h</p>

                          <div class="notification-meta">
                            <small class="timestamp">27. 10. 2015, 08:00</small>
                          </div>

                        </div>
                      </div>
                  </li>

                  <li class="notification">
                      <div class="media">
                        <div class="media-left">
                          <div class="media-object">
                            <img data-src="holder.js/50x50?bg=cccccc" class="img-circle" alt="Name" />
                          </div>
                        </div>
                        <div class="media-body">
                          <strong class="notification-title"><a href="#">James Bond</a> resolved <a href="#">B-007 - Desolve Spectre organization</a></strong>

                          <div class="notification-meta">
                            <small class="timestamp">1. 9. 2015, 08:00</small>
                          </div>

                        </div>
                      </div>
                  </li>

              </ul>

              <div class="dropdown-footer text-center">
                <a href="#">View All</a>
              </div><!-- /dropdown-footer -->

            </div><!-- /dropdown-container -->
          </li><!-- /dropdown -->

      

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