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
			    t.IdTemp as id_t,
				t.Cantidad as cantidad,
				p.codigo_producto as CodigoProducto,
				p.nombre as nombre					
			FROM 
				temporal t join producto p ON(t.CodigoProducto = p.codigo_producto) 
				where t.NumUser=".$_SESSION["usuario"]["num_usuario"]." ";

			$sql = mysqli_query($conexion, $sqlCompleta);

			//var_dump($sql);

			if($sql->num_rows > 0)
			{
				$arreglo = [];
				while($dato = $sql->fetch_assoc()) 
				{
					//$subTotal = $dato['precio_h'] * $dato['cantidad'];
					$data .=  
					'<tr>
						<td>'.$dato['id_t'].'</td>
						<td>'.$dato['CodigoProducto'].'</td>
						<td>'.$dato['nombre'].'</td>
						<td>'.$dato['cantidad'].
						'<div id="cantidad_sumar" class="hidden">'.$dato['cantidad'].'</div>
						</td>		

						<td class="text-center">
							<div class="btn-group pull-right">
								<a id="eliminar_item" id_producto="'.$dato['id_t'].'"  class="btn btn-danger btn-block" href="javascript:;">Eliminar</a>
							</div>
						</td>
					</tr>';
				}
			}
			else{ $data = false;}
		}
		break;
		case '2': // Eliminar Producto
		{
			$id = @$_POST['id'];
			if($id > 0 && isset($id))
			{	
				$sqlCompleta = 
				"SELECT
					IdTemp
				FROM 
					temporal WHERE IdTemp = '".$id."' AND Cantidad >= 2 and 
					NumUser=".$_SESSION["usuario"]["num_usuario"]." LIMIT 1";

				$sql = mysqli_query($conexion, $sqlCompleta);

				//var_dump($sql);

				if($sql->num_rows > 0)
				{
					mysqli_query($conexion, "UPDATE temporal SET Cantidad = (Cantidad - 1) WHERE IdTemp
					 = '".$id."' and NumUser=".$_SESSION["usuario"]["num_usuario"]." ");
				}	
				else
				{
					mysqli_query($conexion, "DELETE FROM temporal WHERE IdTemp = '".$id."' 
						and NumUser=".$_SESSION["usuario"]["num_usuario"]." ");
				}		
				$data = true;
			}
		}
		break;

		case '3': // Agregar producto
		{
			$id = @$_POST['codigo'];
			$cantidad = @$_POST['cantidad'];
			if($id > 0 && isset($id))
			{
				$sqlCompleta = "SELECT t.IdTemp FROM temporal t WHERE t.CodigoProducto ='".$id."' 
				and t.NumUser=".$_SESSION["usuario"]["num_usuario"]." ";

				$sql = mysqli_query($conexion, $sqlCompleta);

				$sqlCompletass = 
						"SELECT p.codigo_producto , p.stock FROM producto p 
						 WHERE p.codigo_producto = '".$id."' and p.estado=1 LIMIT 1";

					$sqls = mysqli_query($conexion, $sqlCompletass);

					/*saco el valor de stock de la tabla producto*/
						$stockproducto = $sqls -> fetch_array();

					/*saco el stock de la tabla temporal*/
						$consultar ="SELECT t.Cantidad FROM temporal t
						 WHERE t.CodigoProducto = '".$id."' LIMIT 1";

						$r = mysqli_query($conexion, $consultar);

						$stocktemporal = $r ->fetch_array();
			

				if($sql->num_rows == 0)
				{
					if($sqls->num_rows > 0) 
					{
	
						if ($stockproducto['stock'] != 0  ) {
							
							/*modificar por el user de la session*/
							mysqli_query($conexion, "INSERT INTO temporal(CodigoProducto, NumUser, Cantidad) 
							VALUES ('".$id."',".$_SESSION["usuario"]["num_usuario"].",".$cantidad.")");
							
								$data = true;
							}
							else
							{ 
								
								$data = "Bajo Stock Disponible";
							}
						}
						else
						{
							
								$data="Producto no existe en el inventario";
						}

				}
				else
				{
					if ($stocktemporal['Cantidad']+$cantidad <= $stockproducto['stock']) {
						mysqli_query($conexion, "UPDATE temporal SET Cantidad = (Cantidad + ".$cantidad.") WHERE CodigoProducto = '".$id."' and
						 NumUser=".$_SESSION["usuario"]["num_usuario"]." ");
					$data = true;
					}else
					{
						$data = "Bajo Stock Disponible";
					}
				
				}
				
			}
		}
		break;
		case '4': // Eliminar all productos
		{
			/*modificar sesion*/
			mysqli_query($conexion, "DELETE FROM temporal 
				where NumUser=".$_SESSION["usuario"]["num_usuario"]."");
			$data = true;
		}
		break;
		case '5': // Guardar all productos
		{	
		
			$sqlCompleta = "SELECT IdTemp,CodigoProducto,NumUser,Cantidad FROM temporal 
			 where NumUser=".$_SESSION["usuario"]["num_usuario"]."";
 	
			/*deberia preguntar si existe en la tabla usuario has producto para actualizar*/


			//IF SI LA LISTA ES MAYOR A 0
			$sqlx = mysqli_query($conexion, $sqlCompleta);
			while($dato = $sqlx->fetch_array()) 
			{
				
				$consultar = mysqli_query($conexion, "select * from usuario_has_producto where producto_codigo_producto = '".$dato['CodigoProducto']."' 
					and usuario_num_usuario = ".$_SESSION["usuario"]["num_usuario"]." ");

				if ($consultar->num_rows>0) {
					//Actualizacion de prestamo
				 /*modificar por el user de la session*/
				 mysqli_query($conexion, "UPDATE usuario_has_producto
				  SET cantidad = cantidad +".$dato['Cantidad']." , estado = 0
								WHERE producto_codigo_producto = ".$dato['CodigoProducto']." 
								 and usuario_num_usuario = ".$dato['NumUser']."");

				//Actualización de la cantidad.
				mysqli_query($conexion, "UPDATE producto SET stock =  stock - '".$dato['Cantidad']."' WHERE codigo_producto = '".$dato['CodigoProducto']."' LIMIT 1");

				/*consulta en tabla user*/
				$accion =mysqli_query($conexion,"SELECT us.correo as correo,p.nombre as nombreprodu
				FROM 
				usuario_has_producto up join producto  p join usuario us
			on(up.producto_codigo_producto=p.codigo_producto and us.num_usuario=up.usuario_num_usuario)
				WHERE us.num_usuario=".$dato['NumUser']." AND up.producto_codigo_producto='".$dato['CodigoProducto']."'");

				$datoaccion = $accion->fetch_array();

				/*Inserción en tabla historico*/
			    mysqli_query($conexion, "INSERT INTO historico_prestamo
			    	(h_num_usuario,h_correo,h_codigo_producto,h_nombre,h_cantidad,h_fecha_prestamo)
			    	VALUES (".$dato['NumUser'].",'".$datoaccion['correo']."',".$dato['CodigoProducto'].",
			    	'".$datoaccion['nombreprodu']."',".$dato['Cantidad'].",CURDATE())");

				}
				else
				{
				//Insercion de prestamo
				 /*modificar por el user de la session*/
				 mysqli_query($conexion, "INSERT INTO usuario_has_producto(usuario_num_usuario, producto_codigo_producto,cantidad,cantidad_medible,fecha_prestamo,fecha_dev,estado) 
				 	VALUES ('".$dato['NumUser']."','".$dato['CodigoProducto']."','".$dato['Cantidad']."', null , CURDATE(),null,0)");

				//Actualización de la cantidad.
				mysqli_query($conexion, "UPDATE producto SET stock =  stock - '".$dato['Cantidad']."' WHERE codigo_producto = '".$dato['CodigoProducto']."' LIMIT 1");

					/*consulta en tabla user*/
				$accion =mysqli_query($conexion,"SELECT us.correo as correo,p.nombre as nombreprodu
				FROM 
				usuario_has_producto up join producto  p join usuario us
			on(up.producto_codigo_producto=p.codigo_producto and us.num_usuario=up.usuario_num_usuario)
				WHERE us.num_usuario=".$dato['NumUser']."");

				$datoaccion = $accion->fetch_array();

				/*Inserción en tabla historico*/
			    mysqli_query($conexion, "INSERT INTO historico_prestamo
			    	(h_num_usuario, h_correo,h_codigo_producto, h_nombre, h_cantidad,h_fecha_prestamo) 
			    	VALUES (".$dato['NumUser'].",'".$datoaccion['correo']."',".$dato['CodigoProducto'].",
			    	'".$datoaccion['nombreprodu']."',".$dato['Cantidad'].",CURDATE())");
				}

				 
			}
		    
		    /*modificar por el user de la session*/
			mysqli_query($conexion, "DELETE FROM temporal 
				where NumUser = ".$_SESSION["usuario"]["num_usuario"]."");
			
			$data = true;
		}
		break;
	}
	echo $data;
}
?>	