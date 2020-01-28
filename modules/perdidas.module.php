<?php
require('../include/config.php');
if(count($_POST) > 0)
{
	$data = '';
	switch(@$_POST['funcion'])
	{
		case '1'://listar
		{
			$codigo = @$_POST['codigo'];

			if(isset($codigo))
			{
				$sqlCompleta = 
					"SELECT
						id_tipo_producto,
						nombre,
						fecha,
						precio,
						stock_ant,
						stock_nuv,
						(stock_nuv - stock_ant) as diferencia,
						((stock_nuv - stock_ant)*-1) * precio as perdida
					FROM 
						ajuste_inventario
					WHERE
						(stock_nuv - stock_ant) < 0 
						AND
						id_tipo_producto = '".$codigo."' 
					ORDER BY 
						fecha ASC";
			}
			else
			{
				$sqlCompleta = 
					"SELECT
						id_tipo_producto,
						nombre,
						fecha,
						precio,
						stock_ant,
						stock_nuv,
						(stock_nuv - stock_ant) as diferencia,
						((stock_nuv - stock_ant)*-1) * precio as perdida
					FROM 
						ajuste_inventario
					WHERE
						(stock_nuv - stock_ant) < 0
					ORDER BY 
						fecha ASC";
			}


			$sql = mysqli_query($conexion, $sqlCompleta);

			//var_dump($sql);

			if($sql->num_rows > 0)
			{
				
				while($dato = $sql->fetch_assoc()) 
				{
					$data .=  
					'<tr>
						<td>'.$dato['id_tipo_producto'].'</td>
						<td>'.$dato['nombre'].'</td>
						<td>'.$dato['fecha'].'</td>
						<td>$'.$dato['precio'].'</td>
						<td style="color:red">'.$dato['diferencia'].'</td>
						<td style="color:red">$'.$dato['perdida'].'</td>
					</tr>';
				}
			}
			else $data = false;
		}
		break;

		case '2':
		{
			$codigo = @$_POST['codigo'];

			if(isset($codigo))
			{
				$codigo = 'WHERE id_tipo_producto = "'.$codigo.'"';
			}

			$sqlCompleta = 
			"SELECT
				id_tipo_producto,
				nombre_producto,
				fecha,
				stock_eliminado,
				razon
			FROM 
				eliminacion_deproducto

			".$codigo."
			
			ORDER BY 
				fecha ASC";

			$sql = mysqli_query($conexion, $sqlCompleta);

			if($sql->num_rows > 0)
			{
				
				while($dato = $sql->fetch_assoc()) 
				{
					$data .=  	
					'<tr>
						<td>'.$dato['id_tipo_producto'].'</td>
						<td>'.$dato['nombre_producto'].'</td>
						<td>'.$dato['fecha'].'</td>
						<td>'.$dato['stock_eliminado'].'</td>
						<td style="word-break: break-word;">'.$dato['razon'].'</td>
					</tr>';
				}
			}
			else $data = false;
		}
		break;
		
		
	}
	echo $data;
}
?>	