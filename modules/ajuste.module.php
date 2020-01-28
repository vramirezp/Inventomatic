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
				CONCAT(nombre,' ',marca) as nombre,
				stock
			FROM 
				producto
			WHERE
				estado = 1
			".$codigo."
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
					'<tr id="tr'.$dato['codigo_producto'].'">
						<td>'.$dato['codigo_producto'].'</td>
						<td>'.$dato['nombre'].'</td>
						<td>'.$dato['stock'].'</td>
						<td class="text-center">
							<div class="btn-groups ">
								<a data-fancybox data-src="modificarStock.php?id='.$dato['codigo_producto'].'" id_producto="'.$dato['codigo_producto'].'" class="btn btn-primary btn-block" data-type="iframe" href="javascript:;">Ajustar</a>
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
			//echo var_dump("entra");
			$id = @$_POST['id'];

			if(isset($id))
			{
				$valor 	= strip_tags(@$_POST['valor']);
				$motivo = strip_tags(@$_POST['motivo']);

				if(isset($valor))
				{
					$valor = (int) $valor;

					if ($valor <= 999999 && $valor > 0)
					{
						if (isset($motivo) && strlen($motivo)>0) 
						{
							$sqlprd = 
							"SELECT
								stock
							FROM 
								producto WHERE codigo_producto = '".$id."' LIMIT 1";

							$x = mysqli_query($conexion, $sqlprd);

							while($var = $x->fetch_assoc()) 
							{	
								$fecha = date('Y-m-d');
								$merma = ($valor - $var['stock'])*1;
								mysqli_query($conexion, "INSERT INTO ajuste_inventario(fecha,stock_fisico,stock_virtual,merma,PRODUCTO_codigo_producto, motivo,usuario) VALUES ('".$fecha."', '".$valor."','".$var['stock']."','".$merma."','".$id."', '".$motivo."','".$_SESSION['usuario']['correo']."')");
							}	

							$sql = mysqli_query($conexion, "UPDATE producto SET stock = '".$valor."' WHERE codigo_producto = '".$id."' LIMIT 1");


							$data = true;
						}
						else
						{
							$data = "Debe ingresar un motivo";
						}
					}
					else $data = 'Stock Invalido';	
				}
				else $data = 'Campos vacios, rellene';
			}
			else
			{
				$data ="Codigo no encontrado";
			}

		}
		break;
	}
	echo $data;
}
?>	