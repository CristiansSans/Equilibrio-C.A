<?php 
	
	class gestorPeliculasModel{

		public function gestorPeliculas($tabla){
			$consulta = new Consulta();
			$sql = "SELECT * FROM $tabla order by fecha DESC , codigo DESC ";
			$resultadoGenero = $consulta -> ver_registros($sql);
			return $resultadoGenero;
		}

		public function editarPelis($tabla , $codigo){
			$consulta = new Consulta();
			$sql= "SELECT * FROM $tabla WHERE codigo=$codigo ";
			$resultado = $consulta -> ver_registros($sql);
			return $resultado;
		}
		public function editarPelisFormulario($tabla, $datosModel){
			$codigo = $datosModel["codigo"];
			$codigoCriminal = $datosModel["codigoCriminal"];
			$nombrePelicula = $datosModel["nombrePelicula"];
			$genero = $datosModel["genero"];
			$cantidad = $datosModel["cantidad"];
			$cinavia = $datosModel["cinavia"];
			$discos = $datosModel["discos"];
			$lenguaje = $datosModel["lenguaje"];
			$clasificacion = $datosModel["clasificacion"];
			$tipo = $datosModel["tipo"];
			$caratula = $datosModel["caratula"];
			$trailer = $datosModel["trailer"];
			$pelicula = $datosModel["pelicula"];
			$fecha = $datosModel["fecha"];
			$peso = $datosModel["peso"];

			$consulta = new Consulta();
			$sql= "UPDATE $tabla SET codigo='$codigo', nombrePelicula='$nombrePelicula', genero='$genero', cantidad='$cantidad', tipo='$tipo', caratula='$caratula', trailer='$trailer', pelicula='$pelicula', fecha='$fecha',peso='$peso', cinavia='$cinavia', lenguaje='$lenguaje', clasificacion='$clasificacion', discos='$discos' WHERE codigo='".$codigoCriminal."' ";
			$resultado = $consulta -> actualizar_registro($sql);

			if ($resultado) {
				$resultado = "ok";
			}else{
				$resultado = "error";
			}
			return $resultado;
		}

		public function gestorPeliculasVentas($tabla){
			$consulta = new Consulta();
			$sql = "SELECT * FROM $tabla INNER JOIN tipos ON $tabla.tipo = tipos.nombreTipo";
			$resultado = $consulta -> ver_registros($sql);
			return $resultado;
		}
		public function gestorPeliculasDescarga($tabla){
			$consulta = new Consulta();
			$sql = "SELECT * FROM $tabla INNER JOIN tipos ON $tabla.tipo = tipos.nombreTipo WHERE tipo='Descargas'";
			$resultado = $consulta -> ver_registros($sql);
			return $resultado;
		}
		public function vistaVendida($tabla){
			$consulta = new Consulta();
			$sql = "SELECT * FROM $tabla INNER JOIN trabajadores ON $tabla.trabajador = trabajadores.nombre order by id DESC";
			$resultado = $consulta -> ver_registros($sql);
			return $resultado;
		}

		public function vistaVendidaInpu($tabla){
			$consulta = new Consulta();
			$sql = "SELECT sum(total) FROM $tabla";
			$resultado = $consulta -> ver_registros($sql);
			return $resultado;
		}

		public function ventasDia($tabla, $codigo , $nombre, $precio, $inspector, $cedula){
			$consulta = new Consulta();
			$sql = "INSERT INTO $tabla (id,codigo, nombre, precio,cliente) VALUES ('Null','$codigo', '$nombre', '$precio', '$cedula')";
			$resultado = $consulta -> nuevo_registro($sql);
			if ($inspector == true) {
				$sql2 = "UPDATE peliculas SET cantidad= cantidad - 1 WHERE codigo='".$codigo."' ";
				$resultado2 = $consulta -> actualizar_registro($sql2);
			}
			if ($resultado) {
				$resultado = "ok";
			}
			return $resultado;
		}

		public function borrarPelis($tabla , $codigo){
			$consulta = new Consulta();
			$sql = "DELETE FROM $tabla WHERE codigo=$codigo";
			$resultado = $consulta -> borrar_registro($sql);
			return $resultado;
		}
		public function tipoEditadoModel($tabla , $cedula, $nombre, $porcentaje, $cedulaAnterior){
			$consulta = new Consulta();
			$sql = "UPDATE $tabla SET cedula='$cedula', nombre='$nombre' , porcentaje='$porcentaje' WHERE cedula='".$cedulaAnterior."' ";
			$resultado = $consulta -> actualizar_registro($sql);
			return $resultado;
		}
		public function tipoCreadoModel($tabla , $cedula, $nombre, $comision){
			$consulta = new Consulta();
			$sql = "INSERT INTO $tabla (cedula, nombre, porcentaje) VALUES ('$cedula', '$nombre' , '$comision')";
			$resultado = $consulta -> nuevo_registro($sql);
			return $resultado;
		}
		public function tipoEliminadoModel($tabla , $tipo){
			$consulta = new Consulta();
			$sql = "DELETE FROM $tabla WHERE cedula=$tipo";
			$resultado = $consulta -> borrar_registro($sql);
			return $resultado;
		}
		public function eliminarVentas(){
			$consulta = new Consulta();
			$sql = "DELETE FROM venta";
			$resultado = $consulta -> borrar_registro($sql);
			$sql2 = "UPDATE trabajadores SET comisionTotal= 0";
			$resultado2 = $consulta -> actualizar_registro($sql2);
			return $resultado;
		}
		public function quitarModel($tabla, $codigo){
			$consulta = new Consulta();
			$sql = "UPDATE $tabla SET cantidad= cantidad + 1 WHERE codigo='".$codigo."' ";
			$resultado = $consulta -> actualizar_registro($sql);
			return $resultado;
		}
		public function quitarDosModel($tabla, $codigo){
			$consulta = new Consulta();
			$sql = "UPDATE $tabla SET cantidad= cantidad - 1 WHERE codigo='".$codigo."' ";
			$resultado = $consulta -> actualizar_registro($sql);
			return $resultado;
		}

		public function registroVentaModel($trabajador,$servicio,$ganancia,$comision,$total){
			$consulta = new Consulta();
			$sql = "INSERT INTO venta (id, servicio, trabajador, ganancia, comision, total) VALUES (Null, '$servicio', '$trabajador', '$ganancia', '$comision', '$total')";
			$resultado = $consulta -> nuevo_registro($sql);
			$sql2 = "UPDATE trabajadores SET comisionTotal = comisionTotal + ".$comision." WHERE nombre='".$trabajador."' ";
			$resultado2 = $consulta -> actualizar_registro($sql2);
			$sql3 = "UPDATE trabajadores SET comisionTotal = comisionTotal + ".$ganancia." WHERE nombre='Total ganado'";
			$resultado2 = $consulta -> actualizar_registro($sql3);
			return $resultado;
		}

		public function vistaTrabajadoresModel($tabla){
			$consulta = new Consulta();
			$sql = "SELECT * FROM $tabla";
			$resultado = $consulta -> ver_registros($sql);
			return $resultado;
		}
		public function reportEmpleado($cedula){
			$consulta = new Consulta();
			$sql = "SELECT * FROM venta WHERE trabajador = '$cedula'";
			$resultado = $consulta -> ver_registros($sql);
			return $resultado;
		}
		public function EliminarVentaIndividualModel($id,$empleada,$comision){
			$consulta = new Consulta();
			$sql = "DELETE FROM venta WHERE id='$id'";
			$sql2 = "UPDATE trabajadores set comisionTotal= comisionTotal - ".$comision." WHERE nombre='$empleada'";
			$resultado = $consulta -> borrar_registro($sql);
			$resultado2 = $consulta -> actualizar_registro($sql2);
			return $resultado;
		}
		

	}

 ?>