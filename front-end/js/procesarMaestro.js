function proceder() {

//
var operacion = document.getElementById("operacion").value;

var ide = document.getElementById("ide").value;

var num = document.getElementById("num").value;

var valor = document.getElementById("total").value;

var tipo_pago = document.getElementById("t_pago").value;

var nomb = document.getElementById("nomb").value;

var tele = document.getElementById("tele").value;

var cel = document.getElementById("cel").value;

var fecha = document.getElementById("fecha").value;

var num_mobilre = document.getElementById("num_mobilre_mod").value;

var diro = document.getElementById("diro").value;

var dird = document.getElementById("dird").value;

var dirdesv1 = document.getElementById("dirdesv1").value;

var dirdesv2 = document.getElementById("dirdesv2").value;

var dirdesv3 = document.getElementById("dirdesv3").value;

var dirdesv4 = document.getElementById("dirdesv4").value;

var dirdesv5 = document.getElementById("dirdesv5").value;

var dirdesv6 = document.getElementById("dirdesv6").value;

var dirdesv7 = document.getElementById("dirdesv7").value;

var obs      = document.getElementById("servicio").value;

var compor = document.getElementById("comp_origen").value;

var compdest = document.getElementById("comp_destino").value;

var idavuelta = document.getElementById("idavuelta").value;


if( operacion != 0 && num_mobilre != "" && tipo_pago != 0 ){

  $.ajax({ url: "../back-end/Source/Servicio_Despacho.php", 
   type: "GET",
   contentType: "application/json",
   dataType: 'json',
   data: { "oper" : 7 , "operacion" : operacion, "ide" : ide, "num" : num, "valor" : valor, "tpago" : tipo_pago, "nomb" : nomb, "tele" : tele, "cel" : cel, "num_mobilre" : num_mobilre, "diro" : diro, "dird" : dird, "dirdesv1" : dirdesv1, "dirdesv2" : dirdesv2, "dirdesv3" : dirdesv3, "dirdesv4" : dirdesv4, "dirdesv5" : dirdesv5, "dirdesv6" : dirdesv6, "dirdesv7" : dirdesv7, "obs" : obs, "comp_dir" : compor, "comp_diredest" : compdest, "idavuelta" : idavuelta },

   success: function(json){ 
          //var dirdesv4 = document.getElementById("dirdesv4").value;
          //console.log("Aqui entro// bacano");
        var res = json[0].success;//

        if(res=="t"){
			//console.debug(json);
      alert(json[0].mensaje);
      
    }else{
      alert(json[0].mensaje);
    }
    
  }

});

}else{
  alert("Seleccine operacion servicio valido y movil");
}



}


function transaccion_operacion(valor){

  if(valor === "2" || valor === "3"){

    $('#num_mobilre').prop('disabled', 'disabled');
    $('#num_mobilre').prop('disabled', 'disabled');
    document.getElementById("total").value = "$ 0.00";

    var valid = true;

    var c = $("#form").serialize();


    $('.dialog').css('display','block');

    var dialog1 = $("#dialog").dialog({ 
      autoOpen: false,

      height: 400,
      width: 400,
      modal: true,
      buttons: {
       "Guardar": function(){
        var serv = $("input#numservicio");
        var fech = $("input#fechasys");
        var usu  = $("input#usu");
        var obs = $("textarea#obs");

        vserv = serv[0].value;
        vfech = fech[0].value;
        vusu  = usu[0].value;
        value = obs[0].value;
        var regex = new RegExp('^[A-Z0-9]$');
        valid = valid && regex.test(value);

        if(value != ""){

         $.ajax({ 
           url: "../back-end/Source/Servicio_Despacho.php", 
           type: "GET",
           contentType: "application/json",
           dataType: 'json',
           data: {"oper": 16, "serv" : vserv, "fecha" : vfech, "usu" : vusu, "obs" : value, "estado" : valor }, 

         });


         alert("Información de Servicio Actualizada");
         dialog1.dialog("close");
         window.close();
         window.opener.location.reload(false);

       }else{

        alert("La observacion es obligatoria");

      }


    }
  }

});

// load content and open dialog
dialog1.dialog('open');




}


}

function buscarRepartidorMaestro(){

  $.ajax({ url: "../back-end/Source/Parametrico.php", 

   type: "GET",
   contentType: "application/json",
   dataType: 'json',
   data: {"oper":5 },         
   success: function(json){
          //alert(json);

          try{ 

          if(json != ""){

            var $select = $('#num_mobilre_mod'); 

            for(var i = 0; json.length; i ++){

              $select.append('<option value=' + json[i]['num_mob'] + '>' + json[i]['num_mob'] + '</option>');
            }

          }

           }catch(e){}

        }

      });

}


function pendiene(serv, nomb){


window.open("ObservacionPendiente.php?serv="+serv+"&user="+nomb, "_blank", "toolbar=yes, scrollbars=no, resizable=yes, top=500, left=500, width=400, height=220");

        

           }

           function cancelar(serv, nomb){

window.open("ObservacionCancelar.php?serv="+serv+"&user="+nomb, "_blank", "toolbar=yes, scrollbars=no, resizable=yes, top=500, left=500, width=400, height=220");


        
           }
