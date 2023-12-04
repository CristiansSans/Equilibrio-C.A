<?php
include 'cabezera.php';
?>
<div class="modals" style="position:absolute;top:20%;left:25%;">
    
          <div class="wrap-login100 agregarPeliculaTwo">
            <form class="login100-form validate-form" method="post" id="formIngreso" enctype="multipart/form-data">
              <span class="login100-form-title ">
                Editar Empleado
              </span>
              <span class="login100-form-title p-b-18">
                <i class="zmdi zmdi-font"></i>
              </span>

              <div class="wrap-input100 validate-input">
                <input class="input100 editNameTipo" type="text" name="cedula" placeholder="Cedula..."  required>
              </div>
              <div class="wrap-input100 validate-input">
                <input class="input100 editNameServicio" type="text" name="nombre" placeholder="Nombre..."  required>
              </div>
              <div class="wrap-input100 validate-input">
                <input class="input100 editComision" type="number" name="comision" placeholder="Comisión..."  required>
              </div>
              <input class="input100 editNameTipoAnterior" type="text" hidden name="tipoAnterior" placeholder="Nombre..."  required>

              <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                  <div class="login100-form-bgbtn"></div>
                  <button class="login100-form-btn EditadoTipo" >
                    Editar Empleado
                  </button>
                </div>
              </div>
            </form>
             <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                  <div class="login100-form-bgbtn"></div>
                  <button class="login100-form-btn cerrarEditado" type="button">
                    Cerrar
                  </button>
                </div>
              </div>
          </div>
</div>
<div class="maldito container-fluid " style="display: none;">
            <center><h3 class="reporteEmple"></h3> </center>
            <table id="id01" class="table">
              <thead class="thead">
                <tr style="text-align: center;padding: 2px;">
                  <th style="padding: 2px;">Servicio</th>
                  <th style="padding: 2px;">Comisión</th>
                </tr>
              </thead>
              <tbody class="tBodyReport">
           

              </tbody>
            </table>



          </div>

<div class="modalsNew">
    
          <div class="wrap-login100 agregarPeliculaTwo">
            <form class="login100-form validate-form" method="post" id="formIngreso" enctype="multipart/form-data">
              <span class="login100-form-title ">
                Nuevo empleado
              </span>
              <span class="login100-form-title p-b-18">
                <i class="zmdi zmdi-font"></i>
              </span>

              <div class="wrap-input100 validate-input">
                <input class="input100 createCedula" type="text" name="cedula" placeholder="Cedula..."  required>
              </div>

              <div class="wrap-input100 validate-input">
                <input class="input100 createName" type="text" name="nombre" placeholder="Nombre..."  required>
              </div>

              <div class="wrap-input100 validate-input">
                <input class="input100 createComision" type="text" name="comision" placeholder="Comision..."  required>
              </div>

              <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                  <div class="login100-form-bgbtn"></div>
                  <button class="login100-form-btn CrearTipo" type="submit">
                    Crear Empleado
                  </button>
                </div>
              </div>
            </form>
             <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                  <div class="login100-form-bgbtn"></div>
                  <button class="login100-form-btn cerrarEditado" type="button">
                    Cerrar
                  </button>
                </div>
              </div>
          </div>
</div>
<div class="container">
	<center><h1>Editar Empleados</h1></center>
	<table class="table">
    <thead class="thead">
      <tr style="text-align: center;">
        <th>Cedula</th>
        <th>Empleado</th>
        <th>Comisión</th>
        <th>Editar</th>
        <th>Borrar</th>
        <th>Reporte</th>
      </tr>
    </thead>
    <tbody>
      <?php 
				$resultado= new gestorTiposController;
				$resultado->vistaTipos();
 			?>
    </tbody>
  </table>

 
</div>