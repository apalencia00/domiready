
<?php 

require '../vendor/autoload.php';

// llamos a al websocket  para visualizar todas las motos

$options = array(
    'cluster' => 'us2',
    'useTLS' => true
  );

$pusher = new Pusher\Pusher(
    'ee3dc23c8d4d2bb6cbd6',
    '9567a4eeba9f925a0700',
    '993913',
    $options
  );

  $data['message'] = 'call-motos';
  $pusher->trigger('channel-all-ubication', 'event-all-ubication', $data);


?>

<!DOCTYPE html>
<html>
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    
	<style> 

/*
*
* ==========================================
* FOR DEMO PURPOSES
* ==========================================
*
*/

body {
background: #f5f5f5;
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



  	#map {
        height: 100%;
        }
     
        html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        }
    </style> 
    
    <link href="../vendor/twitter/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link  href="css/bootstrap.scss" /> 

</head>  

    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>

        <script>

                // Enable pusher logging - don't include this in production
                Pusher.logToConsole = true;

                var pusher = new Pusher('ee3dc23c8d4d2bb6cbd6', {
                cluster: 'us2'
                });

                var channel = pusher.subscribe('my-ubication-channel');

                channel.bind('my-event-ubication', function(data) {
                                        
                            new google.maps.Marker({
                                    position: {lat: parseFloat(data.message.latitud), lng: parseFloat(data.message.longitud) },
                                    map: map,
                                    title: 'En Barranquilla Me Quedoooo',
                                    icon: {
                                            url: "images/food-delivery.png"
                                        }
                                    });

                });

        </script>

            <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqNsWRsCY97sIMrAzW6gt-1j1xI72L9Rg&callback=initMap">
            </script>

<script>

function buscarRepartidor(){

$.ajax({ url: "../back-end/Source/Parametrico.php", 

 type: "GET",
 contentType: "application/json",
 dataType: 'json',
 data: {"oper":5 },         
 success: function(json){

  try{ 

  
   var $select = $('#num_mobilre'); 
            //  $select.find('option').remove();  

            for(var i = 0; json.length; i ++){

              $select.append('<option value=' + json[i]['n_ide'] + '>' + json[i]['num_mob'] + '</option>');
            }

          }catch(e){}

           }

        });

}


var map;
  	 function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
		  center: {lat: 10.9873307, lng: -74.8043412},
          zoom: 15,
        });

      }

    </script>

	<body>

      
    <div class="container-fluid">

            <div class="row content">

                <div class="col-sm-2 sidenav">

                        <h4>Ubicar Domiciliario </h4>

                                <br>

                            <div class="form-group">

                                    <label for="username">Telefono</label>

                                    <div class="input-group">
                                            <input type="text" class="form-control" id="tel" name="tel" onkeypress="consultarCliente(event)" required  />
                                        <!-- <img src="images/clean.png" name="clean" width="19" height="19" id="clean"  /> --> 
                                    
                                    </div>

                            </div> 

                                <div class="form-group">

                                    <label>Nombre Completo</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="nomb_completo" name="nomb_completo" style="width:400px" onkeypress="consultarCliente(event)"  />      
                                        
                                        </div>

                                </div>

                                <div class="form-group">

                                        <label>Numero de Movil</label>

                                                <div class="input-group">

                                                    <div class="col">
                                                        
                                                        <select class="form-control" id="num_mobilre" name="num_mobilre" class="select-style" onchange="buscarNombreRepartidor(this.value)" required="required" >

                                                            <option value="-1"> SELECCIONE </option> 

                                                        </select>

                                                        

                                                    </div>
                                            
                                                </div>

                                </div>
                        


                </div>

                    <div class="col-sm-10">

                            
                        <div id ="map"> </div> 

                    </div>

            </div>
                
    </div>


    </body> 
    

</html>