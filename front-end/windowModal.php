<!DOCTYPE html>
<html>
<head>
	<title>DESPACHOS NORTE</title>

<link rel="stylesheet" type="text/css" href="css/stylodes.css" />
<script type="text/javascript" src="js/jquery.js" ></script>
<script type="text/javascript" src="js/ajax.js"  ></script>

<script type="text/javascript">

function proceder(){

var ide = document.getElementById("ide").value;

var num = document.getElementById("num").value;

var nomb = document.getElementById("nomb").value;

var tele = document.getElementById("tele").value;

var cel = document.getElementById("cel").value;

var fecha = document.getElementById("fecha").value;

var num_mobilre = document.getElementById("num_mobilre").value;

var obs = document.getElementById("servicio").value;

var diro = document.getElementById("diro").value;

var dird = document.getElementById("dird").value;

var comp_dir = document.getElementById("comp_dir").value;

var comp_diredest = document.getElementById("comp_diredest").value;

var dirv1 = document.getElementById("dirv1").value;

var dirv2 = document.getElementById("dirv2").value;

var dirv3 = document.getElementById("dirv3").value;

var dirv4 = document.getElementById("dirv4").value;

var dirv5 = document.getElementById("dirv5").value;

var dirv6 = document.getElementById("dirv6").value;


var dirv7 = document.getElementById("dirv7").value;


if(num_mobilre != "0"){

  $.ajax({ url: "../back-end/Source/Servicio_Despacho_Norte.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "oper" : 7 , "num" : num , "nomb" : nomb, "tele" : tele, "celular" : cel  ,"num_mobilre" : num_mobilre , "obs" : obs, "diro" : diro, "comp_dir" : comp_dir, "dird" : dird, "comp_diredest" : comp_diredest, "dirv1" : dirv1, "dirv2" : dirv2, "dirv3" : dirv3, "dirv4" : dirv4, "dirv5" : dirv5, "dirv6" : dirv6, "dirv7" : dirv7  },
     
      success: function(json){ 
          
               console.log(json.data[0].success);
        var res = json.data[0].success;

        if(res == "t"){
            
            alert(json.data[0].mensaje);
            window.opener.location.href = window.opener.location.href;
            window.close();
        }else{
            alert("Error al despachar servicio en Norte");
        }
    
    }

});

}else{
  alert("Seleccione un Movil Valido");
}




}

function obtenerDatos(){

    var num_ide = document.getElementById("num").value;

    $.ajax({ url: "../back-end/Source/Servicio_Despacho_Norte.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "oper" : 9, "num" : num_ide},
     
      success: function(json){ 

        console.log(json);

         var content = json.root[0].obs;
    $("#servicio").val(content);

    console.log(json.root[0].n_ide);

    //document.getElementById("tele").value =json.root[0].dir_proc;
          
         document.getElementById("ide").value = json.root[0].n_ide;

       
         document.getElementById("nomb").value = json.root[0].nombre_completo;

         document.getElementById("tele").value = json.root[0].clitel;

         document.getElementById("cel").value = json.root[0].clicel;

         //document.getElementById("total").value = json.root[0].total;

         //document.getElementById("servicio").value = json.root[0].obs;

         document.getElementById("diro").value = json.root[0].dir_proc;

         document.getElementById("dird").value = json.root[0].dir_dest;

         document.getElementById("dirv1").value = json.root[0].dir_rta1;

         document.getElementById("dirv2").value = json.root[0].dir_rta2;

         document.getElementById("dirv3").value = json.root[0].dir_rta3;

         document.getElementById("dirv4").value = json.root[0].dir_rta4;

         document.getElementById("dirv5").value = json.root[0].dir_rta5;

         document.getElementById("dirv6").value = json.root[0].dir_rta6;
   
         document.getElementById("dirv7").value = json.root[0].dir_rta7;


          document.getElementById("comp_dir").value = json.root[0].comp_dire;
          
          document.getElementById("comp_diredest").value = json.root[0].comp_diredest;

    }

});



}
	

function buscarRepartidor(){

$.ajax({ url: "../back-end/Source/Parametrico.php", 
      
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
            data: {"oper":19 },         
         success: function(json){
             
             //console.log(json);

             try{ 
             
              var $select = $('#num_mobilre'); 
                               
                for(var i = 0; json.length; i ++){
                
                $select.append('<option value=' + json[i]['n_ide'] + '>' + json[i]['num_mob'] + '</option>');
            }
             
    }catch(e){}

     }
    
        });
        
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
             try{ 
             
              var $select = $('#repartidor'); 
                $select.find('option').remove();  
                                
                $select.append('<option value=' + json['n_ide'] + '>' + json['empnom'] + '</option>');
            
    }catch(e){}

   }
    
        });
        
             
             
             
         }


 $(document).ready(function(){
       buscarRepartidor();
obtenerDatos();

     
     
    });


</script>

</head>

<body>

<form id="form1" name="form1"   class="register" >


  <h1>Domicilios Norte   # <?php echo $_GET['id_orden'] ?></h1>

  <fieldset class="row1">
                <legend>Datos Cliente
            </legend>


<p>

<label>ID</label>
    <input id="ide" name="ide" type="text" readonly=""  />
    
    <input id="num" name="num" type="hidden" value="<?php echo $_GET['id_orden'] ?>" readonly  />

<label>NOMBRE(S) Y APELLIDO(S)</label>
    <input id="nomb" name="nomb" type="text"   />


  <label>TELEFONO</label>
    <input id="tele" name="tele" type="text"   />


</p>


<p>
<label>CELULAR</label>
    <input id="cel" name="cel" type="text"   />

    <label>FECHA E</label>
    <input id="fecha" name="fecha" type="text" value="<?php echo date('Y-m-d h:m:s') ?>"  />

<label> Mobil * </label>
                
                <select required style="width:auto" id="num_mobilre" name="num_mobilre" class="select-style" onchange="buscarNombreRepartidor(this.value)" >
              
              <option value="0"> Seleccione :  </option>
      
              </select>

              <label> Nombre * </label>
                <select style="width:200px" id="repartidor" name="repartidor" class="select-style">
            
            <option value="0"> Seleccione: </option>
      
      
            </select>


</p>

<p>
  
<label> DIRECCION ORIGEN </label>
  <input id="diro" name="diro" type="text"   />
  
  
   <label>COMPLEMENTO ORIGEN</label>
  
  <input id="comp_dir" name="comp_dir" type="text"   />
  
  
  <label>DIRECCION DESTINO</label>
  
  <input id="dird" name="dird" type="text"   />
  
  
  <label>COMPLEMENTO DESTINO</label>
  
  <input id="comp_diredest" name="comp_diredest" type="text"   />
  
  </p>
  
  <p>
  
  
  <label>DIRECCION DESVIO 1</label>
  
  <input id="dirv1" name="dirv1" type="text"   />
  
</p>

<p>

 <label>DIRECCION DESVIO 2</label>
  
  <input id="dirv2" name="dirv2" type="text"   />


  <label>DIRECCION DESVIO 3</label>
  
  <input id="dirv3" name="dirv3" type="text"   />

  <label>DIRECCION DESVIO 4</label>
  
  <input id="dirv4" name="dirv4" type="text"   />

</p>


<p>

<label>DIRECCION DESVIO 5</label>
  
  <input id="dirv5" name="dirv5" type="text"   />

  <label>DIRECCION DESVIO 6</label>
  
  <input id="dirv6" name="dirv6" type="text"   />


   <label>DIRECCION DESVIO 7</label>
    
    <input id="dirv7" name="dirv7" type="text"   />

</p>

<p>

<label class="">Observacion *
    </label>
    
    <textarea id="servicio" name="servicio" cols="30" rows="3" style="background:#CCC;text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" ></textarea>

</p>


<input type="button" id="save" name="save" onclick="proceder()" value="GUARDAR" class="button_registrar"  /> </td>



</form>

</body>

</html>


