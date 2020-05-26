
<?php

//error_reporting(0);
session_start();

if($_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != ""  )  {

  $permisos = $_SESSION['admon_mod'];
  $usuario  = intval($permisos[0]['id_usuario']);

  ?>

  <html>

  <head>

    <style type="text/css">

      form input[type="select"]:required:valid{
       border:2px solid green;
     }

     form input[type="text"]:required:valid{
       border:2px solid green;
       /* otras propiedades */
     }
     /*caso contrario, el color sera rojo*/
     form input[type="text"]:focus:required:invalid{
       border:2px solid red;
       /* otras propiedades */
     }

     select.invalid ~ .select-dropdown {
       border:2px solid red;
       /* otras propiedades */
     }



   </style>

   <title>SERVICIOS GENERALES</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" href="css/stiloservicio.css" />
   <link rel="stylesheet" href="css/minified/jquery-ui.css">
   <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="css/bootstrap-dialog.css">
   <script type="text/javascript" src="js/jquery.js"></script>
   <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
   <script type="text/javascript" src="js/jquery-ui.min.js"></script>
   <script type="text/javascript" src="bootstrap/js/bootstrap.min.js" ></script>
   <script type="text/javascript" src="js/bootstrap-dialog.js" ></script>

 </head>


 <script type="text/javascript">

  function tipoPago(){

    $.ajax({ url: "../back-end/Source/Parametrico.php", 
     type: "GET",
     contentType: "application/json",
     dataType: 'json',
     data: { "oper" : 20 },

     success: function(json){ 

      try{ 

       console.log(json);

       var $select = $('#t_pago'); 
       $select.find('option').remove();  

       for(var i = 0; json.length; i ++){

        $select.append('<option value=' + json[i]['id_tipopago'] + '>' + json[i]['descripcion'] + '</option>');
      }

       }catch(e){}
    }


  });


  }

  function proceder(){


    var num_ide = document.getElementById("num").value;
    var ident   = document.getElementById("ide").value;
    var nombre  = document.getElementById("nomb").value;
    var telef   = document.getElementById("tele").value;
    var celu    = document.getElementById("cel").value;
    var total   = document.getElementById("total").value;
    var diro    = document.getElementById("diro").value;
    var estado  = document.getElementById("operacion").value;

    var dired   = document.getElementById("dird").value;
    var dirdesv1 = document.getElementById("dirdesv1").value;

    var dirdesv2 = document.getElementById("dirdesv2").value;

    var dirdesv3 = document.getElementById("dirdesv3").value;

    var dirdesv4 = document.getElementById("dirdesv4").value;

    var dirdesv5 = document.getElementById("dirdesv5").value;

    var dirdesv6 = document.getElementById("dirdesv6").value;

    var dirdesv7 = document.getElementById("dirdesv7").value;

    var movil = document.getElementById("num_mobilre").value

    var tpago = document.getElementById("t_pago").value;

    var comporigen = document.getElementById("comp_origen").value;

    var compdest   = document.getElementById("comp_destino").value;


    $.ajax({ url: "../back-end/Source/Servicio_Despacho.php", 
     type: "GET",
     contentType: "application/json",
     dataType: 'json',
     data: { "oper" : 7, "num" : num_ide},
     
     success: function(json){ 



     }

    });


  }


   





$(document).ready(function(){

  console.log("Gatterng data");
  
//var num_ide = $("#oculto",parent.document).val();

  var num_ide = document.getElementById("num").value;
    console.log(num_ide);

    $.ajax({ url: "../back-end/Source/Servicio_Despacho.php", 
     type: "GET",
     contentType: "application/json",
     dataType: 'json',
     data: { "oper" : 6, "num" : num_ide},
     
     success: function(json){ 

      try { 

      console.log(json);

      var content = json.data[0].obs;
      $("#servicio").val(content);

              // añadimos los nuevos valores al select2

              var arrayValores=new Array(

                new Array(1,2,"CANCELADO"),

                new Array(2,3,"PENDIENTE"),

                new Array(3,4,"PROGRAMADO"),

                new Array(4,5,"ENVIO NORTE")


                );

              var arrayPago = new Array(new Array(1,2, "CREDITO"));

              document.getElementById("operacion").options[0]=new Option("DESPACHO", json.data[0].tipo_servicio);

              for(i=0;i<arrayValores.length;i++)

              {

                console.log(arrayValores[i][0]);
                document.getElementById("operacion").options[document.getElementById("operacion").options.length]= new Option(arrayValores[i][2] , arrayValores[i][0]);

              }

              document.getElementById("ide").value = json.data[0].n_ide;


              document.getElementById("nomb").value = json.data[0].clinom;

              document.getElementById("tele").value = json.data[0].clitel;

              document.getElementById("cel").value = json.data[0].clicel;

              document.getElementById("total").value = json.data[0].total;

              document.getElementById("diro").value = json.data[0].dir_proc;

              document.getElementById("dird").value = json.data[0].dir_dest;

              document.getElementById("dirdesv1").value = json.data[0].dir_rta1;

              document.getElementById("dirdesv2").value = json.data[0].dir_rta2;

              document.getElementById("dirdesv3").value = json.data[0].dir_rta3;

              document.getElementById("dirdesv4").value = json.data[0].dir_rta4;

              document.getElementById("dirdesv5").value = json.data[0].dir_rta5;

              document.getElementById("dirdesv6").value = json.data[0].dir_rta6;

              document.getElementById("dirdesv7").value = json.data[0].dir_rta7;

              document.getElementById("num_mobilre").value = json.data[0].num_mob;
              
              var desc_pago;
              if(document.getElementById("t_pago").value = 1 ){
                desc_pago = "EFECTIVO";
              }

              document.getElementById("t_pago").options[0] = new Option(desc_pago,json.data[0].t_pago);

              for (var j = 0; j < arrayPago.length; j++) {
                document.getElementById("t_pago").options[document.getElementById("t_pago").options.length] = new Option(arrayPago[j][2] ,arrayPago[j][0]  );
              }



              document.getElementById("comp_origen").value = json.data[0].comp_dire;

              document.getElementById("comp_destino").value = json.data[0].comp_est;

             }catch(e){}

            }


          });



});


function servicio(){

  try { /* run js code */ 


    $.ajax({ url: "../back-end/Source/Parametrico.php", 
     type: "GET",
     contentType: "application/json",
     dataType: 'json',
     data: { "oper" : 4 },

     success: function(json){ 

             //console.log(json);

             if(json != ""){

              var $select = $('#operacion'); 
              $select.find('option').remove();  

              for(var i = 0; json.length; i ++){
                //console.log(json[i]['id_estado_orden'] + ";" +  json[i]['descripcion'] );
                $select.append('<option value=' + json[i]['id_estado_orden'] + '>' + json[i]['descripcion'] + '</option>');
              }

            }

          }});

  }   catch (error){ /* resolve the issue or bug */ }


}

function buscarNombreRepartidor(idnumb){

             //var ide_mobil = document.getElementById("num_mobilre").value;
             $.ajax({ url: "../back-end/Source/Parametrico.php", 

               type: "GET",
               contentType: "application/json",
               dataType: 'json',
               data: {"oper":6 , "mobil_ide" : idnumb },         
               success: function(json){

             //console.log(json);
             
             var $select = $('#repartidor'); 
             $select.find('option').remove();  

             $select.append('<option value=' + json['n_ide'] + '>' + json['empnom'] + '</option>');

           }

         });

             
             
             
           }


         </script>



         <body>

           <div class="container">

           

  <form id="form" name="form" method="post" action="" class="form-horizontal" onsubmit="return false">


              <input  id="fecha" name="fecha" type="hidden" value="<?php echo date('Y-m-d h:m:s') ?>"  /></p>


              <div class="form-group">

              <input id="num" name="num" type="hidden" value="<?php echo $_GET['idser'] ?>" readonly  />

                <label class="control-label col-sm-4">ESTADO
                </label>
                <div class="col-sm-8">
                  <select class="form-control col-lg-100" required id="operacion" name="operacion" onChange="transaccion_operacion(this.value)" >

                    <option value=""> SELECCIONE  </option>

                  </select>


                </div>

              </div>

              <div class="form-group">

                <label class="control-label col-sm-4">DOCUMENTO</label>
                <div class="col-sm-8">
                  <input id="ide" name="ide" class="form-control col-lg-100" autofocus type="text" readonly  />

                </div>

              </div>



              



              <div class="form-group">

                <label class="control-label col-sm-4">NOMBRE COMPLETO</label>
                <div class="col-sm-8">
                  <input id="nomb" name="nomb" class="form-control col-lg-100" autofocus type="text"   /> 

                </div>

              </div>

              <div class="form-group">

                <label class="control-label col-sm-4">TELEFONO</label>
                <div class="col-sm-8">
                 <input id="tele" class="form-control col-lg-100" autofocus name="tele" type="text"   />   
               </div>


             </div>


             <div class="form-group">

              <label class="control-label col-sm-4">CELULAR</label>
              <div class="col-sm-8">
               <input class="form-control col-lg-100" autofocus id="cel" name="cel" type="text"   />

             </div>

           </div>


           <div class="form-group">

            <label class="control-label col-sm-4">MOVIL </label>
            <div class="col-sm-8">
             <input class="form-control col-lg-100" autofocus type="text" id="num_mobilre"  name="num_mobilre" value="" />


           </div>

         </div>

         <div class="form-group">

          <label class="control-label col-sm-4">TOTAL $</label>
          <div class="col-sm-8">
           <input class="form-control col-lg-100" autofocus id="total" name="total" type="text"   />

         </div>

       </div>


       <div class="form-group">

        <label class="control-label col-sm-4">TIPO PAGO </label>
        <div class="col-sm-8">
         <select class="form-control col-lg-100" id="t_pago" ></select>

       </div>

     </div>

     <div class="row">

      <div class="col-xs-6">
        <div class="row">
          <label class="col-xs-12">Recogida</label>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <input class="form-control" type="text" id="diro" />
          </div>
          <div class="col-xs-12 col-sm-6">
            <input class="form-control" type="text"/>
          </div>
        </div>
      </div>


      <div class="col-xs-6">
        <div class="row">
          <label class="col-xs-12">Entrega</label>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <input class="form-control" type="text" id="dird" />
          </div>
          <div class="col-xs-12 col-sm-6">
            <input class="form-control" type="text"/>
          </div>
        </div>
      </div>


      <div class="col-xs-6 form-group">
        <label>Desvio #1</label>
        <input id="dirdesv1" class="form-control" type="text"/>
      </div>
      <div class="col-xs-6 form-group">
        <label>Desvio #2</label>
        <input id="dirdesv2" class="form-control" type="text"/>
      </div>

      <div class="col-xs-6 form-group">
        <label>Desvio #3</label>
        <input id="dirdesv3" class="form-control" type="text"/>
      </div>

      <div class="col-xs-6 form-group">
        <label>Desvio #4</label>
        <input id="dirdesv4" class="form-control" type="text"/>
      </div>


      <div class="col-xs-6 form-group">
        <label>Desvio #5</label>
        <input id="dirdesv5" class="form-control" type="text"/>
      </div>

      <div class="col-xs-6 form-group">
        <label>Desvio #6</label>
        <input id="dirdesv6" class="form-control" type="text"/>
      </div>

      <div class="col-xs-6 form-group">
        <label>Desvio #7</label>
        <input id="dirdesv7" class="form-control" type="text"/>
      </div>



      


    </div>

    <div class="row" >

     <div class="form-group">

      <label class="control-label col-sm-4">Observacion</label>
      <div class="col-sm-8"> 
        <textarea class="form-control" id="servicio" name="servicio" cols="30" rows="3" style="background:#CCC;text-transform: uppercase" onKeyUp="javascript:this.value=this.value.toUpperCase();" ></textarea>


      </div>
    </div>

    </div>

    <button onclick="proceder()" type="button" id="save" class="btn btn-primary btn-block">Aceptar</button>


  </form>
 



</body>

</html>

<?php }else{ header('Location: 404.php');

  unset($_SESSION['admon_mod']);

        // DESTROY COOKIE
  if (isset($_COOKIE['key'])) {
    unset($_COOKIE['key']);
    setcookie('key', '', time() - 3600, '/'); // empty value and old timestamp
  }



}
?>
