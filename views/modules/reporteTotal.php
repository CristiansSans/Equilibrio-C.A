<div style="height: 10vh;z-index: 10;" class="container-fluid">
<?php
include 'cabezera.php';
?>
<button class="print">Imprimir <span class="fa fa-print" style="color:black"></span></button>

</div>

				
          <div class="container-fluid cambioPelicula thisHidden">
            <center><h3>Reporte Total</h3> </center>
            <table id="id01" class="table">
              <thead class="thead">
                <tr style="text-align: center;padding: 2px;">
                  <th style="padding: 2px;">Nombre</th>
                  <th style="padding: 2px;">Servicio</th>
                  <th style="padding: 2px;">Ganancia</th>
                  <th style="padding: 2px;">Comisión</th>
                  <th style="padding: 2px;">Total</th>
                </tr>
              </thead>
              <tbody>
                 <?php 
        $resultado = new gestorPeliculasController;
        $resultado->vistaVendidasReportes();
       ?>

              </tbody>
            </table>



          </div>

  
			
				
				