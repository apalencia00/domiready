/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function cargarOperacionServicio(){
    
      $.ajax({ url: "../Source/Parametrico.php", 
         type: "GET",
         contentType: "application/json",
         dataType: 'json',
         data: {"oper" : 4 },
         success: function(json){

          try{ 
             
              var json_string = JSON.stringify(json);
              var jsonObj = JSON.parse(json_string);
    
    $.each(jsonObj,function(key, value) 
{
    $select.append('<option value=' + key + '>' + value + '</option>');
});


     }catch(e){}

         }
    
    
});

}

function cargarMobil(){
    
}

function cargarRepartidor(){
    
}



