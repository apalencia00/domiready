
     <label>
       Operacion Servicio
     </label>

     <select id="operacion">

      <option value="1"> DESPACHO </option>
      <option value="5"> ENVIO NORTE </option>

    </select>




    <input id="fecha" name="fecha" class="" type="hidden" value="<?php echo date('Y-m-d H:i:s');?>"  />   
      <input id="usuario" name="usuario" class="" type="hidden" value="<?php echo $usuario;?>"  />        
  </p>

  <p>
   <label>Tipo Servicio *
   </label>
   <select id="tipo_serv" required> 

    <option value="1" > DOMICILIO </option>
    <option value="2" > CARGA </option>


  </select>




  <label>
    Servicio *

  </label>

  <input type="text" onkeypress ="busquedaServicio(event)" style="background-color: #faa;" id="idserv" name="idserv" required  />





</p>

<p>

  <label>Pago *
  </label>

  <select id="tipo_pago" name="tipo_pago" class="select-style" required>

   <option value="1" selected="selected" > EFECTIVO </option>
   <option value="2" > CREDITO </option>           
 </select>

 <label>Regresa *</label>
 <input id="s" name="regresar" type="radio" value="SI" required />
 <label class="gender">Si</label>
 <input id="n" name="regresar" type="radio" value="NO" checked="checked"/>
 <label class="gender">No</label>



</p>

<p>

  <label>Comision *
  </label>

  <select name="comision" id="comision" class="select-style" required>

  </select>     

  <p>

   <label> Origen * </label>

   <input type="text" id="dirini" name="dirini"  ondblclick="setDestino(this.value,document.getElementById('comp_dire').value)" onKeyPress="historial_By_Criteria(event, this.value)" style="text-transform: uppercase;width:200px" required  />


   <select id="ciudad_org" required> 

    <option value="Barranquilla, Colombia" selected > BARRANQUILLA </option>

    <option value="Soledad, Atlántico, Colombia" > SOLEDAD - ATLANTICO </option>

    <option value="Santa Marta, Colombia" > SANTA MARTA </option>

    <option value="Puerto Colombia, Atlántico" > PTO COLOMBIA </option>


  </select>


</p>

<p>
  <label> Complemento Origen </label>
   <input type="text" id="comp_dire" name="comp_dire" style="text-transform: uppercase;width:200px"/>


</p>

<p>

  <label> Destino * </label>

  <input type="text" id="dirdest" name="dirdest" ondblclick="setOrigen(this.value,document.getElementById('comp_diredest').value)" onKeyPress="historial_By_Criteria(event, this.value)" style="text-transform: uppercase;width:200px"  required  />

  <select id="ciudad_dest" required> 

    <option value="Barranquilla, Colombia" selected > BARRANQUILLA </option>

    <option value="Soledad, Atlantico, Colombia" > SOLEDAD - ATLANTICO </option>

    <option value="Santa Marta, Colombia" > SANTA MARTA </option>


  </select>
  
  </p>
  
  <p>
  
  
  <label>Complemento Destino</label>
  
  <input type="text" id="comp_diredest" name="comp_diredest" style="text-transform: uppercase;width:200px"/>
  

</p>

  <img src="images/add.png" name="add" width="32" height="29" id="add"  />   






<div class="input_fields_wrap">

 <p>

   <input type="text" placeholder="Desvio 1" class="input_fields_wrap" id="altori1" name="text" style="width:400px;display:none"  />


 </p>

 <p>              
   <input type="text" placeholder="Desvio 2" class="input_fields_wrap" id="altori2" name="text" style="width:400px;display:none"  /> 

 </p>

 <p>
  <input type="text" placeholder="Desvio 3" class="input_fields_wrap" id="altori3" name="text" style="width:400px;display:none"  />

</p>

<p>

  <input type="text" placeholder="Desvio 4" class="input_fields_wrap" id="altori4" name="text" style="width:400px;display:none"  />
</p>


<p>             
  <input type="text" placeholder="Desvio 5" class="input_fields_wrap" id="altori5" name="text" style="width:400px;display:none"  />

</p>


<p> 

  <input type="text" placeholder="Desvio 6" class="input_fields_wrap" id="altori6" name="text" style="width:400px;display:none"  />


</p>

<p>



  <input type="text" placeholder="Desvio 7" class="input_fields_wrap" id="altori7" name="text" style="width:400px;display:none"  />


</p>


</div>

</p>
<p>

 <label class="">Valor *
 </label>

 <input type="text" id="valor" name="valor" style="background:#faa" value="" required/>
 <input type="button" id="search" value="Calcular Distancia" />




</p>

<p>

 <label class="">Observacion *
 </label>

 <textarea   id="servicio" name="servicio" cols="30" rows="3" style="background:#FFF;text-transform: uppercase"  required ></textarea>

</p>

<p>
  <label> Movil * </label>

  <select style="width:auto" id="num_mobilre" name="num_mobilre" class="select-style" onchange="buscarNombreRepartidor(this.value)" required="required" >

   <option value="-1"> SELECCIONE </option> 

 </select>

</p>

<p>
  <label> Nombre * </label>
  <select style="width:200px" id="repartidor" required="" > </select>


</p>










<div class="row">
<div class="col-xs-2">
        <div class="text-right">

<div class="btn-group">
<button type="submit" id="registro" name="registro" class="btn btn-info btn-lg btn btn-default pull-center RbtnMargin"   >
 <span class="" > </span> 
Aceptar
  </button>

  <button id="pendiente" name="pendiente" onclick="registrarPendiente()" type="button" class="btn btn-search btn-lg pull-center RbtnMargin">
    <span class=""></span> Pendiente
  </button>

</div>