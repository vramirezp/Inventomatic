<?php
require('../include/config.php');
if(count($_POST) > 0)
{
	$data = '';
	switch(@$_POST['funcion'])
	{
		case '1':
		{
			$sqlCompleta1 = 
					"SELECT d.id_tipo_producto as codigo,CONCAT(p.nombre,' ',p.marca,' ',p.capacidad) as nombre,
					 SUM(d.cantidad) as cant 
					 FROM detalle d JOIN producto p ON(d.id_tipo_producto = p.id_tipo_producto) 
					 WHERE WEEK(d.fecha) = WEEK(sysdate()) 
					 GROUP BY d.id_tipo_producto 
					 ORDER BY cant DESC LIMIT 10";

			$sql1 = mysqli_query($conexion, $sqlCompleta1);

			if($sql1->num_rows > 0)
			{
				
				while($dato = $sql1->fetch_assoc()) 
				{
					$data .=  
					'<tr>
						<td>'.$dato['codigo'].'</td>
						<td>'.$dato['nombre'].'</td>
						<td>'.$dato['cant'].'</td>
					</tr>';
				}
			}
			else $data = false;
			break;
		}
		

		case '2':
		{
			$sqlCompleta2 = 
					"SELECT d.id_tipo_producto as codigo ,CONCAT(p.nombre,' ',p.marca,' ',p.capacidad)as nombre,
					 SUM(d.cantidad) as cant 
					 FROM detalle d JOIN producto p ON(d.id_tipo_producto = p.id_tipo_producto) 
					 WHERE DATE_FORMAT(d.fecha,'%m') = DATE_FORMAT(sysdate(),'%m') 
					 GROUP BY d.id_tipo_producto 
					 ORDER BY cant DESC LIMIT 10";

			$sql2 = mysqli_query($conexion, $sqlCompleta2);

			if($sql2->num_rows > 0)
			{
				
				while($dato = $sql2->fetch_assoc()) 
				{
					$data .=  
					'<tr>
						<td>'.$dato['codigo'].'</td>
						<td>'.$dato['nombre'].'</td>
						<td>'.$dato['cant'].'</td>
					</tr>';
				}
			}
			else $data = false;
			break;
		}
		

		case '3':
		{
			$sqlCompleta3 = 
					"SELECT p.id_tipo_producto as codigo ,CONCAT(p.nombre,' ',p.marca,' ',p.capacidad) as nombre, 
					 IFNULL(SUM(d.cantidad),0) as cant 
					 FROM detalle d RIGHT JOIN producto p ON(d.id_tipo_producto = p.id_tipo_producto)  
					 GROUP BY p.id_tipo_producto 
					 ORDER BY cant LIMIT 10"; 

			$sql3 = mysqli_query($conexion, $sqlCompleta3);


			if($sql3->num_rows > 0)
			{
				
				while($dato = $sql3->fetch_assoc()) 
				{
					$data .=  
					'<tr>
						<td>'.$dato['codigo'].'</td>
						<td>'.$dato['nombre'].'</td>
						<td>'.$dato['cant'].'</td>
					</tr>';
				}
			}
			else $data = false;
			break;
		}
		
		case '4':
		{
			$sqlCompleta4 = 
					"SELECT id_tipo_producto,CONCAT(nombre,' ',marca,' ',capacidad) as nombre,stock 
					 FROM `producto` 
					 WHERE stock <= 5";

			$sql4 = mysqli_query($conexion, $sqlCompleta4);

			if($sql4->num_rows > 0)
			{
				
				while($dato = $sql4->fetch_assoc()) 
				{
					$data .=  
					'<tr>
						<td>'.$dato['id_tipo_producto'].'</td>
						<td>'.$dato['nombre'].'</td>
						<td>'.$dato['stock'].'</td>
					</tr>';
				}
			}
			else $data = false;
			break;
		}
	}
	echo $data;
}
?>	