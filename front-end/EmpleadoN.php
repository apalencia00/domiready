<?php 

session_start(); 

if($_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != "" )  {

$modulos = $_SESSION['admon_mod'];

?>


<!doctype html>



<html>

<head>

<meta charset="UTF-8">


<title>Registro Empleado</title>

<style type="text/css">

form input[type="text"]:required:valid{
 border:2px solid green;
 /* otras propiedades */
}
/*caso contrario, el color sera rojo*/
form input[type="text"]:focus:required:invalid{
 border:2px solid red;
 /* otras propiedades */
}


.form{

    background:#f1f1f1; width:470px; margin:0 auto; padding-left:50px; padding-top:20px;

}

.form fieldset{border:0px; padding:0px; margin:0px;}

.form p.contact { font-size: 12px; margin:0px 0px 10px 0;line-height: 14px; font-family:Arial, Helvetica;}

 

.form input[type="text"] { width: 400px; }

.form input[type="email"] { width: 400px; }

.forminput[type="password"] { width: 400px; }

.form input.birthday{width:60px;}

.form input.birthyear{width:120px;}

.form label { color: #000; font-weight:bold;font-size: 12px;font-family:Arial, Helvetica; }

.form label.month {width: 135px;}

.form input, textarea { background-color: rgba(255, 255, 255, 0.4); border: 1px solid rgba(122, 192, 0, 0.15); padding: 7px; font-family: Keffeesatz, Arial; color: #4b4b4b; font-size: 14px; -webkit-border-radius: 5px; margin-bottom: 15px; margin-top: -10px; }

.form input:focus, textarea:focus { border: 1px solid #ff5400; background-color: rgba(255, 255, 255, 1); }

.form .select-style {

  -webkit-appearance: button;

  -webkit-border-radius: 2px;

  -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);

  -webkit-padding-end: 20px;

  -webkit-padding-start: 2px;

  -webkit-user-select: none;

  background-image: url(images/select-arrow.png),

    -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);

  background-position: center right;

  background-repeat: no-repeat;

  border: 0px solid #FFF;

  color: #555;

  font-size: inherit;

  margin: 0;

  overflow: hidden;

  padding-top: 5px;

  padding-bottom: 5px;

  text-overflow: ellipsis;

  white-space: nowrap;}

.form .gender {

  width:410px;

  }

.form input.buttom{ background: #4b8df9; display: inline-block; padding: 5px 10px 6px; color: #fbf7f7; text-decoration: none; font-weight: bold; line-height: 1; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; -moz-box-shadow: 0 1px 3px #999; -webkit-box-shadow: 0 1px 3px #999; box-shadow: 0 1px 3px #999; text-shadow: 0 -1px 1px #222; border: none; position: relative; cursor: pointer; font-size: 14px; font-family:Verdana, Geneva, sans-serif;}

.form input.buttom:hover    { background-color: #2a78f6; }


.form input.buttom_act{ background: #34AA54; display: inline-block; padding: 5px 10px 6px; color: #fbf7f7; text-decoration: none; font-weight: bold; line-height: 1; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; -moz-box-shadow: 0 1px 3px #999; -webkit-box-shadow: 0 1px 3px #999; box-shadow: 0 1px 3px #999; text-shadow: 0 -1px 1px #222; border: none; position: relative; cursor: pointer; font-size: 14px; font-family:Verdana, Geneva, sans-serif;}

.form input.buttom_act:hover    { background-color: #34AA54; }

</style>

<script type="text/javascript" src="../js/jquery.js" ></script>
<script type="text/javascript" src="../js/ajax.js"  ></script>

<script type="text/javascript">
  
function cargarTipoEmpleo(){

 $.ajax({ url: "../Source/Parametrico_Empleado.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "oper" : 1 },
                 
         success: function(json){ 
             
             console.log(json);
             
                var $select = $('#tipo'); 
                $select.find('option').remove();  
                
                for(var i = 0; json.length; i ++){
                
                $select.append('<option value=' + json[i]['id_templeo'] + '>' + json[i]['descripcion'] + '</option>');
            }
    }});

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


<div  class="form">
            <form id="contactform">


                <p class="contact"><label for="identificacion">Identificacion</label></p>
                
<input id="identificacion" name="identificacion" placeholder="Numero de indentificacion" required tabindex="1" type="text" >
 

              
                <p class="contact"><label for="nonmbre">Nombres</label></p>

                <input id="nonmbre" name="nonmbre" placeholder="Nombre completo" required tabindex="2" type="text" style="text-transform: uppercase">


                <p class="contact"><label for="apellido">Apellidos</label></p>

                <input id="apellido" name="apellido" placeholder="Apellido completo" required tabindex="3" type="text" style="text-transform: uppercase">

 

                <p class="contact"><label for="direccion">Direccion</label></p>

                <input  id="direccion" name="direccion" required type="text" tabindex="4" style="text-transform: uppercase">


                  <p class="contact"><label for="telefono">Telefono</label></p>

                <input  id="telefono" name="telefono" required type="text" tabindex="5">


                  <p class="contact"><label for="celular">Celular</label></p>

                <input  id="celular" name="celular" required type="text" tabindex="6">



        
              <fieldset>

                <label>Tipo Empleo</label>

    

                  <select class="select-style" name="tipo" id="tipo" >

                           
                 </select>   




               
              </fieldset>

<br>
<br>

 <fieldset>

                <label>Suc</label>

                  <label class="month">

                      <select class="select-style" name="suc" id="suc">

    
                  <option  value="C">C</option>

                  <option value="N">N</option>

                  </label>

                 </select>   




               
              </fieldset>

              <br>
<br>


               <p class="contact"><label for="mobil">N. Mobil</label></p>

                   

                        <input  id="mobil" name="mobil" required="" type="text" tabindex="7" value="">

                 </select>   


              <br>
              <br>

            <input class="buttom" onclick="addEmpleado()" name="submit" id="submit" tabindex="5" value="Agregar" type="button">   

            <input class="buttom_clean" name="limpiar" id="limpiar" tabindex="5" value="Limpiar" type="button">  

            <input class="buttom_del" name="borrar" id="borrar" tabindex="5" value="Borrar" type="button">  

   </form>

</div>

</body>

</html>

<?php
}
?>