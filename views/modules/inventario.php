<div style="height: 10vh;z-index: 10000000000;" class="container-fluid">
<?php
include 'cabezera.php';
?>


</div>
<div class="modals" style="position:absolute;top:20%;left:25%;">
    
          <div  class="wrap-login100 agregarPeliculaTwo">
            <form class="login100-form " method="post" id="formIngreso" enctype="multipart/form-data">
              <span class="login100-form-title ">
                Editar Producto
              </span>
              <span class="login100-form-title p-b-18">
                <i class="zmdi zmdi-font"></i>
              </span>
              <span class="files">Nombre del Producto</span>
              <div class="wrap-input100">
                <input class="input100 editNameGene" type="text" name="servicio" placeholder="Nombre..."  required>
                <input class="inputNombre" type="text" value="" hidden="" name="nombreCriminal">
              </div>
				<span class="files">Cantidad</span>
              <div class="wrap-input100 ">
                <input class="input100 editCaratula inputCantidad" type="text" name="cantidad"  >
                
              </div>
              <span class="files">Precio</span>
              <div class="wrap-input100 ">
                <input class="input100 editCaratula inputPrec" type="text" name="precio"  >
                
              </div>
              
             


              <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                  <div class="login100-form-bgbtn"></div>
                  <button class="login100-form-btn" type="submit">
                    Editar Producto
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

<?php 
        $resultado= new gestorGenerosController;
        $resultado->editarProducto();
      ?>

<div class="modalsNew">
          <div class="wrap-login100 agregarPeliculaTwo">
            <form class="login100-form validate-form" method="post" id="formIngreso" enctype="multipart/form-data">
              <span class="login100-form-title ">
                Nuevo Producto
              </span>
              <span class="login100-form-title p-b-18">
                <i class="zmdi zmdi-font"></i>
              </span>

              <div class="wrap-input100 validate-input">
                <input class="input100 " type="text" name="servicioCrear" placeholder="Nombre del producto..."  required>
              </div>
              <div class="wrap-input100 validate-input">
                <input class="input100 " type="text" name="cantidadCrear" placeholder="Cantidad..."  required>
              </div>
              <div class="wrap-input100 validate-input">
                <input class="input100 " type="text" name="precioCrear" placeholder="Precio..."  required>
              </div>
              <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                  <div class="login100-form-bgbtn"></div>
                  <button class="login100-form-btn" type="submit">
                    Añadir Producto
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
<?php 
      $resultado= new gestorGenerosController;
      $resultado->crearProducto();
?>

</div>
<div class="container">
	<center><h1>Inventario</h1></center>
	<table class="table">
    <thead class="thead">
      <tr style="text-align: center;">
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Editar</th>
        <th>Eliminar</th>
      </tr>
    </thead>
    <tbody>
      <?php 
				$resultado= new gestorGenerosController;
				$resultado->vistaInventario();
 			?>
    </tbody>
  </table>

  
</div>