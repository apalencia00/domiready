function registrarPendiente(){

	alert("DALE BACANO");

		var serv = document.getElementById("idserv").value;

	$.ajax({ url: "../Source/Servicio_Despacho.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: {"oper" : 17, "tipo" : 1, "serv" => serv},
         success: function(json){
                         
         if(json.success){
         
             alert(json.mensaje);

             location.reload(); 


         
             }else{
                  
                  alert(json.mensaje + "\n" + json.code);
             }
         
         }

     });

}