<html>

<head>

<style>

/*
*
* ==========================================
* FOR DEMO PURPOSES
* ==========================================
*
*/

body {
background: #EEE9E8;
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

    .card{
      width: 80%;
      position: absolute;
      left: 170px;
    }


</style>
    <!-- Custom styles for this template -->

    <link href="../vendor/twitter/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" >
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui.js"></script>

<script type="text/javascript" src="js/add.js"  ></script>




<script type="text/javascript">




function addBase(){


window.open("Base_Caja_Norte.php", "_blank", "toolbar=yes, scrollbars=no, resizable=yes, top=500, left=500, width=800, height=400");


}

function getSaldoActual(){

$.ajax({ url: "../back-end/Source/Parametrico_CajaNorte.php",
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "oper" : 5 },

         success: function(json){

            console.log(json);
            if(json != false){
              document.getElementById("saldoac").value = json.saldo_caja_actual;


            }else{

                        document.getElementById("saldoac").value = 0;
            }


    }});


}

function getConceptoCaja(){

 $.ajax({ url: "../back-end/Source/Parametrico_Caja.php",
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "oper" : 1 },

         success: function(json){

          try{

             console.log(json);

                var $select = $('#tipo');
                $select.find('option').remove();

                for(var i = 0; json.length; i ++){

                $select.append('<option value=' + json[i]['id_concepto_caja'] + '>' + json[i]['descripcion'] + '</option>');
            }
    }catch(e){}

     }


  });

}

function getConceptoContable(){

 $.ajax({ url: "../back-end/Source/Parametrico_CajaNorte.php",
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "oper" : 3 },

         success: function(json){

          try{
             console.log(json);

                var $select = $('#tipo');
                $select.find('option').remove();

                for(var i = 0; json.length; i ++){

                $select.append('<option value=' + json[i]['id_concepto_caja'] + '>' + json[i]['descripcion'] + '</option>');
            }
    }catch(e){}

     }


  });

}

function cleanAll(){

document.getElementById("motivo").value = "";
document.getElementById('cedula').value = "";
document.getElementById('valor').value = "";

document.location.href = document.location.href;


}


 $(document).ready(function(){

getSaldoActual();
    getConceptoCaja();
    getConceptoContable();

  });



</script>



</head>

<body onload="">




<div class="card">

  <div class="card-header">

    Gestion De Caja Menor Norte

  </div>
  <div class="card-body">
    <h5 class="card-title">Movimientos De Caja</h5>

    <form id="contactform">

        <div class="form-group">

          <label for="username">Concepto de Caja</label> 

            <div class="input-group">

            <select class="form-control" name="tipo" id="tipo"></select>
            </div>

        </div>
          

        <div class="form-group">

          <label for="username">Concepto Contable</label> 

            <div class="input-group">

                <select class="form-control" name="contable" id="contable"></select>

            </div>

        </div>



        <div class="form-group">

          <label for="username">Saldo Caja</label> 

            <div class="input-group">

                <input class="form-control" id="saldoac" name="saldoac"  required=""   type="text" readonly placeholder ="Saldo actual Caja">

            </div>

        </div>



        <div class="form-group">

          <label for="username">Motivo - Razon</label> 

            <div class="input-group">

            <input class="form-control" id="motivo" name="motivo" placeholder="Motivo - Razon" required="" type="text">

            </div>

        </div>  


        <div class="form-group">

          <label for="username">Identificacion Movil</label> 

            <div class="input-group">

            <input class="form-control" id="cedula" name="cedula"  placeholder="Identificacion o N° Mobil" required="" tabindex="2" type="text">

            </div>

        </div>


        <div class="form-group">

          <label for="username">Valor</label>

            <div class="input-group">

            <input class="form-control"  id="valor" name="valor" required="" type="text" placeholder="Ingrese Valor">

            </div>

        </div>

        
        <div class="form-group">

          <label for="username">Fecha Transaccion</label>

            <div class="input-group">

            <input class="form-control" id="fecha" name="fecha" required="" value="<?php echo date("Y-m-d"); ?>" type="text" >

            </div>

        </div>
       



        
        

 

        <input class="buttom" name="submit" id="submit" tabindex="5" value="Agregar" type="button" onclick="addCajaregNorte()">
            <input class="buttom" name="clean" id="clean" tabindex="5" value="Limpiar" type="button" onclick="cleanAll()">
              <input class="buttom" name="basecaja" id="basecaja" tabindex="5" value="Agregar Base" type="button" onclick="addBase()" >

   </form>


  </div>


</div>


  



</body>

</html>
