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
				stock,
				capacidad,
				fecha_ingreso
			FROM 
				producto
			WHERE
				estado = 1
			ORDER BY 
				fecha_ingreso ASC";

			//var_dump($sqlCompleta);

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
						<td>'.$dato['fecha_ingreso'].'</td>
						<td>'.$dato['stock'].'</td>
						<td class="text-center">
							<div class="btn-group pull-right">
								<a data-fancybox data-src="modificarproducto.php?id='.$dato['codigo_producto'].'"  class="btn btn-primary" data-type="iframe" href="javascript:;">Modificar</a>
								<a data-fancybox data-src="eliminarproducto.php?id='.$dato['codigo_producto'].'"  class="btn btn-danger" data-type="iframe" href="javascript:;">Eliminar</a>
							</div>
						</td>
					</tr>';
				}
			}
			else $data = false;
		}
		break;
		case '2': // Eliminar Producto
		{
			$id = @$_POST['id'];
			if($id > 0)
			{	
				$fecha = date('Y-m-d H:i:s');
				$estado = 0;
				$sql = mysqli_query($conexion, "UPDATE producto SET estado = '".$estado."', stock = '".$estado."', fecha_cambio_estado = '".$fecha."' WHERE codigo_producto = '".$id."' LIMIT 1");
				$data = true;
			}
		}
		break;

		case '3': // Modificar producto
		{
			$id = @$_POST['id'];
			if($id > 0)
			{
				$nombre 	= strip_tags(@$_POST['nombre']);
				$marca 		= strip_tags(@$_POST['marca']);
				$capacidad	= strip_tags(@$_POST['capacidad']);

				if(isset($nombre) && isset($marca) && isset($capacidad) )
				{
					if (strlen($nombre) < 46 && strlen($marca) < 46) 
					{
						$sql = mysqli_query($conexion, "UPDATE producto SET nombre = '".$nombre."', marca = '".$marca."', capacidad = '".$capacidad."'  WHERE codigo_producto = '".$id."' LIMIT 1");
						$data = true;
					}
					else $data = 'Nombre o Marca muy largos!';
				}
				else $data = 'Campos vacios, rellene';	
			}
		}
		break;
		case '4'://listar desactivados
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
				stock,
				capacidad,
				fecha_ingreso
			FROM 
				producto
			WHERE
				estado = 0 
			".$codigo."
			
			ORDER BY 
				fecha_ingreso ASC

			LIMIT ".($limit*($page-1)).", ".$limit;

			//var_dump($sqlCompleta);

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
						<td>'.$dato['fecha_ingreso'].'</td>
						<td>'.$dato['stock'].'</td>
						<td class="text-center">							
							<a data-fancybox data-src="activarProducto.php?id='.$dato['codigo_producto'].'"  class="btn btn-primary" data-type="iframe" href="javascript:;">Activar</a>	
						</td>
					</tr>';
				}
			}
			else $data = false;
		}
		break;
		case '5': // Activar Producto
		{
			$id = @$_POST['id'];
			if($id > 0)
			{	
				$fecha = date('Y-m-d H:i:s');
				$estado = 1;
				$sql = mysqli_query($conexion, "UPDATE producto SET estado = '".$estado."', fecha_cambio_estado = '".$fecha."' WHERE codigo_producto = '".$id."' LIMIT 1");
				$data = true;
			}
		}
		break;
	}
	echo $data;
}
?>	