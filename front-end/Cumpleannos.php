

<!DOCTYPE html>
<html>
<head>
  <title>SERVICIOS EXPRESS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/minified/jquery-ui.min.css" type="text/css" />
  
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

  <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js" ></script>


<script>

function editar(ident){

 $.ajax({ url: "../back-end/Source/Parametrico_Cliente.php", 
      
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
            data: {"oper":8, "ident" : ident },   

            success : function(json){

                $("input#nombre")[0].value = json.data[0].nomb_completo;
                $("input#apellido")[0].value = json.data[0].cliapell ;
                $("input#direccion")[0].value = json.data[0].clidire;
                $("input#telefono")[0].value =  json.data[0].clitel;
                $("input#otrotelefono")[0].value = json.data[0].clicel;
                $("input#email")[0].value = json.data[0].clicorreo;
                $("input#compdireccion")[0].value = json.data[0].comp_dire;


            }      

        });



  $("input#ident")[0].value = ident ;
 $('.dialog').css('display','block');
      var dialog1 = $("#dialog").dialog({ 
                        autoOpen: false,

                        height: 300,
                        width: 400,
                        modal: true,
                        buttons: {
           "Guardar": function(){

            var valid = true;
            var ident  = $("input#ident");
            var nombre = $("input#nombre");
            var apellido = $("input#apellido");
            var direccion  = $("input#direccion");
            var telefono = $("input#telefono");
            var email = $("input#email");
            var compdire = $("input#compdireccion");
            var otrotelefono = $("input#otrotelefono");

      
          if( nombre[0].value != "" || apellido[0].value != "" || direccion[0].value != "" || telefono[0].value != ""  ){

          $.ajax({ url: "../back-end/Source/Parametrico_Cliente.php", 
      
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
            data: {"oper":7, "ident" : ident[0].value ,"nomb" : nombre[0].value, "ape" : apellido[0].value, "dire" : direccion[0].value, "comp_dire" : compdire[0].value  ,"tel" : telefono[0].value , "email" : email[0].value, "celular" : otrotelefono[0].value },         

        });
          alert("Datos de Cliente Actualizados");
         dialog1.dialog("close");
       }else{
        alert("Campos vacios");
       }

          }
        }
});

// load content and open dialog
dialog1.dialog('open');


}


function buscarCliente(e){


var key=document.all ? e.which : e.keyCode;

  if (key == 13) {
    e.preventDefault();
 
    var telef = document.getElementById("telcliente").value;
    var nombress = document.getElementById("nomcliente").value;
 

    $.ajax({ url: "../back-end/Source/Parametrico_Cliente.php", 
     type: "GET",
     contentType: "application/json",
     dataType: 'json',
     data: { "oper" : 6 , "tel" : telef, "nom" : nombress},
     
     success: function(json){ 

      if(json.root != null){ 
           
           var res = json.success;                               
                  
           if(res){
            var json_string = JSON.stringify(json.root);
            var jsonObj = JSON.parse(json_string);
      var html = '<table class="table table-striped" border="0">';
   
      $.each(jsonObj, function(key, value){
        
      
        html += '<tr> <td width="10%" ><a   >  </a>  '  +  '</td>' + '<td width="10%" >' + jsonObj[key].n_ide + '</td>' + '<td width="10%" >' +  jsonObj[key].clinom + '</td>' + '<td width="10%" >' +  jsonObj[key].cliapell + '</td>' + '<td width="10%" >' +  jsonObj[key].clidire + '</td>' + '<td width="10%" >'  + jsonObj[key].comp_dire + '</td>' + '<td width="10%">' +  jsonObj[key].clitel + '</td>' + '<td width="10%" >' +  jsonObj[key].clicorreo + '</td>' + '<td width="10%" >' +  jsonObj[key].clicel + '</td>'   +'<td width="15%" ><a id="editar" onclick="editar('+jsonObj[key].n_ide+')"  > editar </a>  '  +  '</td>';
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


}


  
</script>

<script>

$(document).ready(function(){

  document.body.style.zoom = "75%";

});



</script>

</head>

<body >

<div id="wrapper">

<form id="form" name="form" method="post" action="" class="register">


<div class="card">
  <div class="card-header">
    Clientes de Cumpleaños
  </div>
  <div class="card-body">
    <h5 class="card-title">Aplica para clientes que cumplen años</h5>


            
            <table class="table table-striped" id="tableID" width="80%" height="70%" align="center" >

                  <thead>
                    <tr>
                      <td width="10%" >ID</td>
                      <td width="10%" >IDENTIFICACION</td>
                      <td width="10%" >NOMBRE</td>
                      <td width="10%" >CONTACTO</td>
                      <td width="10%" >DIRECION</td>
                      <td width="10%" >COMP.DIRECCION</td>
                      <td width="10%" >TELEFONO</td>
                      <td width="10%" >EMAIL</td>
                      <td width="10%" >CELULAR</td>
                    </tr>

                    </thead>

                    <tbody id="tbody">
                        <tr>
                            <td colspan="13">
                                <div id="act_table" style="width: 100%; height: 200px; overflow-y: scroll;" > </div>
                            </td>
                        </tr>

                    </tbody>

            </table>


  </div>
</div>
 

</body>
</html>
