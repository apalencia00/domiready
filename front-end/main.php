
<?php 



error_reporting(0);

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/back-end/ConexionBD/Conexion.php');


session_start(); 



if( $_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "" || $_SESSION['admon_mod'] != null  )  {

      $usuario = $_SESSION['admon_mod'];
      #var_dump($usuario[0]["id_usuario"]); 
      #$datos_mod = json_decode($usuario,true);
    
      $us = intval($usuario[0]["id_usuario"]);
      #var_dump($us);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>DomiReady</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <style>

.full {
    width: 100%;  
}
.gap {
  height: 30px;
  width: 100%;
  clear: both;
  display: block;
}
.footer {
  background: #EDEFF1;
  height: auto;
  padding-bottom: 30px;
  position: relative;
  width: 100%;
  border-bottom: 1px solid #CCCCCC;
  border-top: 1px solid #DDDDDD;
}
.footer p {
  margin: 0;
}
.footer img {
  max-width: 100%;
}
.footer h3 {
  border-bottom: 1px solid #BAC1C8;
  color: #54697E;
  font-size: 18px;
  font-weight: 600;
  line-height: 27px;
  padding: 40px 0 10px;
  text-transform: uppercase;
}
.footer ul {
  font-size: 13px;
  list-style-type: none;
  margin-left: 0;
  padding-left: 0;
  margin-top: 15px;
  color: #7F8C8D;
}
.footer ul li a {
  padding: 0 0 5px 0;
  display: block;
}
.footer a {
  color: #78828D
}
.supportLi h4 {
  font-size: 20px;
  font-weight: lighter;
  line-height: normal;
  margin-bottom: 0 !important;
  padding-bottom: 0;
}
.newsletter-box input#appendedInputButton {
  background: #FFFFFF;
  display: inline-block;
  
  height: 30px;
  clear: both;
  width: 100%;
}
.newsletter-box .btn {
  border: medium none;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  -o-border-radius: 3px;
  -ms-border-radius: 3px;
  border-radius: 3px;
  display: inline-block;
  height: 40px;
  padding: 0;
  width: 100%;
  color: #fff;
}
.newsletter-box {
  overflow: hidden;
}
.bg-gray {
  background-image: -moz-linear-gradient(center bottom, #BBBBBB 0%, #F0F0F0 100%);
  box-shadow: 0 1px 0 #B4B3B3;
}
.social li {
  background: none repeat scroll 0 0 #B5B5B5;
  border: 2px solid #B5B5B5;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  -o-border-radius: 50%;
  -ms-border-radius: 50%;
  border-radius: 50%;
  float: left;
  height: 36px;
  line-height: 36px;
  margin: 0 8px 0 0;
  padding: 0;
  text-align: center;
  width: 36px;
  transition: all 0.5s ease 0s;
  -moz-transition: all 0.5s ease 0s;
  -webkit-transition: all 0.5s ease 0s;
  -ms-transition: all 0.5s ease 0s;
  -o-transition: all 0.5s ease 0s;
}
.social li:hover {
  transform: scale(1.15) rotate(360deg);
  -webkit-transform: scale(1.1) rotate(360deg);
  -moz-transform: scale(1.1) rotate(360deg);
  -ms-transform: scale(1.1) rotate(360deg);
  -o-transform: scale(1.1) rotate(360deg);
}
.social li a {
  color: #EDEFF1;
}
.social li:hover {
  border: 2px solid #2c3e50;
  background: #2c3e50;
}
.social li a i {
  font-size: 16px;
  margin: 0 0 0 5px;
  color: #EDEFF1 !important;
}
.footer-bottom {
  background: #E3E3E3;
  border-top: 1px solid #DDDDDD;
  padding-top: 10px;
  padding-bottom: 10px;
}
.footer-bottom p.pull-left {
  padding-top: 6px;
}
.payments {
  font-size: 1.5em; 
}


/*
*
* ==========================================
* FOR DEMO PURPOSES
* ==========================================
*
*/

body {
background: #F5F4F4; 
}

.rounded-lg {
border-radius: 1rem;
}

.nav-pills .nav-link {
color: #555;
}

.nav-pills .nav-link.active {
color: #fff;
}


  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }

    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }


</style>

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

      <style type="text/css">

          .responsive-iframe {

            position: absolute;
            
            left: 20px;
            bottom: 20px;
            padding-right: 2px;
            right: 2px;
            width: 98%;
            height: 80%;

          }


    </style>
<!-- <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
 -->

  <script type="text/javascript">
    
    function callPaget(page){

        if(page != ""){
            
            $("#content").load(page);
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
<body onload="javascript:callPaget('<?php echo "Ecomerce_cliente.php" ?>')" >

        <div class="container-fluid"> <br>

              <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                <!-- Brand -->
                  <a class="navbar-brand" href="#"><img style="height: 60px;width: 55px; " src="images/ready.png" /></a>

                <!-- Links -->
                          <ul class="navbar-nav">


                                        <?php

                                                $mod = new Modulo();

                                                foreach ($mod->getModule() as $v) {  ?>

                                                      <li class="nav-item dropdown">

                                                            <a class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown" href="<?php echo $v['ID_MODULE'] ?>"> <?php echo $v['MODULOS'] ?> <span class="caret"></span></a>
                                                        
                                                                    <div class="dropdown-menu">

                                                                            <?php

                                                                              foreach ($mod->getSubMenu($us,$v['ID_MODULE']) as $s) {  ?>

                                                                                  <a class="dropdown-item" href="#" onclick="callPaget('<?php echo $s['mod'] ?>')" ><?php echo $s['MODULO']  ?></a>

                                                                            <?php } ?>

                                                                    </div>

                                                            

                                                      </li>

                                                <?php }  ?>


                          </ul>
              </nav>


                  <div >

                    <div frameborder="0" class="responsive-iframe" id="content" ></div>

                  </div>

        </div>



  
                 
  


</body>


</html>

<?php 


                                          }else{

                                                  header("Location: 500.php");

                                                  unset($_SESSION['admon_mod']);
                                                          
                                                          // DESTROY COOKIE
                                                          if (isset($_COOKIE['key'])) {
                                                      unset($_COOKIE['key']);
                                                      setcookie('key', '', time() - 3600, '/');

                                                    }


                                                 } ?>