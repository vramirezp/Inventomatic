<?php
require_once('../include/config.php');
if(count($_POST) > 0)
{
	
	$data = '';
	switch(@$_POST['funcion'])
	{
		case '1'://Listar

		   	$codigo = @$_POST['codigo'];
             //echo "mostrar codigo".$codigo;
			$page = @$_POST['pagina'];

			$limit = 0;

			$limit = (($limit > 0) ? $limit:4);

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
			".$codigo."
			
			ORDER BY 
				fecha_ingreso ASC";


			$sql = mysqli_query($conexion, $sqlCompleta);


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
					</tr>';
				}
			}
			else $data = false;
		break;
	}
	echo ($data); 
}