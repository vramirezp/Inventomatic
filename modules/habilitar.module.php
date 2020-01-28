<?php
require('../include/config.php');
if(count($_POST) > 0)
{
	$data = '';
	switch(@$_POST['funcion'])
	{
		case '1':
		{
			$codigo = @$_POST['codigo'];

			$page = @$_POST['pagina'];

			$limit = 0;

			$limit = (($limit > 0) ? $limit:15);

			$page = (($page > 0) ? $page:1);

			if(isset($codigo))
			{
				$codigo = ' AND codigo_producto = "'.$codigo.'"';
			}

			$sqlCompleta = 
			"SELECT
				codigo_producto,
				nombre,
				marca,
				capacidad
			FROM 
				producto
			WHERE
				estado = 0 ".$codigo."
			ORDER BY 
				fecha_ingreso ASC

			LIMIT ".($limit*($page-1)).", ".$limit;


			$sql = mysqli_query($conexion, $sqlCompleta);

			//var_dump($sql);

			if($sql->num_rows > 0)
			{
				
				while($dato = $sql->fetch_assoc()) 
				{
					$data .=  
					'<tr>
						<td>'.$dato['codigo_producto'].'</td>
						<td>'.$dato['nombre'].'</td>
						<td>'.$dato['marca'].'</td>
						<td>'.$dato['capacidad'].'</td>
						<td class="text-center">
							<div class="btn-groups ">
								<a id="ajustar" id_producto="'.$dato['codigo_producto'].'"  class="btn btn-primary btn-block" href="javascript:;">Activar</a>
							</div>
						</td>
					</tr>';
				}
			}
			else $data = false;
		}
		break;

		case '2': // Modificar producto
		{
			$id = @$_POST['id'];

			if(isset($id))
			{
				$sql = mysqli_query($conexion, "UPDATE producto SET estado = 1 WHERE codigo_producto = '".$id."' LIMIT 1");

				$data = true;
				
			}else $data = 'Error, no modifique el codigo.';

		}
		break;
	}
	echo $data;
}
?>	