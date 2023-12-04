<?php 
	
	class gestorGenerosModel{

		public function gestorGeneros($tabla){
			$consulta = new Consulta();
			$sql = "SELECT * FROM $tabla";
			$resultadoGenero = $consulta -> ver_registros($sql);
			return $resultadoGenero;
		}

		public function editarGeneros($tabla, $datosModels){

			$nombre = $datosModels['servicio'];
			$fondo = $datosModels['precio'];
			$nombreCriminal = $datosModels['nombreCriminal'];
			$consulta = new Consulta();
			$sql = "UPDATE $tabla SET servicio='$nombre', precio='$fondo' WHERE servicio='".$nombreCriminal."' ";
			$resultadoGenero = $consulta -> actualizar_registro($sql);
			
			if ($resultadoGenero) {
				$resultadoGenero = "ok";
			}
			return $resultadoGenero;
		}
		public function editarInventario($tabla, $datosModels){

			$nombre = $datosModels['nombreProducto'];
			$cantidad = $datosModels['cantidad'];
			$precio = $datosModels['precio'];
			$nombreCriminal = $datosModels['nombreCriminal'];
			$consulta = new Consulta();
			$sql = "UPDATE $tabla SET nombre='$nombre', cantidad='$cantidad', precio='$precio' WHERE nombre='".$nombreCriminal."' ";
			$resultadoGenero = $consulta -> actualizar_registro($sql);
			
			if ($resultadoGenero) {
				$resultadoGenero = "ok";
			}
			return $resultadoGenero;
		}
		public function generoEliminadoModel($tabla, $nombre){
			$consulta = new Consulta();
			$sql = "DELETE FROM $tabla WHERE id='$nombre'";
			$resultadoGenero = $consulta -> borrar_registro($sql);
			return $resultadoGenero;
		}
		public function productoEliminadoModel($tabla, $nombre){
			$consulta = new Consulta();
			$sql = "DELETE FROM $tabla WHERE id='$nombre'";
			$resultadoGenero = $consulta -> borrar_registro($sql);
			return $resultadoGenero;
		}
		public function CrearGeneroModel($tabla, $datosModel){
			$nombre = $datosModel['nombre'];
			$precio = $datosModel['precio'];

			$consulta = new Consulta();
			$sql = "INSERT INTO $tabla ( servicio, precio) values ( '$nombre', '$precio')";
			$resultadoGenero = $consulta -> nuevo_registro($sql);
			if ($resultadoGenero) {
				$resultadoGenero = "ok";
			}
			return $resultadoGenero;
		}
		public function CrearProductoModel($tabla, $datosModel){
			$nombre = $datosModel['nombre'];
			$cantidad = $datosModel['cantidad'];
			$precio = $datosModel['precio'];

			$consulta = new Consulta();
			$sql = "INSERT INTO $tabla ( nombre, cantidad, precio) values ( '$nombre','$cantidad', '$precio')";
			$resultadoGenero = $consulta -> nuevo_registro($sql);
			if ($resultadoGenero) {
				$resultadoGenero = "ok";
			}
			return $resultadoGenero;
		}

	}

 ?>