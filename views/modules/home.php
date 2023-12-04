<div style="height: 10vh;z-index: 1000;" class="container-fluid">
<?php
include 'cabezera.php';
?>


</div>
	
<div style="margin-top: 50px;" class="container-fluid enter">
  
    <div class="row">
 
  <div class="col-sm-4 tablas">

    <input id="myInput1" oninput="w3.filterHTML('#id01', '.item', this.value)" class="inputVenta inputServicio" type="text" style="width: 31%;"  name="servicio" autofocus placeholder="Empleada...">
    <input type="text" hidden class="ComisionEscondida">
    <input type="text" hidden class="ServicioEscondido">
    
  <table id="id01" class="table" style="margin-top: 80px;">
    <thead class="thead" >
      <tr style="text-align: center">
        <th>Empleadas</th>
        <th>Comision Total</th>
        
      </tr>
    </thead>

    <tbody>
     <?php 
        $resultado= new gestorPeliculasController;
        $resultado->vistaTrabajadorController();
      ?>
    </tbody>
  </table>
</div>


<div class="col-sm-4 tablas">
    <input id="myInput1" style="width: 20%;" class="inputVenta inputVent" type="text" placeholder="Precio..." >
    <button class="cleanVenta">Procesar <i class="fas fa-check-circle"></i></button>
    <button class="reload"><i class="fas fa-redo"></i></button>
  <table class="table table-hover">
    <thead class="thead" >
      <tr style="text-align: center;">  
        <th>Servicio</th>
        <th>Precio</th>    
      </tr>
    </thead>

    <tbody class="tbody">
      
      <?php 
        $resultado= new gestorGenerosController;
        $resultado->vistaServicios();
      ?>
    </tbody>
  </table>
  
</div>
  <div class="col-sm-4 tablas">
    <?php 
        $resultado= new gestorPeliculasController;
        $resultado->vistaVentaInput();
      ?>
        <p class="cleanVentass">Total <i class="fas fa-tag" style="float:right;margin-top: 5px;"></i></p>           
  <table class="table" style="margin-top: 80px;">
    <thead style="background-color: #715d79 !important" >
      <tr style="text-align: center;">
        <th>Empleadas</th>
        <th>Servicio</th>
        <th>Ganancia</th>
        <th>Comision</th>
        <th>Total</th>
        <th>Borrar</th>
      </tr>
    </thead>

    <tbody class="bodyTotal">
      <?php 
        $resultado = new gestorPeliculasController;
        $resultado->vistaVendidas();
       ?>
      
    </tbody>
  </table>
</div>
 </div>
</div>