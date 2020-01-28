<?php
require_once('../include/config.php');
if(count($_POST) > 0)
{
	
	$data = '';
	switch(@$_POST['funcion'])
	{
		case '1':
				{
			$nombre 	= strip_tags(@$_POST['nombre']);
			$marca 		= strip_tags(@$_POST['marca']);
			$capacidad 	= strip_tags(@$_POST['capacidad']);
			$codigo		= strip_tags(@$_POST['codigo']);

		


			if(isset($nombre) && isset($marca) && isset($capacidad) && isset($codigo))
			{
					if (strlen($nombre) < 46 && strlen($marca) < 46 && strlen($capacidad) < 46) 
					{
						if(buscar_productos($codigo,$conexion) == false)
						{
							if (strlen($codigo) < 30)
							{
								$fecha = date('Y-m-d H:i:s');
								$stock = 0;
								$sql = mysqli_query($conexion, "INSERT INTO producto (codigo_producto, stock, nombre, marca, capacidad, fecha_ingreso, fecha_cambio_estado, estado) 
									VALUES ('".$codigo."', '".$stock."', '".$nombre."', 
									'".$marca."', '".$capacidad."', '".$fecha."', '".$fecha."', 1)");
								
								$descripcion = "Se a agregado el producto ".$nombre." de la marca: ".$marca." y su codigo es: ".$codigo.". Fecha: ".$fecha.".";
								//$sql = mysqli_query($conexion, "INSERT INTO log (descripcion) VALUES ('".$descripcion."')");	
								$data = true;
							}
							else
							{
								$data = 'Fuera del rango máximo de caracteres';
							}
						}
						else 
						{
							if(buscar_producto_delete($codigo,$conexion) == true)
							{
								// $data = 'Actualizar';
								// $fecha = date('Y-m-d H:i:s');
								// $stock = 0;
								// $sql = mysqli_query($conexion, "UPDATE producto SET nombre = '".$nombre."', marca = '".$marca."', capacidad = '".$capacidad."', estado = 1 WHERE codigo_producto = '".$codigo."' LIMIT 1");
							
								// $descripcion = "Se a agregado el producto ".$nombre." de la marca: ".$marca." y su codigo es: ".$codigo.". Fecha: ".$fecha.".";
								//$sql = mysqli_query($conexion, "INSERT INTO log (descripcion) VALUES ('".$descripcion."')");	
								$data = 'redi';
							}
							else
							{
								$data = 'Código de producto ya existente!';
							}
						}
					}
					else $data = 'Nombre, Marca o Capacidad superan los 45 caracteres!';
			}
			else $data = 'Campos vacios, rellene';
		}
		break;
		/*------------------------------------------------------------------------------------------------------------------------------------------*/
		
		/*------------------------------------------------------------------------------------------------------------------------------------------*/
		case '3': // Modificar cantiddad Rapida
		{
				$codigo 		= strip_tags(@$_POST['codigo']);
				$cantidad	 	= strip_tags(@$_POST['cantidad']);

				
				if(isset($codigo) && isset($cantidad))
				{
					if ($cantidad <= 99999 && $cantidad > 0) 
					{
						if (Validar_codigo($codigo,$conexion) == true)
						{
							$fecha = date('Y-m-d H:i:s');
							$sql = mysqli_query($conexion, "UPDATE producto SET stock =  stock + '".$cantidad."' WHERE codigo_producto = '".$codigo."' LIMIT 1");				
							
							$descripcion = "Se a agrego ".$cantidad." producto al stock del producto ".$codigo." Fecha: ".$fecha.".";
							//$sql = mysqli_query($conexion, "INSERT INTO log (descripcion) VALUES ('".$descripcion."')");	

							$data = true;
						}
						else $data = 'El codigo del producto no esta registrado';	
					}
					else $data = 'La cantidad es invalida(Mayor a 0, Menor a 99999)';
				}
				else $data = 'Campos vacios, rellene';
		}
		break;
		/*------------------------------------------------------------------------------------------------------------------------------------------*/
	}

	echo $data;
}
?>