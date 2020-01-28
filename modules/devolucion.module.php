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
			"SELECT p.nombre,up.producto_codigo_producto,up.cantidad,up.fecha_prestamo 
    	FROM usuario_has_producto up join producto p on (p.codigo_producto=up.producto_codigo_producto)  where up.estado=0 AND up.usuario_num_usuario = ".$_SESSION["usuario"]["num_usuario"];

			$sql = mysqli_query($conexion, $sqlCompleta);


			if($sql->num_rows > 0)
			{
				$arreglo = [];
				while($dato = $sql->fetch_assoc()) 
				{
					
					$data .=  
					'<tr>
						<td>'.$dato['producto_codigo_producto'].'</td>
						<td>'.$dato['nombre'].'</td>
						<td>'.$dato['cantidad'].'</td>
						<td>'.$dato['fecha_prestamo'].
						'<div id="cantidad_sumar" class="hidden">'.$dato['cantidad'].'</div>
						</td>
						<td class="text-center">
							<div class="btn-group pull-right">
								<a id="eliminar_item" id_producto="'.$dato['producto_codigo_producto'].'"  class="btn btn-danger btn-block" href="javascript:;">Devolver</a>
							</div>
						</td>
					</tr>';


				}
			}
			else
			{ 

				$data .= 'No tienes Prestamos Pendientes';
			}
		}
		break;
		case '2': // Devolver Producto
		{
			$id = @$_POST['id'];
			//echo var_dump($id);
			if($id > 0 && isset($id))
			{	
				//echo var_dump($id);
				/*modificar sesion de la vola usuario_num_usuario*/
				$sqlCompleta = 
				"SELECT  up.cantidad
			    FROM 
				usuario_has_producto up WHERE producto_codigo_producto = '".$id."'
				 AND Cantidad >=2 and up.usuario_num_usuario=".$_SESSION["usuario"]["num_usuario"]." LIMIT 1";

				$sql = mysqli_query($conexion, $sqlCompleta);

				if($sql->num_rows > 0)
				{
					//echo var_dump($sql->num_rows);
					/*+1 al stock del producto*/
				mysqli_query($conexion,"UPDATE producto p SET p.stock= (p.stock + 1) WHERE p.codigo_producto = '".$id."' LIMIT 1");

				/*modificar sesion de la vola usuario_num_usuario*/
				mysqli_query($conexion,"UPDATE usuario_has_producto p 
					SET p.cantidad = (p.cantidad - 1)
					WHERE p.usuario_num_usuario = ".$_SESSION["usuario"]["num_usuario"]." and p.producto_codigo_producto='".$id."' LIMIT 1");

				/*inserto al historico que devolvio 1*/
				$sentencia ="SELECT nombre FROM producto where codigo_producto=".$id."";
				$ejecucion = mysqli_query($conexion, $sentencia);
				$wea = $ejecucion->fetch_assoc();

				mysqli_query($conexion,"INSERT INTO historico_devolucion(hd_id,hd_num_usuario,hd_correo, hd_codigo_producto,hd_nombre, hd_cantidad, hd_fecha_devolucion) 
					VALUES (null,".$_SESSION["usuario"]["num_usuario"].",'".$_SESSION["usuario"]["correo"]."',".$id.",'".$wea['nombre']."',1,CURDATE())");

				}	
				else
				{
					/*+1 al stock del producto*/
				mysqli_query($conexion,"UPDATE producto p SET p.stock= (p.stock + 1) WHERE p.codigo_producto = '".$id."' LIMIT 1");

				/*modificar sesion de la vola usuario_num_usuario*/
				mysqli_query($conexion,"UPDATE usuario_has_producto p 
					SET p.cantidad = (p.cantidad - 1), p.estado = 1, p.fecha_dev = CURDATE()
					WHERE p.usuario_num_usuario = ".$_SESSION["usuario"]["num_usuario"]." AND p.producto_codigo_producto='".$id."' LIMIT 1");

				/*inserto al historico que devolvio 1*/
				$sentencia ="SELECT nombre FROM producto where codigo_producto=".$id."";
				$ejecucion = mysqli_query($conexion, $sentencia);
				$wea = $ejecucion->fetch_assoc();

				mysqli_query($conexion,"INSERT INTO historico_devolucion(hd_id,hd_num_usuario,hd_correo, hd_codigo_producto,hd_nombre, hd_cantidad, hd_fecha_devolucion) 
					VALUES (null,".$_SESSION["usuario"]["num_usuario"].",'".$_SESSION["usuario"]["correo"]."',".$id.",'".$wea['nombre']."',1,CURDATE())");
				}		
				$data = true;
			}
		}
		break;
		case '3': // Devolver Producto
		{
			$id = @$_POST['codigo'];
			$cantidad = @$_POST['cantidad'];

			if($id > 0 && isset($id))
			{	

				/*modificar sesion de la vola usuario_num_usuario*/
				$sqlCompleta = 
				"SELECT  up.cantidad
			    FROM 
				usuario_has_producto up WHERE producto_codigo_producto = '".$id."'
				 AND Cantidad >= ".$cantidad." and up.usuario_num_usuario=".$_SESSION["usuario"]["num_usuario"]." LIMIT 1";

				$sql = mysqli_query($conexion, $sqlCompleta);

				if($sql->num_rows > 0)
				{
					$CantidadPedido = mysqli_fetch_array($sql, MYSQLI_ASSOC);
				
					
					/*si la cantidad que ingresamos es igual a la que nos queda por devolver*/
					if ($CantidadPedido["cantidad"] == $cantidad) 
					{
						//var_dump("pasoporaca->".$cantidad."tabla->".$CantidadPedido["cantidad"]);
						mysqli_query($conexion,"UPDATE producto p SET p.stock= (p.stock + ".$cantidad.") , p.estado = 1 WHERE p.codigo_producto = '".$id."' LIMIT 1");

					/*modificar sesion de la vola usuario_num_usuario*/
						mysqli_query($conexion,"UPDATE usuario_has_producto p 
					SET p.cantidad = (p.cantidad - ".$cantidad."), p.estado = 1, p.fecha_dev = CURDATE()
					WHERE p.usuario_num_usuario = ".$_SESSION["usuario"]["num_usuario"]." AND p.producto_codigo_producto='".$id."' LIMIT 1");

				/*inserto al historico que devolvio */
				$sentencia ="SELECT nombre FROM producto where codigo_producto=".$id."";
				$ejecucion = mysqli_query($conexion, $sentencia);
				$wea = $ejecucion->fetch_assoc();

				mysqli_query($conexion,"INSERT INTO historico_devolucion(hd_id,hd_num_usuario,hd_correo, hd_codigo_producto,hd_nombre, hd_cantidad, hd_fecha_devolucion) 
					VALUES (null,".$_SESSION["usuario"]["num_usuario"].",'".$_SESSION["usuario"]["correo"]."',".$id.",'".$wea['nombre']."',".$cantidad.",CURDATE())");


						$data = true;
					}

					if ($CantidadPedido["cantidad"] > $cantidad) 
					{

						mysqli_query($conexion,"UPDATE producto p SET p.stock= (p.stock + ".$cantidad.") WHERE p.codigo_producto = '".$id."' LIMIT 1");

					/*modificar sesion de la vola usuario_num_usuario*/
						mysqli_query($conexion,"UPDATE usuario_has_producto p 
												SET p.cantidad = (p.cantidad - ".$cantidad.") 
												WHERE p.usuario_num_usuario = ".$_SESSION["usuario"]["num_usuario"]." and p.producto_codigo_producto='".$id."' LIMIT 1");

						/*inserto al historico que devolvio */
				$sentencia ="SELECT nombre FROM producto where codigo_producto=".$id."";
				$ejecucion = mysqli_query($conexion, $sentencia);
				$wea = $ejecucion->fetch_assoc();

				mysqli_query($conexion,"INSERT INTO historico_devolucion(hd_id,hd_num_usuario,hd_correo, hd_codigo_producto,hd_nombre, hd_cantidad, hd_fecha_devolucion) 
					VALUES (null,".$_SESSION["usuario"]["num_usuario"].",'".$_SESSION["usuario"]["correo"]."',".$id.",'".$wea['nombre']."',".$cantidad.",CURDATE())");

						$data = true;
					}


					}
					else
					{
						$data = "La cantidad de producto es mayor a la pedida";
					}
				}	
				else
				{
					$data = "Error al devolver, producto no existe";					
				}			
			}
		
		break;
		
	}
	echo $data;
}
?>	