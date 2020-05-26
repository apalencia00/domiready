

<!DOCTYPE html>
<html>
<head>
  <title>SERVICIOS EXPRESS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/minified/jquery-ui.min.css" type="text/css" />
  

  <link  href="css/bootstrap.scss" /> 

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


</style>
    <!-- Custom styles for this template -->

    <link href="../vendor/twitter/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" >

  <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js" ></script>
  <script type="text/javascript" src="js/procesarMaestro.js"></script>


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



 <script>

   $(document).ready(function(){

      $("#nomb").autocomplete({
          source: "autocomplete.php",

  });

     $(document).on("click", "#bacano", function (e) {
       var data = $(this).data('id');
       $("#myModal #idserv").val(data);
       $("#myModal #idservtag").text(data);
       $("#num").val(data);


       $.ajax({ url: "../back-end/Source/Servicio_Despacho.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "oper" : 6, "num" : data},

         success: function(json){ 

          try { 

            console.log(json);

            var content = json.data[0].obs;
            $("#servicio").val(content);

              // añadimos los nuevos valores al select2

              var arrayValores=new Array(

                              new Array(4,5,"ENVIO NORTE")


                );



              var arrayPago = new Array(new Array(1,2, "CREDITO"));

              document.getElementById("operacion").options[0]=new Option(json.data[0].desc_servicio, json.data[0].tipo_servicio);

              for(i=0;i<arrayValores.length;i++)

              {

                console.log(arrayValores[i][1]);
                document.getElementById("operacion").options[document.getElementById("operacion").options.length]= new Option(arrayValores[i][2] , arrayValores[i][1]);

              }

              document.getElementById("ide").value = json.data[0].n_ide;


              document.getElementById("nombrecom").value = json.data[0].clinom;

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

              document.getElementById("num_mobilre_mod").options[0] = new Option(json.data[0].num_mob,json.data[0].num_mob);
              
              var desc_pago;
              if(document.getElementById("t_pago").value = 1 ){
                desc_pago = "EFECTIVO";
              }

              document.getElementById("t_pago").options[0] = new Option(desc_pago,json.data[0].t_pago);

              for (var j = 0; j < arrayPago.length; j++) {
                document.getElementById("t_pago").options[document.getElementById("t_pago").options.length] = new Option(arrayPago[j][2] ,arrayPago[j][0]  );
              }



              document.getElementById("comp_origen").value = json.data[0].comp_dire;

              document.getElementById("comp_destino").value = json.data[0].comp_diredest;

            }catch(e){}

          }


        });



     }); 


   });

   function localizarServicioByTelefono(telef,e)

   {

    var key=document.all ? e.which : e.keyCode;

    if (key == 13) {
      e.preventDefault();


      $.ajax({ url: "../back-end/Source/Servicio_Despacho.php",
        contentType: "application/json",
        dataType: 'json',
        type: "GET", 
        data: { "oper" : 20, "telef" :telef  },

        success: function(json){

          try{ 

            if(json.root != null){

              console.log(json);      
              var res = json.success;    

              var json_string = JSON.stringify(json.root);
              var jsonObj = JSON.parse(json_string);
              var html = '<table class="table table-striped" border="0">';


              $.each(jsonObj, function(key, value){

                 html += '<tr>  <td width="10%" scope="row" data-toggle="modal" id="bacano" data-id="'+jsonObj[key].num_servicio+'" data-target="#myModal" >' + jsonObj[key].num_servicio + '</td>' + '<td width="10%" >' +  jsonObj[key].fecha_serv + '</td>' + '<td width="10%" >' +  jsonObj[key].nombre_completo + '</td>' +  '<td width="10%" >' +  jsonObj[key].dir_proc + '</td>' +   '<td width="10%" >' +  jsonObj[key].dir_dest + '</td>' + '<td width="10%" >' +  jsonObj[key].num_mob + '</td>' + '<td width="10%" >'  + jsonObj[key].t_pago + '</td>' + '<td width="10%">' +  jsonObj[key].total + '</td>' + '<td width="10%" >' +  jsonObj[key].descripcion + '</td>' + '<td width="10%" >' +  jsonObj[key].usuanom + '</td>' + '<td width="20%" align="center" onclick="imprimir_report('+jsonObj[key].num_servicio+')"  >  </td>' +  '<td width="5%" align="center" onclick="pendiene('+jsonObj[key].num_servicio+', ' +  jsonObj[key].usuadoc + ')"  > <img src="images/warning.png" alt="" border=3 height=10 width=8></img> </td>' +  '<td width="5%" align="center" onclick="cancelar('+jsonObj[key].num_servicio+',' +  jsonObj[key].usuadoc + ')"  > <img src="images/remove.png" alt="" border=3 height=10 width=8></img> </td>' ;
            html += '</tr>';

              });

              html += '</table>';
              $('#act_table').html(html);


            }

          }catch(e){}

        }


      });

    }


  }

  function localizarServicioByNombre(nomb,e){

    var key=document.all ? e.which : e.keyCode;

    if (key == 13) {
      e.preventDefault();


      $.ajax({ url: "../back-end/Source/Servicio_Despacho.php",
        contentType: "application/json",
        dataType: 'json',
        type: "GET", 
        data: { "oper" : 21, "nom" :nomb  },

        success: function(json){

          if(json.root != null){

            console.log(json);      
            var res = json.success;    

            var json_string = JSON.stringify(json.root);
            var jsonObj = JSON.parse(json_string);
            var html = '<table class="table table-striped" border="0">';


            $.each(jsonObj, function(key, value){

               html += '<tr>  <td width="10%" scope="row" data-toggle="modal" id="bacano" data-id="'+jsonObj[key].num_servicio+'" data-target="#myModal" >' + jsonObj[key].num_servicio + '</td>' + '<td width="10%" >' +  jsonObj[key].fecha_serv + '</td>' + '<td width="10%" >' +  jsonObj[key].nombre_completo + '</td>' +  '<td width="10%" >' +  jsonObj[key].dir_proc + '</td>' +   '<td width="10%" >' +  jsonObj[key].dir_dest + '</td>' + '<td width="10%" >' +  jsonObj[key].num_mob + '</td>' + '<td width="10%" >'  + jsonObj[key].t_pago + '</td>' + '<td width="10%">' +  jsonObj[key].total + '</td>' + '<td width="10%" >' +  jsonObj[key].descripcion + '</td>' + '<td width="10%" >' +  jsonObj[key].usuanom + '</td>' + '<td width="20%" align="center" onclick="imprimir_report('+jsonObj[key].num_servicio+')"  >  </td>' +  '<td width="5%" align="center" onclick="pendiene('+jsonObj[key].num_servicio+', ' +  jsonObj[key].usuadoc + ')"  > <img src="images/warning.png" alt="" border=3 height=10 width=8></img> </td>' +  '<td width="5%" align="center" onclick="cancelar('+jsonObj[key].num_servicio+',' +  jsonObj[key].usuadoc + ')"  > <img src="images/remove.png" alt="" border=3 height=10 width=8></img> </td>' ;
            html += '</tr>';

            });

            html += '</table>';
            $('#act_table').html(html);


          }

        }


      });

    }


  }

  function localizarServicio(moviln)

  {


    $.ajax({ url: "../back-end/Source/Lista_Servicios.php",
      contentType: "application/json",
      dataType: 'json',
      type: "GET", 
      data: { "oper" : 2, "movil" :moviln  },

      success: function(json){

       if(json.root != null){

         var res = json.success;               

         if(res){
          var json_string = JSON.stringify(json.root);
          var jsonObj = JSON.parse(json_string);
          var html = '<table class="table table-striped" border="0">';

          $.each(jsonObj, function(key, value){


            html += '<tr>  <td width="10%" scope="row" data-toggle="modal" id="bacano" data-id="'+jsonObj[key].num_servicio+'" data-target="#myModal" >' + jsonObj[key].num_servicio + '</td>' + '<td width="10%" >' +  jsonObj[key].fecha_serv + '</td>' + '<td width="10%" >' +  jsonObj[key].nombre_completo + '</td>' +  '<td width="10%" >' +  jsonObj[key].dir_proc + '</td>' +   '<td width="10%" >' +  jsonObj[key].dir_dest + '</td>' + '<td width="10%" >' +  jsonObj[key].num_mob + '</td>' + '<td width="10%" >'  + jsonObj[key].t_pago + '</td>' + '<td width="10%">' +  jsonObj[key].total + '</td>' + '<td width="10%" >' +  jsonObj[key].descripcion + '</td>' + '<td width="10%" >' +  jsonObj[key].usuanom + '</td>' + '<td width="20%" align="center" onclick="imprimir_report('+jsonObj[key].num_servicio+')"  >  </td>' +  '<td width="5%" align="center" onclick="pendiene('+jsonObj[key].num_servicio+', ' +  jsonObj[key].usuadoc + ')"  > <img src="images/warning.png" alt="" border=3 height=10 width=8></img> </td>' +  '<td width="5%" align="center" onclick="cancelar('+jsonObj[key].num_servicio+',' +  jsonObj[key].usuadoc + ')"  > <img src="images/remove.png" alt="" border=3 height=10 width=8></img> </td>' ;
            html += '</tr>';

          });

          html += '</table>';
          $('#act_table').html(html);

        }    
    } //

    else{

      $("#act_table tbody").remove();
        //$('#act_table tbody > tr').remove();
        //$('#act_table').empty()
        //$('#act_table tbody').remove();
      }

    }

  });


  }

  function cargarServiciosAll()
  {

    $.ajax({ url: "../back-end/Source/Lista_Servicios.php",
      contentType: "application/json",
      dataType: 'json',
      type: "GET", 
      data: { "oper" : 1 },

      success: function(json){

        if(json.root != null){ 

         var res = json.success;                               

         if(res){
          var json_string = JSON.stringify(json.root);
          var jsonObj = JSON.parse(json_string);
          var html = '<table class="table table-striped" border="0">';

          $.each(jsonObj, function(key, value){


            html += '<tr>  <td width="10%" scope="row" data-toggle="modal" id="bacano" data-id="'+jsonObj[key].num_servicio+'" data-target="#myModal" >' + jsonObj[key].num_servicio + '</td>' + '<td width="10%" >' +  jsonObj[key].fecha_serv + '</td>' + '<td width="10%" >' +  jsonObj[key].nombre_completo + '</td>' +  '<td width="10%" >' +  jsonObj[key].dir_proc + '</td>' +   '<td width="10%" >' +  jsonObj[key].dir_dest + '</td>' + '<td width="10%" >' +  jsonObj[key].num_mob + '</td>' + '<td width="10%" >'  + jsonObj[key].t_pago + '</td>' + '<td width="10%">' +  jsonObj[key].total + '</td>' + '<td width="10%" >' +  jsonObj[key].descripcion + '</td>' + '<td width="10%" >' +  jsonObj[key].usuanom + '</td>' + '<td width="20%" align="center" onclick="imprimir_report('+jsonObj[key].num_servicio+')"  >  </td>' +  '<td width="5%" align="center" onclick="pendiene('+jsonObj[key].num_servicio+', ' +  jsonObj[key].usuadoc + ')"  > <img src="images/warning.png" alt="" border=3 height=10 width=8></img> </td>' +  '<td width="5%" align="center" onclick="cancelar('+jsonObj[key].num_servicio+',' +  jsonObj[key].usuadoc + ')"  > <img src="images/remove.png" alt="" border=3 height=10 width=8></img> </td>' ;
            html += '</tr>';

          });

          html += '</table>';
          $('#act_table').html(html);

        }


      }else{

        $('#act_table > tbody').remove();

      }    
    }

  });


  }

  function imprimir_report(serv)

  {

    $('.dialog').css('display','block');
  //$('#dialog').load('http://198.46.152.223:8080/JasperPrint/webresources/print/imprimir #dialog');
  $('#myframe').attr('src', 'http://198.46.152.223:8080/JasperPrint/webresources/print/imprimirServicio?serv='+serv);

  var dialog1 = $("#dialog").dialog({ 
   autoOpen: false,
   height: 600,
   width: 650,
   modal: true,

 });

  dialog1.dialog('open');


}

function cargarAntiguo(valor){
  console.log(valor);

  window.open("windowService.php?idser="+valor,'','top=300,left=300,width=1000,height=600') ;


}

function buscarRepartidor(){

  $.ajax({ url: "../back-end/Source/Parametrico.php", 

   type: "GET",
   contentType: "application/json",
   dataType: 'json',
   data: {"oper":5 },         
   success: function(json){

    try{ 

     if(json != null){
             //console.log(json);
             
             var $select = $('#num_mobilre'); 

             for(var i = 0; json.length; i ++){

              $select.append('<option value=' + json[i]['n_ide'] + '>' + json[i]['num_mob'] + '</option>');
            }

          }

        }catch(e){}



      }

    });

}

function refreshIframe(){

  window.location.reload();

}

function LocalizacambiaEstado(valor){


  $.ajax({ url: "../back-end/Source/Lista_Servicios.php",
   contentType: "application/json",
   dataType: 'json',
   type: "GET", 
   data: { "oper" : 3, "estado" : valor },

   success: function(json){

    if(json.root != null){ 

     var res = json.success;                               

     if(res){
      var json_string = JSON.stringify(json.root);
      var jsonObj = JSON.parse(json_string);
      var html = '<table class="table table-striped" border="0">';

      $.each(jsonObj, function(key, value){


        html += '<tr> <td width="15%" ><a id="editar" onclick="cargarAntiguo('+jsonObj[key].num_servicio+')"  > editar </a>  '  +  '</td>' + '<td width="10%" >' + jsonObj[key].num_servicio + '</td>' + '<td width="10%" >' +  jsonObj[key].fecha_serv + '</td>' + '<td width="10%" >' +  jsonObj[key].nombre_completo + '</td>' + '<td width="10%" >' +  jsonObj[key].num_mob + '</td>' + '<td width="10%" >'  + jsonObj[key].t_pago + '</td>' + '<td width="10%">' +  jsonObj[key].total + '</td>' + '<td width="10%" >' +  jsonObj[key].descripcion + '</td>' + '<td width="10%" >' +  jsonObj[key].usuanom + '</td>' + '<td width="20%" align="center" onclick="imprimir_report('+jsonObj[key].num_servicio+')"  >  </td>'  ;
        html += '</tr>';
        
      });

      html += '</table>';
      $('#act_table').html(html);

    }


  }else{

    $('#act_table > tbody').remove();

  }

}    
});




}  


</script>

</head>

<body onload="cargarServiciosAll();buscarRepartidor();">

            <div class="container-fluid">

                <div class="row">

                      

                    <form id="form" name="form" method="post" action="" class="register">

                    <p><h4>Listado de Servicios</h4><p>

                    <div class="form-group">

                                <div class="input-group">

                                        <div class="col">

                                        <label for="username">Telefono</label>

                                          <input class="form-control" value="" id="tel" name="tel"  tabindex="1" type="text" onkeypress="localizarServicioByTelefono(this.value,event)" >

                                        </div>

                                        <div class="col">

                                            <label for="username">Movil</label>

                                              <select class="form-control" id="num_mobilre" name="num_mobilre" class="select-style" onChange="localizarServicio(this.value)" >

                                                    <option value="-1" >Seleccione</option>

                                              </select>

                                              
                                        </div>

                                        <div class="col">
      
                                            <label> Nombre </label>
                          
                                            <input class="form-control" value="" id="nomb" name="nomb"  required="" tabindex="1" type="text" onkeypress="localizarServicioByNombre(this.value,event)" >


                                        </div>

                                        
                                        <div class="col">

                                        <label for="username">Operacion Servicio</label>

                                              <select class="form-control" id="estado_serv" class="select-style" onchange="LocalizacambiaEstado(this.value)" >

                                                <option value="1" >DESPACHO</option>
                                                <option value="2" >CANCELADO</option>
                                                <option value="3" >PENDIENTE</option>
                                                <option value="5" >NORTE</option>


                                              </select>

                                        </div>

                                </div>

                    </div>




                          



                    </form>

                    


                </div>

                <div class="row">

                        <table id="tableID" class="table table-striped" width="1000px" height="70%" align="center" >
                                              
                                    <thead>
                                              
                                                <th width="10%" >SERVICIO</th>
                                                <th width="10%" >FECHA</th>
                                                <th width="10%" >NOMBRE</th>
                                                <th width="10%" >ORIGEN </th>
                                                <th width="10%" >DESTINO </th>
                                                <th width="10%" >MOVIL</th>
                                                <th width="10%" >PAGO</th>
                                                <th width="10%" >VALOR</th>
                                                <th width="10%" >ESTADO</th>
                                                <th width="10%" >USUARIO</th>
                                                <th width="10%" >ACCION</th>
                                              

                                            </thead>

                                                  <tbody id="tbody">
                                                        
                                                          <td colspan="11">
                                                            <div id="act_table" style="width: 100%; height: 200px; overflow-y: scroll;" > </div></td>
                                                          

                                                    </tbody>
                          </table>


                  </div>


                <div class="row">

 
                    <form id="forma" name="form" method="post" action="" class="form-horizontal" onsubmit="return false">

                              <input  id="fecha" name="fecha" type="hidden" value="<?php echo date('Y-m-d h:m:s') ?>"  /></p>

                              <input id="num" name="num" type="hidden" readonly  />

                              <h4>Detalle de Servicios</h4><br>

                        <div class="form-group">

                                  <div class="input-group">

                                        <div class="col" >

                                            <label class="control-label col-sm-4">ESTADO</label>

                                                <select class="form-control" required id="operacion" name="operacion" onChange="transaccion_operacion(this.value)" >

                                                      <option value=""> SELECCIONE  </option>

                                                </select>

                                        </div>

                                        <div class="col">

                                            <label class="control-label col-sm-4">DOCUMENTO</label>

                                            <input id="ide" name="ide" class="form-control col-lg-100" autofocus type="text" readonly  />

                                        </div>

                                        <div class="col">

                                            <label class="control-label col-sm-4">NOMBRE</label>

                                           <input id="nombrecom" name="nombrecom" class="form-control" autofocus type="text"   /> 

                                        </div>

                                        <div class="col" >

                                            <label class="">TELEFONO</label>

                                            <input id="tele" class="form-control col-lg-100" autofocus name="tele" type="text"   />

                                        </div>

                                        <div class="col" >

                                            <label class="control-label col-sm-4">CELULAR</label>

                                            <input class="form-control col-lg-100" autofocus id="cel" name="cel" type="text"   />

                                        </div>

                                        <div class="col">

                                              <label class="">REPARTIDOR</label>

                                              <select id="num_mobilre_mod" onclick="buscarRepartidorMaestro()" class="form-control" ></select>

                                        </div>

                                        <div class="col">

                                            <label class="control-label col-sm-4">TOTAL</label>

                                            <input class="form-control" autofocus id="total" name="total" type="text"   />
                                
                                        </div>

                                        <div class="col">

                                            
                                              <label class="control-label">TIPO PAGO </label>

                                              <select class="form-control" id="t_pago" ></select>

                                        </div>

                                        <div class="col">

                                            <label>REGRESA</label>    

                                                  <select class="form-control" id="idavuelta">

                                                        <option value="NO">NO</option>
                                                        <option value="SI">SI</option>

                                                  </select>

                                        </div>


                                  </div>

                        </div>

                           <div class="form-group">

                                <div class="input-group">

                                      <div class="col">

                                          <label>ORIGEN</label>

                                          <input id="diro" class="form-control col-lg-100" type="text"/> 



                                      </div>

                                      <div class="col" >

                                            <label>COMPLEMENTO</label>

                                            <input id="comp_origen" class="form-control col-lg-100" type="text"/>

                                      </div>

                                      <div class="col">

                                          <label> DESTINO </label>
                                          <input id="dird" class="form-control col-lg-100" type="text"/>

                                      </div>

                                      <div class="col">

                                        <label>COMPLEMENTO</label>
                                        <input id="comp_destino" class="form-control col-lg-100" type="text"/>

                                      </div>

                                      


                              </div>

                        </div>

                        <div class="form-group">

                                  <div class="input-group">

                                  <div class="col">

                                          <label>Desvio #1</label>
                                          <input id="dirdesv1" class="form-control" type="text"/>

                                      </div>

                                      <div class="col">

                                          <label>Desvio #2</label>
                                          <input id="dirdesv2" class="form-control" type="text"/>

                                      </div>

                                      <div class="col">

                                          <label>Desvio #3</label>
                                          <input id="dirdesv3" class="form-control" type="text"/>

                                      </div>

                                      <div class="col">

                                            <label>Desvio #4</label>
                                            <input id="dirdesv4" class="form-control" type="text"/>

                                      </div>

                                  </div>

                        </div>


                        <div class="form-group">

                            <div class="input-group">

                                  <div class="col">

                                      <label>Desvio #5</label>
                                          
                                      <input id="dirdesv5" class="form-control" type="text"/>   

                                  </div>

                                  <div class="col">

                                        <label>Desvio #6</label>
                                        <input id="dirdesv6" class="form-control" type="text"/>

                                  </div>

                                  <div class="col">

                                        <label>Desvio #7</label>
                                        <input id="dirdesv7" class="form-control" type="text"/>

                                  </div>

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="input-group">

                            <div class="col">

                                  <label class="control-label col-sm-4">Observacion</label> 

                                  <textarea class="form-control" id="servicio" name="servicio" cols="30" rows="3" style="background:#CCC;text-transform: uppercase" onKeyUp="javascript:this.value=this.value.toUpperCase();" ></textarea>

                            </div>

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="input-group">

                            <button onclick="proceder()"  type="button" id="save" class="btn btn-primary btn-block">Aceptar</button>

                            </div>

                        </div>
                        
                                                                 

      
                               

                    </form>

                </div>


              </body>
  </html>
