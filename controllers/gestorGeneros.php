<?php 
	
	class gestorGenerosController{

		public function vistaGeneros(){
			$resultadoGenero = gestorGenerosModel::gestorGeneros("servicios");

			foreach ($resultadoGenero as $row => $item) {
				
				?>
				<tr>
			      	<td style="text-align: center;"><?php echo $item['servicio'] ?></td>
			        <td style="text-align: center;"><?php echo $item['precio'] ?></td>
			        
			        <td class="editGene" style="font-size: 18px;cursor: pointer;text-align: center;"> <i class="fas fa-edit"></i> <input type="text" value="<?php echo $item['servicio'] ?>" hidden><input type="text" value="<?php echo $item['precio'] ?>" hidden></td>

			        <td class="EliminarGene" style="font-size: 18px;cursor: pointer;text-align: center;"> <i class="fas fa-trash"></i> <input type="text" value="<?php echo $item['id'] ?>" hidden></td>
			     </tr>
				<?php

			}
			?>
				<tr>
			      	<td style="text-align: center;"></td>
			        <td style="text-align: center;"></td>
			        <td style="text-align: center;"></td>
			        
			        <td class="newGene" style="font-size: 18px;cursor: pointer;text-align: center;">Nuevo <i class="fas fa-plus"></i></td>
			     </tr>
				<?php

		}

		public function vistaInventario(){
			$resultadoGenero = gestorGenerosModel::gestorGeneros("inventario");

			foreach ($resultadoGenero as $row => $item) {
				
				?>
				<tr>
			      	<td style="text-align: center;"><?php echo $item['nombre'] ?></td>
			        <td style="text-align: center;"><?php echo $item['cantidad'] ?></td>
			        <td style="text-align: center;"><?php echo $item['precio'] ?></td>
			        
			        <td class="editInv" style="font-size: 18px;cursor: pointer;text-align: center;"> <i class="fas fa-edit"></i> <input type="text" value="<?php echo $item['nombre'] ?>" hidden><input type="text" value="<?php echo $item['cantidad'] ?>" hidden><input type="text" value="<?php echo $item['precio'] ?>" hidden></td>

			        <td class="EliminarProducto" style="font-size: 18px;cursor: pointer;text-align: center;"> <i class="fas fa-trash"></i> <input type="text" value="<?php echo $item['id'] ?>" hidden></td>
			     </tr>
				<?php

			}
			?>
				<tr>
			      	<td style="text-align: center;"></td>
			        <td style="text-align: center;"></td>
			        <td style="text-align: center;"></td>
			        <td style="text-align: center;"></td>
			        <td class="newGene" style="font-size: 18px;cursor: pointer;text-align: center;">Nuevo <i class="fas fa-plus"></i></td>
			     </tr>
				<?php

		}


		public function vistaServicios(){
			$resultadoGenero = gestorGenerosModel::gestorGeneros("servicios");

			foreach ($resultadoGenero as $row => $item) {
				
				?>
				<tr class="selectServ">
					<td style="text-align: center;" hidden><input type="text" value="<?php echo $item['servicio'] ?>"></td>
			      	<td style="text-align: center;"><span class="conteoServ" type="number" style="border: 2px solid #715d79;padding: 5px 10px;margin-right: 15px;">0</span><?php echo $item['servicio'] ?></td>
			        <td style="text-align: center;"><?php echo $item['precio'] ?></td>
			        
			       <?php } 

		}

		public function editarGeneros(){
			

			if (isset($_POST['servicio'])) {
				$inspector = true;
				if ($_POST['servicio'] != $_POST['nombreCriminal']) {
				$conect=mysqli_connect("localhost","root","","equilibrio") or die("Error: ".mysqli_error());
				
				$valid = mysqli_query($conect,"SELECT servicio FROM servicios WHERE servicio='".$_POST['servicio']."'");
					if ( mysqli_num_rows($valid)>0) {
								echo'<script>
									swal({
								        title: "¡Error!",
								        text: "¡El servicio ya existe!",
								        icon: "error",
								    })
								    .then((result) => {
										if (result) {
											window.location = "servicios"
										}else{
											window.location = "servicios"
										}
									}) 
								</script>';	
								$inspector=false;		
					}
				}
			}

			if (isset($inspector) && $inspector == true) {
				
				$servicio = $_POST['servicio'];
				$nombreCriminal = $_POST['nombreCriminal'];
				$precio = $_POST['precio'];


		     	$datosController = array("servicio"=>$servicio,
		         						"precio"=>$precio,
		         						"nombreCriminal"=>$nombreCriminal
									);
		        
					
				$resultado = gestorGenerosModel::editarGeneros("servicios", $datosController);
				if ($resultado == "ok") {
					echo'<script>
									swal({
								        title: "¡Listo!",
								        text: "¡El servicio fue editado!",
								        icon: "success",
								    })
								    .then((result) => {
										if (result) {
											window.location = "servicios"
										}else{
											window.location = "servicios"
										}
									}) 
								</script>';	
				}
				else{
					echo'<script>
									swal({
								        title: "¡Error!",
								        text: "¡Fallas tecnicas!",
								        icon: "error",
								    })
								    .then((result) => {
										if (result) {
											window.location = "servicios"
										}else{
											window.location = "servicios"
										}
									}) 
								</script>';
				}

				
			}
			
		}
		public function editarProducto(){
			

			if (isset($_POST['servicio'])) {
				$inspector = true;
				if ($_POST['servicio'] != $_POST['nombreCriminal']) {
				$conect=mysqli_connect("localhost","root","","equilibrio") or die("Error: ".mysqli_error());
				
				$valid = mysqli_query($conect,"SELECT nombre FROM inventario WHERE nombre='".$_POST['servicio']."'");
					if ( mysqli_num_rows($valid)>0) {
								echo'<script>
									swal({
								        title: "¡Error!",
								        text: "¡El producto ya existe!",
								        icon: "error",
								    })
								    .then((result) => {
										if (result) {
											window.location = "inventario"
										}else{
											window.location = "inventario"
										}
									}) 
								</script>';	
								$inspector=false;		
					}
				}
			}

			if (isset($inspector) && $inspector == true) {
				
				$nombreProducto = $_POST['servicio'];
				$nombreCriminal = $_POST['nombreCriminal'];
				$cantidad = $_POST['cantidad'];
				$precio = $_POST['precio'];


		     	$datosController = array("nombreProducto"=>$nombreProducto,"cantidad"=>$cantidad,
		         						"precio"=>$precio,
		         						"nombreCriminal"=>$nombreCriminal
									);
		        
					
				$resultado = gestorGenerosModel::editarInventario("inventario", $datosController);
				if ($resultado == "ok") {
					echo'<script>
									swal({
								        title: "¡Listo!",
								        text: "¡El producto fue editado!",
								        icon: "success",
								    })
								    .then((result) => {
										if (result) {
											window.location = "inventario"
										}else{
											window.location = "inventario"
										}
									}) 
								</script>';	
				}
				else{
					echo'<script>
									swal({
								        title: "¡Error!",
								        text: "¡Fallas tecnicas!",
								        icon: "error",
								    })
								    .then((result) => {
										if (result) {
											window.location = "inventario"
										}else{
											window.location = "inventario"
										}
									}) 
								</script>';
				}

				
			}
			
		}

		public function crearGeneros(){
			

			if (isset($_POST['servicioCrear'])) {
				
				$conect=mysqli_connect("localhost","root","","equilibrio") or die("Error: ".mysqli_error());
				
				$valid = mysqli_query($conect,"SELECT servicio FROM servicios WHERE servicio='".$_POST['servicioCrear']."'");
				$inspector = true;
					if ( mysqli_num_rows($valid)>0) {
								echo'<script>
									swal({
								        title: "¡Error!",
								        text: "¡El servicio ya existe!",
								        icon: "error",
								    })
								    .then((result) => {
										if (result) {
											window.location = "servicios"
										}else{
											window.location = "servicios"
										}
									}) 
								</script>';
								$inspector = false;			
					}
				
			}

			if (isset($inspector) && $inspector == true) {
				
				$nombre = $_POST['servicioCrear'];							
		        $precio = $_POST['precioCrear'];
		     

		     	$datosController = array("nombre"=>$nombre,
		         						"precio"=>$precio
										
									);
		        
					
				$resultado = gestorGenerosModel::CrearGeneroModel("servicios", $datosController);
				if ($resultado == "ok") {
					echo'<script>
									swal({
								        title: "¡Listo!",
								        text: "¡El servicio fue creado!",
								        icon: "success",
								    })
								    .then((result) => {
										if (result) {
											window.location = "servicios"
										}else{
											window.location = "servicios"
										}
									}) 
								</script>';	
				}
				else{
					echo'<script>
									swal({
								        title: "¡Error!",
								        text: "¡Fallas tecnicas!",
								        icon: "error",
								    })
								    .then((result) => {
										if (result) {
											window.location = "servicios"
										}else{
											window.location = "servicios"
										}
									}) 
								</script>';
				}

				
			}
			
		}

		public function crearProducto(){
			

			if (isset($_POST['servicioCrear'])) {
				
				$conect=mysqli_connect("localhost","root","","equilibrio") or die("Error: ".mysqli_error());
				
				$valid = mysqli_query($conect,"SELECT nombre FROM inventario WHERE nombre='".$_POST['servicioCrear']."'");
				$inspector = true;
					if ( mysqli_num_rows($valid)>0) {
								echo'<script>
									swal({
								        title: "¡Error!",
								        text: "¡El producto ya existe!",
								        icon: "error",
								    })
								    .then((result) => {
										if (result) {
											window.location = "inventario"
										}else{
											window.location = "inventario"
										}
									}) 
								</script>';
								$inspector = false;			
					}
				
			}

			if (isset($inspector) && $inspector == true) {
				
				$nombre = $_POST['servicioCrear'];
				$cantidad = $_POST['cantidadCrear'];
		        $precio = $_POST['precioCrear'];
		     

		     	$datosController = array("nombre"=>$nombre,
		         						"precio"=>$precio,
		         						"cantidad"=>$cantidad
										
									);
		        
					
				$resultado = gestorGenerosModel::CrearProductoModel("inventario", $datosController);
				if ($resultado == "ok") {
					echo'<script>
									swal({
								        title: "¡Listo!",
								        text: "¡El producto fue creado!",
								        icon: "success",
								    })
								    .then((result) => {
										if (result) {
											window.location = "inventario"
										}else{
											window.location = "inventario"
										}
									}) 
								</script>';	
				}
				else{
					echo'<script>
									swal({
								        title: "¡Error!",
								        text: "¡Fallas tecnicas!",
								        icon: "error",
								    })
								    .then((result) => {
										if (result) {
											window.location = "inventario"
										}else{
											window.location = "inventario"
										}
									}) 
								</script>';
				}

				
			}
			
		}

		public function generoEliminadoController($tabla , $nombre)
		{
			$resultado = gestorGenerosModel::generoEliminadoModel($tabla, $nombre);

			return $resultado;
		}
		public function productoEliminadoController($tabla , $nombre)
		{
			$resultado = gestorGenerosModel::productoEliminadoModel($tabla, $nombre);

			return $resultado;
		}

	}
	
 ?>