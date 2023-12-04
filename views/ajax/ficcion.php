<?php 
	require('../../models/conexion.php');
	require('../../models/consulta.php');
	require('../../models/gestorPeliculas.php');
	require('../../controllers/gestorPeliculas.php');
	require('../../models/gestorGeneros.php');
	require('../../controllers/gestorGeneros.php');
	require('../../models/ingresoCliente.php');
	require('../../controllers/ingresoCliente.php');
	
	
	
	class Ajax
	{
		
		public function editadoPelicula()
		{
			$genero = new gestorPeliculasController();

			$respuesta = $genero -> editarPeliculas($_POST['codigo']);

			header('Content-Type: application/json');

			echo json_encode($respuesta);

		}
		public function editadoPeliculaFormulario()
		{
			$genero = new gestorPeliculasController();

			$respuesta = $genero -> editarPeliculasFormulario($_POST['codigoCriminal'],$_POST['codigoDos'],$_POST['nombrePelicula'],$_POST['genero'],
				$_POST['cantidad'],
				$_POST['tipo'],
				$_POST['caratula'],
				$_POST['trailer'],
				$_POST['pelicula'],
				$_POST['fecha']);

			echo $respuesta;

		}

		public function borradoPelicula(){

			$delete = new gestorPeliculasController();
			$respuesta = $delete -> borrarPeli($_POST['codigoDelete']);
			if ($respuesta) {
				$respuesta = "ok";
			}
			echo $respuesta;
		}
		public function tipoEditado(){
			
			
			
				$editado = new gestorPeliculasController();
			$respuesta = $editado -> tipoEditadoController($_POST['cedulaEditado'], $_POST['nombreEditado'], $_POST['cedulaAnterior'], $_POST['porcentaje']);
			if ($respuesta) {
				$respuesta = "ok";
			}
			echo $respuesta;
			
			
		}
		public function tipoCreado(){

				$inspector = true;
				$conect=mysqli_connect("localhost","root","","equilibrio") or die("Error: ".mysqli_error());
				
				$valid = mysqli_query($conect,"SELECT cedula FROM trabajadores WHERE cedula='".$_POST['cedulaCreate']."'");
					if ( mysqli_num_rows($valid)>0) {
								echo'<script>
									swal({
								        title: "¡Error!",
								        text: "¡La cedula ya existe!",
								        icon: "error",
								    })
								    .then((result) => {
										if (result) {
											window.location = "editarPeliculas"
										}else{
											window.location = "editarPeliculas"
										}
									}) 
								</script>';
								$inspector = false;			
					}

					if (isset($inspector) && $inspector == true) {
						$creado = new gestorPeliculasController();
						$respuesta = $creado -> tipoCreadoController($_POST['cedulaCreate'], $_POST['nombre'], $_POST['comision']);
						if ($respuesta) {
							$respuesta = "ok";
						}
						echo $respuesta;
					}
			
		}
		public function eliminarTipo(){

			$eliminado = new gestorPeliculasController();
			$respuesta = $eliminado -> tipoEliminadoController($_POST['eliminarTipo']);
			if ($respuesta) {
				$respuesta = "ok";
			}
			echo $respuesta;
		}
		public function GeneroEliminar(){

			$eliminado = new gestorGenerosController();
			$respuesta = $eliminado -> generoEliminadoController("servicios", $_POST['GeneroEliminar']);
			if ($respuesta) {
				$respuesta = "ok";
			}
			echo $respuesta;
		}

		public function productoEliminar(){

			$eliminado = new gestorGenerosController();
			$respuesta = $eliminado -> productoEliminadoController("inventario" , $_POST['productoEliminar']);
			if ($respuesta) {
				$respuesta = "ok";
			}
			echo $respuesta;
		}

		public function ventaDiaria(){
			$venta = new gestorPeliculasController();
			$respuesta = $venta -> ventaDia($_POST['codigoVentas'] , $_POST['nombreVentas'] , $_POST['precioVentas'], $_POST['ceduClient']) ;

			
		}
		public function cambioPelicula(){
			$venta = new gestorPeliculasController();
			$respuesta = $venta -> cambioPeliculaController($_POST['cambioCodigo']);
			if ($respuesta) {
				$respuesta = "ok";
			}
			echo $respuesta;
			
		}
		public function cambioPeliculaDos(){
			$venta = new gestorPeliculasController();
			$respuesta = $venta -> cambioPeliculaDosController($_POST['cambioCodigoDos']);
			if ($respuesta) {
				$respuesta = "ok";
			}
			echo $respuesta;
			
		}
		public function gestorCliente(){

			
				$venta = new ingresoClienteController ();
				$respuesta = $venta -> gestorClienteController($_POST['cedulaCliente']);
				header('Content-Type: application/json');

				echo json_encode($respuesta);
				
			
			
		}
		public function gestorClienteIngreso(){
			$venta = new ingresoClienteController();
			$respuesta = $venta -> gestorClienteIngresoController($_POST['codigoIngresoCliente'], $_POST['cedulaIngresoCliente']);
			header('Content-Type: application/json');

			echo json_encode($respuesta);
			
		}
		public function gestorClienteQuitar(){
			$venta = new ingresoClienteController();
			$respuesta = $venta -> gestorClienteQuitarController($_POST['codigoQuitarCliente'], $_POST['cedulaQuitarCliente']);
			return $respuesta;
			
		}

		public function gestorArchivo(){
			$gestor = new gestorPeliculasController();
			$respuesta = $gestor -> gestorArchivos($_POST['revisarArchivo']);
			header('Content-Type: application/json');

			echo json_encode($respuesta);
			
		}
		public function gestorClienteEliminar()
		{
			$cliente = new ingresoClienteController();
			$respuesta = $cliente -> gestorClienteEliminarController($_POST['cedulaEliminarCliente']);

			header('Content-Type: application/json');

			echo json_encode($respuesta);
		}
		public function gestorClienteEditar()
		{
			$cliente = new ingresoClienteController();
			$respuesta = $cliente -> gestorClienteEditarController($_POST['cedulaEditarCliente']);

			header('Content-Type: application/json');

			echo json_encode($respuesta);
		}
		public function gestorClienteEditarEditado()
		{
			$cliente = new ingresoClienteController();
			$respuesta = $cliente -> gestorClienteEditarEditadoController($_POST['cedulaVieja'],$_POST['cedulaNueva'],$_POST['nombre'],$_POST['telefono'],$_POST['correo'],$_POST['direccion']);

			header('Content-Type: application/json');

			echo json_encode($respuesta);
		}

		public function registrarVenta()
		{
			$cliente = new gestorPeliculasController();
			$respuesta = $cliente -> registrarVentaController($_POST['trabajador'],$_POST['servicio'],$_POST['ganancia'],$_POST['comision'],$_POST['total']);

			header('Content-Type: application/json');

			echo json_encode($respuesta);
		}
		public function reporteEmpleado()
		{
			$empleado = new gestorPeliculasController();
			$respuesta = $empleado -> reporteEmpleados($_POST['cedula']);

			header('Content-Type: application/json');

			echo json_encode($respuesta);
		}
		public function EliminarVentaIndividual()
		{
			$empleado = new gestorPeliculasController();
			$respuesta = $empleado -> EliminarVentaIndividualController($_POST['idEliminar'] ,$_POST['comisionRestar'],$_POST['comision']);

			header('Content-Type: application/json');

			echo json_encode($respuesta);
		}
		public function RestarComision()
		{
			$empleado = new gestorPeliculasController();
			$respuesta = $empleado -> RestarComisionController($_POST['comisionRestar'],$_POST['comision'] );

			header('Content-Type: application/json');

			echo json_encode($respuesta);
		}
	
		
	}
	if (isset($_POST['codigo'])) {
		$ajax = new Ajax();
		$ajax -> editadoPelicula();

	}elseif (isset($_POST['editado'])) {
		$ajax = new Ajax();
		$ajax -> editadoPeliculaFormulario();
	}elseif (isset($_POST['codigoDelete'])) {
		$ajax = new Ajax();
		$ajax -> borradoPelicula();
	}elseif (isset($_POST['cedulaEditado'])) {
		$ajax = new Ajax();
		$ajax -> tipoEditado();
	}elseif (isset($_POST['cedulaCreate'])) {
		$ajax = new Ajax();
		$ajax -> tipoCreado();
	}elseif (isset($_POST['eliminarTipo'])) {
		$ajax = new Ajax();
		$ajax -> eliminarTipo();
	}elseif (isset($_POST['GeneroEliminar'])) {
		$ajax = new Ajax();
		$ajax -> GeneroEliminar();
	}elseif (isset($_POST['codigoVentas'])) {
		$ajax = new Ajax();
		$ajax -> ventaDiaria();
	}elseif (isset($_POST['cambioCodigo'])) {
		$ajax = new Ajax();
		$ajax -> cambioPelicula();
	}elseif (isset($_POST['cambioCodigoDos'])) {
		$ajax = new Ajax();
		$ajax -> cambioPeliculaDos();
	}elseif (isset($_POST['cedulaCliente'])) {
		$ajax = new Ajax();
		$ajax -> gestorCliente();
	}elseif (isset($_POST['codigoIngresoCliente'])) {
		$ajax = new Ajax();
		$ajax -> gestorClienteIngreso();
	}elseif (isset($_POST['codigoQuitarCliente'])) {
		$ajax = new Ajax();
		$ajax -> gestorClienteQuitar();
	}elseif (isset($_POST['revisarArchivo'])) {
		$ajax = new Ajax();
		$ajax -> gestorArchivo();
	}elseif (isset($_POST['peliculaYaRevisada'])) {
		$ajax = new Ajax();
		$ajax -> peliculaInsertar();
	}elseif (isset($_POST['cedulaEliminarCliente'])) {
		$ajax = new Ajax();
		$ajax -> gestorClienteEliminar();
	}elseif (isset($_POST['cedulaEditarCliente'])) {
		$ajax = new Ajax();
		$ajax -> gestorClienteEditar();
	}elseif (isset($_POST['cedulaVieja'])) {
		$ajax = new Ajax();
		$ajax -> gestorClienteEditarEditado();
	}elseif (isset($_POST['trabajador'])) {
		$ajax = new Ajax();
		$ajax -> registrarVenta();
	}elseif (isset($_POST['cedula'])) {
		$ajax = new Ajax();
		$ajax -> reporteEmpleado();
	}elseif (isset($_POST['idEliminar'])) {
		$ajax = new Ajax();
		$ajax -> EliminarVentaIndividual();
	}
	elseif (isset($_POST['comisionRestar'])) {
		$ajax = new Ajax();
		$ajax -> RestarComision();
	}elseif (isset($_POST['productoEliminar'])) {
		$ajax = new Ajax();
		$ajax -> productoEliminar();
	}



 ?>