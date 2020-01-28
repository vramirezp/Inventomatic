<?php
require('../include/config.php');
if(count($_POST) > 0)
{
	$data = '';
	switch(@$_POST['funcion'])
	{
		case '1':
		{

			$sqlCompleta = 
			"SELECT
				t.id as id_t,
				t.cantidad as cantidad,
				p.id_tipo_producto as id_tipo_producto,
				p.nombre as nombre,
				p.precio as precio_h,
				format(p.precio,0) as precio
			FROM 
				temporal t join producto p ON(t.id_producto = p.id_tipo_producto)";

			$sql = mysqli_query($conexion, $sqlCompleta);

			//var_dump($sql);

			if($sql->num_rows > 0)
			{
				$arreglo = [];
				while($dato = $sql->fetch_assoc()) 
				{
					$subTotal = $dato['precio_h'] * $dato['cantidad'];
					$data .=  
					'<tr>
						<td>'.$dato['id_t'].'</td>
						<td>'.$dato['id_tipo_producto'].'</td>
						<td>'.$dato['nombre'].'</td>
						
						<td>
							$'.$dato['precio'].'
							<div id="precio_sumar" class="hidden">'.$subTotal.'</div>
							<div id="cantidad_sumar" class="hidden">'.$dato['cantidad'].'</div>
						</td>
						<td>'.$dato['cantidad'].'</td>
						<td>$ '.$subTotal.'</td>
						<td class="text-center">

							<div class="btn-group pull-right">
								<a id="eliminar_item" id_producto="'.$dato['id_t'].'"  class="btn btn-danger btn-block" href="javascript:;">Eliminar</a>
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
			if($id > 0 && isset($id))
			{	
				$sqlCompleta = 
				"SELECT
					id
				FROM 
					temporal WHERE id = '".$id."' AND cantidad >= 2 LIMIT 1";

				$sql = mysqli_query($conexion, $sqlCompleta);

				//var_dump($sql);

				if($sql->num_rows > 0)
				{
					mysqli_query($conexion, "UPDATE temporal SET cantidad = (cantidad - 1) WHERE id = '".$id."' LIMIT 1");
				}	
				else
				{
					mysqli_query($conexion, "DELETE FROM temporal WHERE id = '".$id."' LIMIT 1");
				}		
				$data = true;
			}
		}
		break;

		case '3': // Agregar producto
		{
			$id = @$_POST['codigo'];
			if($id > 0 && isset($id))
			{
				$sqlCompleta = 
				"SELECT
					t.id
				FROM 
					temporal t WHERE id_producto = '".$id."' LIMIT 1";

				$sql = mysqli_query($conexion, $sqlCompleta);

				//var_dump($sql);

				if($sql->num_rows == 0)
				{
					$sqlCompletass = 
						"SELECT
							id_tipo_producto
						FROM 
							producto WHERE id_tipo_producto = '".$id."' LIMIT 1";

					$sqls = mysqli_query($conexion, $sqlCompletass);

					if($sqls->num_rows > 0) 
					{
						mysqli_query($conexion, "INSERT INTO temporal (id_producto) VALUES ('".$id."')");
						$data = true;
					}
					else $data = "Producto no existe en el inventario";
				}
				else
				{
					mysqli_query($conexion, "UPDATE temporal SET cantidad = (cantidad + 1) WHERE id_producto = '".$id."' LIMIT 1");
					$data = true;
				}
				
			}
		}
		break;
		case '4': // Eliminar all productos
		{
			mysqli_query($conexion, "DELETE FROM temporal");
			$data = true;
		}
		break;
		case '5': // Guardar all productos
		{	
		
			$sqlCompleta = "SELECT
							p.stock as stock,
							t.cantidad as cantidad,
							p.id_tipo_producto as id_producto,
							p.precio as precio
							FROM  temporal t join producto p ON(t.id_producto = p.id_tipo_producto)";
 	

			//IF SI LA LISTA ES MAYOR A 0
			
			//VENTAA.....................................................................................................	
			$sqlTotal = "SELECT SUM(t.cantidad * p.precio) as precio FROM temporal t join producto p ON(t.id_producto = p.id_tipo_producto)";
			
			$x = mysqli_query($conexion, $sqlTotal);

			while($valor = $x->fetch_assoc()) 
			{
				mysqli_query($conexion, "INSERT INTO venta (precio_total) VALUES ('".$valor['precio']."')");
			}	
			//..........................................................................................................

			$ultimo = "SELECT num_venta FROM venta ORDER BY fecha DESC LIMIT 1";
			
			$u = mysqli_query($conexion, $ultimo);
			$sqlx = mysqli_query($conexion, $sqlCompleta);

			$valor = $u->fetch_assoc();
			while($dato = $sqlx->fetch_array()) 
			{
				//Insercion de detalle
				
				mysqli_query($conexion, "INSERT INTO detalle (cantidad,precio,num_venta,id_tipo_producto) 
											 VALUES ('".$dato['cantidad']."','".$dato['precio']."','".$valor['num_venta']."','".$dato['id_producto']."')");
				//Actualización de la cantidad.
				mysqli_query($conexion, "UPDATE producto SET stock =  stock - '".$dato['cantidad']."' WHERE id_tipo_producto = '".$dato['id_producto']."' LIMIT 1");
			}
		
			mysqli_query($conexion, "DELETE FROM temporal");
			
			$data = true;
		}
		break;
	}
	echo $data;
}
?>	