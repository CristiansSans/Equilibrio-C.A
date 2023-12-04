<?php

class EnlacesModels{

	public function enlacesModel($enlaces){

		if( $enlaces == "inventario" ||
			$enlaces == "footer" ||
			$enlaces == "editarPeliculas" ||
			$enlaces == "editarCliente" ||
			$enlaces == "servicios" ||
			$enlaces == "empleadas" ||
			$enlaces == "reporteTotal" ||
			$enlaces == "login" ||
			$enlaces == "signup" ||
			$enlaces == "cerrarSesion" ||
			$enlaces == "administracion" ||
			$enlaces == "agregarPelicula" ||
			$enlaces == "cerrarDia" ||
			$enlaces == "cambioPelicula" ||
			$enlaces == "anadirPeliculaCliente" ||
			$enlaces == "home"){

			$module = "views/modules/".$enlaces.".php";

		}
		else if($enlaces == "index"){
			$module = "views/modules/home.php";
		}else if ($enlaces == "accesoNoPermitido") {
			$module = "views/modules/accesoNoPermitido.html";
		}else{
			$module = "views/modules/404.html";
		}

		return $module;

	}


}