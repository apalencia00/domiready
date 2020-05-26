/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 $.getScript("https://maps.googleapis.com/maps/api/js?key=AIzaSyCqNsWRsCY97sIMrAzW6gt-1j1xI72L9Rg&callback=load_map", function () {});

 var map = null;
 var marker = null;
 var _address = [];
 var total = 0;


 var directionsService ;
 var directionsDisplay ;
 
 function load_map() {

  console.log("consultando el mapa de google");
  var myLatlng = new google.maps.LatLng(10.9873307, -74.8043412);
  var myOptions = {
    zoom: 10,
    center: myLatlng

  };
  map = new google.maps.Map($("#map").get(0), myOptions);
  directionsService = new google.maps.DirectionsService();
  directionsDisplay = new google.maps.DirectionsRenderer();
  directionsDisplay.setMap(map);

}

$(function() {
  $("#search").click( function()
  {
    console.log("ENTRO AQUI");
   calcularDistanciaYPintar(directionsService,directionsDisplay);


 }
 );
});



function calcularDistanciaYPintar(directionsService, directionsDisplay) {

 var origen      = document.getElementById('dirini').value;
 var destination   = document.getElementById('dirdest').value;

 var location_city_source  = document.getElementById('ciudad_org').value;
 var location_city_destiny = document.getElementById('ciudad_dest').value;
        //console.log(origen);
        
        var dir_ini = origen;
        var dir_des = destination;

        directionsService.route({
          origin:      dir_ini + location_city_source,
          destination: dir_des + location_city_destiny,
          waypoints : [],
          region: "CO",
          travelMode: google.maps.TravelMode.DRIVING
        },
        function(response, status) {
          if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);

            var route = response.routes[0];

            console.log(route);
    
              total = route.legs[0].distance.value;
              document.getElementById('distance').value = route.legs[0].distance.text;      
              document.getElementById("time").value = route.legs[0].duration.text;

              var total_pago =0;

              if ( total <= 3500 ){

                total_pago = 6000;    

                document.getElementById("valor").value = total_pago;   

              }else{

                var subtotal =  total - 3500;

                subtotal = subtotal / 1000;

                subtotal = subtotal * 800;

                subtotal =  Math.round(subtotal); 

                total_pago = 6000 + subtotal ; 

                var rawValue = Math.round(total_pago/1000)

                rawValue = rawValue * 1000;

                total_pago = rawValue;

                document.getElementById("valor").value = total_pago;
              }


          } else {
            window.alert('No se pudo procesar la solicitud, asegure tener conexion a Internet ' + status);
          }
        });


      }








