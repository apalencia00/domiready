<?php 

session_start(); 

if($_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "" )  {

$modulo = $_SESSION['admon_mod'];

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

<script type="text/javascript" src="js/jquery.js" ></script>
<script type="text/javascript" src="js/add.js"  ></script>

<script type="text/javascript">


function getLastId()

{

  $.ajax({ url: "../back-end/Source/Parametrico_Cliente.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "oper" : 5 },
                 
         success: function(json){ 
          console.log(json);
          var suma = parseInt(json.data[0].n_ide) + 1;
          document.getElementById("identificacion").value = suma ;
             
                }

              });



}

function readDOM(){

var x = document;

var tele = window.localStorage.getItem("dato");
  
document.getElementById("telefono").value = tele;
 window.localStorage.removeItem("dato");

}

  
 function tipoID(){
        
        $.ajax({ url: "../back-end/Source/Parametrico_Cliente.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "oper" : 1 },
                 
         success: function(json){ 

          try{ 
             
             console.log(json);
             
                var $select = $('#tipo_doc'); 
                $select.find('option').remove();  
                
                for(var i = 0; json.length; i ++){
                
                $select.append('<option value=' + json[i]['tipo_doc'] + '>' + json[i]['descripcion'] + '</option>');
            }
    }catch(e){}

     }


  });
        
        
    }

</script>

<body onLoad="tipoID();readDOM();">

<div class="card">
  <div class="card-header">
    Registro De Cliente
  </div>
  <div class="card-body">
    <h5 class="card-title">Tratamiento de Datos de Cliente</h5>

    <form id="contactform">

        <div class="form-group">

          <label for="username">Tipo de Documento</label> 

            <div class="input-group">
                    <select id="tipo_doc" class="form-control" name="tipo_doc" class="select-style"></select>
            </div>

        </div>
          

        <div class="form-group">

          <label for="username">Documento</label> 

            <div class="input-group">
    
              <input id="identificacion" class="form-control" name="identificacion" placeholder="Numero de indentificacion" type="text"/>

            </div>

        </div>


        <div class="form-group">

          <label for="username">Nombre(s)</label> 

            <div class="input-group">

                <input class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" required type="text"/>

            </div>

        </div>



        <div class="form-group">

          <label for="username">Apellidos</label> 

            <div class="input-group">

              <input class="form-control" id="apellido" name="apellido" placeholder="Contacto" required type="text"/>

            </div>

        </div>



        <div class="form-group">

          <label for="username">Direccion</label> 

            <div class="input-group">

                <input class="form-control"  id="direccion" name="direccion" required type="text" placeholder = "Direccion Residencia"/>

            </div>

        </div>


        <div class="form-group">

          <label for="username">Complemento Direccion</label> 

              <div class="input-group">

                    <input class="form-control"  id="compdireccion" name="compdireccion" required type="text" placeholder = "Complemento Direccion"/>

              </div>

        </div>



        <div class="form-group">

          <label for="username">Telefono</label> 

            <div class="input-group">

              <input class="form-control" type="text"  id="telefono" name="telefono" required tabindex="4" placeholder = "Telefono Residencia" style="text-transform: uppercase">

            </div>

        </div>

        <div class="form-group">

          <label for="username">Otro Telefono</label> 

            <div class="input-group">

                <input class="form-control" id="celular" name="celular" required type="text" placeholder = "Otro Telefono" tabindex="5" style="text-transform: uppercase">

            </div>

        </div>

        <div class="form-group">

          <label for="username">Email</label> 

            <div class="input-group">

                <input class="form-control" id="email" name="email" required type="text" placeholder = "Correo Electronico" tabindex="5" style="text-transform: uppercase">
            
            </div>

        </div>

        <div class="form-group">

            <label for="username">Fecha Nacimiento</label>

                <div class="input-group">

                    <input class="form-control" id="nacimiento" name="nacimiento" required type="text" placeholder = "Correo Electronico" tabindex="5" style="text-transform: uppercase">
  
                </div>

        </div>

 

        <input class="subscribe btn btn-primary btn-block rounded-pill shadow-sm" onClick="addCliente()" name="submit" id="submit" value="Agregar" >   

   </form>


  </div>
</div>


</body>

</html>

<?php
}
?>
