<?php

#phpinfo();

 $server     = "18.191.168.53" ;
 $database   = "domiready_db" ;
  $username  = "domiready_u" ;
  $password  = "/*-domiready_pw";

$stringConnection="host=".$this->server." dbname=".$this->database." user=".$user." password=".$pass;
$this->connection = pg_connect($stringConnection)
or die('No es posible la conexion: ' . pg_last_error());

echo "Si conecto a postres";


exit(0);



?>

<!DOCTYPE html>
<html>
<head>
    <title>Domicilios Ready</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" >
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="front-end/js/login_bootstrap.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    
</head>
</head>
<body>

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<div class="main">
    
    
    <div class="container">
<center>
<div class="middle">
      <div id="login">

        <form id="login-form">

          <fieldset class="clearfix">

            <p ><span class="fa fa-user"></span><input type="text" value="domiready_u" id="login_username" Placeholder="Username" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
            <p><span class="fa fa-lock"></span><input type="password" value="/*-domiready_pw" id="login_password"  Placeholder="Password" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
            
             <div>
                                <span style="width:48%; text-align:left; color:#fff;  display: inline-block;"><a class="small-text; color:#fff" href="#"> Olvido Clave ?</a></span>
                                <span style="width:50%;  ;text-align:right;  display: inline-block;"><input type="submit" value="Ingresar"></span>
                            </div>

          </fieldset>
<div class="clearfix"></div>
        </form>

        <div class="clearfix"></div>

      </div> <!-- end login -->
        <div class="logo"> <img style="height: 300px;width: 500px; " src="front-end/images/ready.png" />
          
          <div class="clearfix"></div>
      </div>
      
      </div>
</center>
    </div>

</div>
       
</body>
</html>