<?php

session_start();

if($_SESSION['admon_mod'] != 0 || $_SESSION['admon_mod'] != ""  )  {

$modulos = $_SESSION['admon_mod'];

?>

<!doctype html>

<html>

<head>

<meta charset="UTF-8">


<title>:: YOUCODE</title>

<style type="text/css">
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

<script>

$(document).ready(function(){

  document.body.style.zoom = "75%";
});

</script>

<script type="text/javascript">

function acepta(){

     motivo = document.getElementById("motivo_caja").value;

     newvalue = document.getElementById("newvalue").value;

     fecha = document.getElementById("fecha").value;

   $.ajax({ url: "../back-end/Source/Caja_Menor.php",
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: { "oper" : 2,"tipo" : 99,  "motivo" : motivo, "saldo" : newvalue, "fecha" : fecha },

         success: function(json){

          //console.debug(json.mensaje[0].success);

          var response = json.data[0].success;

         if(response = "t"){

          alert(json.data[0].mensaje);
          window.opener.location.reload(false);
          window.close();


         }else{
           alert(json.data+"\n" + json.code);
         }

         }

       });
  }

</script>

<script type="text/javascript" src="js/jquery.js" ></script>
<script type="text/javascript" src="js/add.js"  ></script>



<body >

<div  class="form">
            <form id="contactform">


              <div id="dialog" title="BASE A CAJA MENOR">


<label>Fecha</label>

<input type="text" id="fecha" size="40" value="<?php echo date('Y-m-d h:m:s') ?>" style="background-color: #faa;width:200px; height:20px;" /><br />
<br />


<label>Concepto Caja</label>



                  <select class="select-style" name="const" id="const">
                  <option value="99">BASE</option>
                    </select>

                    <br />
                    <br />


<label>MOTIVO</label>

<input type="text" id="motivo_caja" size="40" value="" style="background-color: #faa;width:200px; height:20px;" /><br />
<br />

<label>VALOR</label>

<input type="text" id="newvalue" size="40" value="" style="background-color: #faa;width:200px; height:20px;" /><br />
<br />


</div>

                      <input class="buttom" onclick="acepta()" name="submit" id="submit" tabindex="5" value="Agregar" type="button" >

               </form>

</div>

</body>

</html>

<?php
}
?>
