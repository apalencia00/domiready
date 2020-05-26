
<!DOCTYPE html>
<html>
<head>

<meta charset='utf-8' />

<link rel="stylesheet" href="css/minified/jquery-ui.min.css" type="text/css" />
<link href='calendar/fullcalendar.css' rel='stylesheet' />
<link href='calendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<link rel="stylesheet" href="css/minified/jquery-ui.css">

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script src='calendar/lib/moment.min.js'></script>

<script src='calendar/fullcalendar.min.js'></script>
<script>

function consultarCliente(e)

{
  var key=document.all ? e.which : e.keyCode;

  if (key == 13) {

    e.preventDefault();
    
    var identi = document.getElementById("ide").value;
    var telef = document.getElementById("tel").value;
   
    


    $.ajax({ url: "../back-end/Source/Parametrico_Cliente.php", 
     type: "GET",
     contentType: "application/json",
     dataType: 'json',
     data: { "oper" : 2 , "ide" : identi, "tel" : telef, "nom" : "", "ape" : "","cel": "", "comp" : "" },
     
     success: function(json){ 

        var resp = json.success;

        if(resp){


         if(json.data != ""){
           
           var ides   = json.data[0].n_ide;
           var nombes = json.data[0].clinom;
           var cliapell = json.data[0].cliapell;
           var tels   = json.data[0].clitel;

          

           document.getElementById("ide").value = ides;
           document.getElementById("nom").value = nombes + cliapell;
           document.getElementById("tel").value = tels;
      
           document.getElementById("dirini").value = json.data[0].clidire;
           document.getElementById("correo").value = json.data[0].clicorreo;



         }else{

          confirmado = confirm('El cliente no existe en la base de datos, desea ingresarlo?');

          if(confirmado){

            window.localStorage.setItem("dato", telef);

            window.location = "Cliente.php";

          }

        }

      }

    }});

  }
  else{

    if(key == 40){
     document.getElementById("ide").value = "";
     document.getElementById("nom").value = "";
     document.getElementById("tel").value = "";
     document.getElementById("cel").value = "";
     document.getElementById("apell").value = "";
     document.getElementById("dirini").value = "";
     return true;


   }
 }

}

    $(document).ready(function() {

        $('#calendar').fullCalendar({


            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            navLinks: true, // can click day/week names to navigate views

            defaultDate: "<?php echo date('Y-m-d'); ?>",
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            selectHelper: true,
           
            editable: true,
            eventLimit: true, // allow "more" link when too many events

            select: function() {

                $('.dialog').css('display','block');

                var dialog1 = $("#dialog").dialog({ 
                    autoOpen: false,

                    height: 500,
                    width: 600,
                    modal: true,
                    buttons: {
                    "Guardar": function(){
                    
            var titulo = $("input#titulo");
            var correo = $("input#correo");
            var fechai = $("input#fechai");
            var fechaf = $("input#fechaf");
            var horai  = $("select#horai");
            var horaf  = $("select#horaf");
            var tele   = $("input#tel");
            var obs    = $("textarea#obs");
            var recoger = $("input#dirini");
            var entrega = $("input#dirdest");

         $.ajax({ 
         url: "../back-end/Source/ServicioProgramado.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: {"oper": 2, "titulo" : titulo[0].value ,"finicial" : fechai[0].value, "ffinal" : fechaf[0].value, "hinicial" : horai[0].value, "hfinal" : horaf[0].value, "telefono" : tele[0].value, "recogida" : recoger[0].value, "entrega" : entrega[0].value, "obs" : obs[0].value }, 
          
        });
         dialog1.dialog("close");  
         $('#calendar').fullCalendar('renderEvent', {"title" : titulo[0].value , "start" : fechai[0].value, "end" : fechaf[0].value }, true); // stick? = true
         
        
              }

            }


           });
                

// load content and open dialog
                dialog1.dialog('open');

                

               /* var eventData;
                if (title) {
                    eventData = {
                        title: title,
                        start: start,
                        end: end
                    };
                    
                }*/

            },


            events : '../back-end/Source/ServicioProgramado.php?oper=4',

            eventClick: function(event) {
        // opens events in a popup window
        var idecalen = event.id;

               $.ajax({ 
         url: "../back-end/Source/ServicioProgramado.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: {"oper": 5, "idecal" : idecalen }, 

         success : function(json){



              document.getElementById("ide").value = json[0].n_ide;
              document.getElementById("nom").value = json[0].nomb_completo;
              document.getElementById("titulo").value = json[0].title;
              document.getElementById("tel").value = json[0].cliente_telefono;
              document.getElementById("correo").value = json[0].email;
              document.getElementById("fechai").value = json[0].start;
              document.getElementById("fechaf").value = json[0].end;
              document.getElementById("dirini").value = json[0].locationsc;
              document.getElementById("obs").value = json[0].notes;
              document.getElementById("dirdest").value = json[0].remeber;
              var idwindow = json[0].id;




         }
          
        });


            $('.dialog').css('display','block');

                var dialog1 = $("#dialog").dialog({ 
                    autoOpen: false,

                    height: 500,
                    width: 600,
                    modal: true,
                    buttons: {
                    "Despachar": function(){
                    

             var ident =  document.getElementById("ide").value;
             var nomb  = document.getElementById("nom").value;
              document.getElementById("titulo").value;
             var tele = document.getElementById("tel").value;
              document.getElementById("correo").value;
              document.getElementById("fechai").value;
              document.getElementById("fechaf").value;
             var dirini = document.getElementById("dirini").value;
             var obs = document.getElementById("obs").value;
             var dirdest = document.getElementById("dirdest").value;

            


         $.ajax({ 
         url: "../back-end/Source/ServicioProgramado.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: {"oper": 6,  "ident" : ident, "nomb" : nomb, "tele" : tele, "dirini" : dirini, "dirdest" : dirdest, "obs" : obs }, 
          
        });
         dialog1.dialog("close"); 
         alert("Servicio Despachado con Exito");
         window.location = "Lista_Servicios.php";
        
              }

            }


           });
                

// load content and open dialog
                dialog1.dialog('open');



        return false;
      },



        });
        
    });

</script>
<style>

    body {
        margin: 40px 10px;
        padding: 0;
        font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
        font-size: 14px;
    }

    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }

</style>
</head>
<body>

    <div id='calendar'></div>

    <div id="dialog"  style="display:none" title="Evento Recordatorio">
        
         <form id="form_dialog" name="form_dialog" >
    <fieldset>

     <p>

     <label for="fecha">Titulo</label>
      <input  type="text" name="titulo" id="titulo"  class="text ui-widget-content ui-corner-all">

    </p>

    <p>

     <label for="fecha">Tel. Cliente</label>
      <input onkeypress="consultarCliente(event)" type="text" name="tel" id="tel"  class="text ui-widget-content ui-corner-all">

    </p>

        <p>

     <label for="fecha">Correo</label>
      <input type="text" name="correo" id="correo"  class="text ui-widget-content ui-corner-all">

    </p>

    <p>

      <label for="fecha">Fecha Inicial</label>
      <input type="text" name="fechai" id="fechai" value="<?php echo date('Y-m-d')?>" class="text ui-widget-content ui-corner-all">

      </p>

      <p>

      <label for="us">Fecha Final</label>
      <input type="text" name="fechaf" id="fechaf" class="text ui-widget-content ui-corner-all">

      </p>

       <p>
      
      <label for="us">Hora Inicial</label>
      <select name="horai" id="horai" class="text ui-widget-content ui-corner-all"> 
      <option value="12:00 AM" >12:00 AM</option>
      <option value="01:00 AM" >01:00 AM</option>
      <option value="02:00 AM" >02:00 AM</option>
      <option value="03:00 AM" >03:00 AM</option>
      <option value="04:00 AM" >04:00 AM</option>
      <option value="05:00 AM" >05:00 AM</option>
      <option value="06:00 AM" >06:00 AM</option>
      <option value="07:00 AM" >07:00 AM</option>
      <option value="08:00 AM" >08:00 AM</option>
      <option value="09:00 AM" >09:00 AM</option>
      <option value="10:00 AM" >10:00 AM</option>
      <option value="11:00 AM" >11:00 AM</option>
      <option value="12:00 PM" >12:00 PM</option>
      <option value="01:00 PM" >01:00 PM</option>
      <option value="02:00 PM" >02:00 PM</option>
      <option value="03:00 PM" >03:00 PM</option>
      <option value="04:00 PM" >04:00 PM</option>
      <option value="05:00 PM" >05:00 PM</option>
      <option value="06:00 PM" >06:00 PM</option>
      <option value="07:00 PM" >07:00 PM</option>
      <option value="08:00 PM" >08:00 PM</option>
      <option value="09:00 PM" >09:00 PM</option>
      <option value="10:00 PM" >10:00 PM</option>
      <option value="11:00 PM" >11:00 PM</option>
      <option value="12:00 PM" >12:00 PM</option>
      </select>

      </p>

      <p>
      
      <label for="us">Hora Final</label>
      <select type="text" name="horaf" id="horaf" class="text ui-widget-content ui-corner-all">
              <option value="12:00 AM" >12:00 AM</option>
      <option value="01:00 AM" >01:00 AM</option>
      <option value="02:00 AM" >02:00 AM</option>
      <option value="03:00 AM" >03:00 AM</option>
      <option value="04:00 AM" >04:00 AM</option>
      <option value="05:00 AM" >05:00 AM</option>
      <option value="06:00 AM" >06:00 AM</option>
      <option value="07:00 AM" >07:00 AM</option>
      <option value="08:00 AM" >08:00 AM</option>
      <option value="09:00 AM" >09:00 AM</option>
      <option value="10:00 AM" >10:00 AM</option>
      <option value="11:00 AM" >11:00 AM</option>
      <option value="12:00 PM" >12:00 PM</option>
      <option value="01:00 PM" >01:00 PM</option>
      <option value="02:00 PM" >02:00 PM</option>
      <option value="03:00 PM" >03:00 PM</option>
      <option value="04:00 PM" >04:00 PM</option>
      <option value="05:00 PM" >05:00 PM</option>
      <option value="06:00 PM" >06:00 PM</option>
      <option value="07:00 PM" >07:00 PM</option>
      <option value="08:00 PM" >08:00 PM</option>
      <option value="09:00 PM" >09:00 PM</option>
      <option value="10:00 PM" >10:00 PM</option>
      <option value="11:00 PM" >11:00 PM</option>
      <option value="12:00 PM" >12:00 PM</option>
      </select>
      </p>

      <p>

         <label for="fecha">Identificacion</label>
      <input type="text" name="ide" id="ide"  class="text ui-widget-content ui-corner-all">

      </p>


      <p>

         <label for="fecha">Nombres</label>
      <input type="text" name="nom" id="nom"  class="text ui-widget-content ui-corner-all">

      </p>

      <p>

      <label for="fecha">Recogida</label>
      <input type="text" name="dirini" id="dirini"  class="text ui-widget-content ui-corner-all">

      </p>

      <p>

      <label for="fecha">Entrega</label>
      <input type="text" name="dirdest" id="dirdest"  class="text ui-widget-content ui-corner-all">

      </p>

      <p>
      <label for="obs">Observacion</label>
      <textarea   id="obs" name="obs" cols="30" rows="3" style="background:#999;text-transform: uppercase" onKeyUp="javascript:this.value=this.value.toUpperCase();" required ></textarea>

      </p>

    </fieldset>


    </div>
     

</body>
</html>
