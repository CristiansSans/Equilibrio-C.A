<?php 
	
	class gestorTiposController{

		public function vistaTipos(){
			$resultado = gestorTiposModel::gestorTipos("trabajadores");

			foreach ($resultado as $row => $item) {
				
				?>
				<tr>
			      	<td style="text-align: center;"><?php echo $item['cedula'] ?></td>
			        <td style="text-align: center;"><?php echo $item['nombre'] ?></td>
			        <td style="text-align: center;"><?php echo $item['porcentaje'] ?></td>
			        <td class="editarTipos" style="font-size: 18px;cursor: pointer;text-align: center;"> <input type="text" value="<?php echo $item['cedula'] ?>" hidden> <input type="text" value="<?php echo $item['nombre'] ?>" hidden><input type="text" value="<?php echo $item['porcentaje'] ?>" hidden> <i class="fas fa-edit"></i></td>
			        <td class="EliminarTipos" style="font-size: 18px;cursor: pointer;text-align: center;"> <input type="text" value="<?php echo $item['cedula'] ?>" hidden>  <i class="fas fa-trash"></i></td>
			        <td class="reportado" style="font-size: 18px;cursor: pointer;text-align: center;"> <input type="text" value="<?php echo $item['nombre'] ?>" hidden>  <i class="fa fa-file"></i></td>
			     </tr>
				<?php

			}
			?>
				<tr>
			      	<td style="text-align: center;"></td>
			      	<td style="text-align: center;"></td>
			      	<td style="text-align: center;"></td>
			        <td style="text-align: center;"></td>
			        <td style="text-align: center;"></td>
			        <td class="newGene" style="font-size: 18px;cursor: pointer;text-align: center;">Nuevo <i class="fas fa-plus"></i></td>
			     </tr>
				<?php
		}
	}
	
 ?>