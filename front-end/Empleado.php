<?php 

session_start(); 

if($_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "" )  {

$modulos = $_SESSION['admon_mod'];

?>


<!doctype html>



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

<meta charset="UTF-8">


<title>Registro Empleado</title>



<script type="text/javascript" src="js/jquery.js" ></script>
<script type="text/javascript" src="js/ajax.js"  ></script>

<script type="text/javascript">

function limpiarAll(){

  location.reload();

}


  
function cargarTipoEmpleo(){

 $.ajax({ url: "../back-end/Source/Parametrico_Empleado.php", 
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
                
                $select.append('<option value=' + json[i]['id_templeo'] + '>' + json[i]['descripcion'] + '</option>');
            }
    }catch(e){}

     }

  });

}

                        
var uniqueRandoms = [];
var numRandoms = 1000;
function numeroMobilDisponible() {
    // refill the array if needed
    if (!uniqueRandoms.length) {
        for (var i = 0; i < numRandoms; i++) {
            uniqueRandoms.push(i);
        }
    }
    var index = Math.floor(Math.random() * uniqueRandoms.length);
    var val = uniqueRandoms[index];

    // now remove that value from the array
    uniqueRandoms.splice(index, 1);

    return val;

}

 

  $(document).ready(function(){

   document.getElementById("mobil").value = numeroMobilDisponible();
    cargarTipoEmpleo();

  });

</script>

<body  >


<div class="card">

  <div class="card-header">

    Registro De Empleados
  </div>
  <div class="card-body">
    <h5 class="card-title">Tratamiento de Datos de Empleados</h5>

    <form id="contactform">

        <div class="form-group">

          <label for="username">Identificacion</label> 

            <div class="input-group">

                    <input class="form-control" id="identificacion" name="identificacion" placeholder="Numero de indentificacion" required type="text" >
            </div>

        </div>
          

        <div class="form-group">

          <label for="username">Nombre(s)</label> 

            <div class="input-group">

            <input class="form-control" id="nonmbre" name="nonmbre" placeholder="Nombre completo" required tabindex="2" type="text"/>

            </div>

        </div>



        <div class="form-group">

          <label for="username">Apellidos</label> 

            <div class="input-group">

            <input class="form-control" id="apellido" name="apellido" placeholder="Apellido completo" required type="text"/>

            </div>

        </div>



        <div class="form-group">

          <label for="username">Direccion</label> 

            <div class="input-group">

            <input class="form-control" id="direccion" name="direccion" required type="text"/>

            </div>

        </div>


        <div class="form-group">

          <label for="username">Telefono</label> 

              <div class="input-group">

              <input class="form-control" id="telefono" name="telefono" required type="text"/>

              </div>

        </div>



        <div class="form-group">

          <label for="username">Celular</label> 

            <div class="input-group">

            <input class="form-control"  id="celular" name="celular" required type="text"/>

            </div>

        </div>

        <div class="form-group">

          <label for="username">Tipo de Empleo</label> 

            <div class="input-group">

            <select class="form-control" name="tipo" id="tipo"></select>   

            </div>

        </div>

        <div class="form-group">

          <label for="username">Sucursal</label> 

            <div class="input-group">

                <select class="form-control" name="suc" id="suc">

                      <option  value="C">CENTRO</option>
                      <option value="N">NORTE</option>
                      <option value="CN">CENTRO - NORTE</option>

                </select> 
            
            </div>

        </div>


        <div class="form-group">

            <label for="username">Movil</label>

                <div class="input-group">

                <input class="form-control"  id="mobil" name="mobil" required="" type="text" tabindex="7" value="">
  
                </div>

        </div>

 

        <input class="subscribe btn btn-primary btn-block rounded-pill shadow-sm" onClick="addEmpleado()" name="submit" id="submit" value="Agregar" >   
        <input class="subscribe btn btn-primary btn-block rounded-pill shadow-sm" onClick="limpiarAll()" name="submit" id="submit" value="Agregar" >   

   </form>


  </div>


</div>



</body>

</html>

<?php
}
?>