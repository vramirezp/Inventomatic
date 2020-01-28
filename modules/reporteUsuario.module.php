<?php
require_once('../include/config.php');
if(count($_POST) > 0)
{
	
	$data = '';
	switch(@$_POST['funcion'])
	{
		case '1'://Listar

		   
             //echo "mostrar codigo".$codigo;
			$filtro = @$_POST['filtro'];
			$codigo = @$_POST['codigo'];
			



			if(isset($codigo))
			{
		

				$codigo = ' WHERE '.$filtro.' = "'.$codigo.'"';
			}
 
			$sqlCompleta ="SELECT h_num_usuario, h_correo,h_codigo_producto,h_nombre, SUM(h_cantidad) AS SUMA FROM historico_prestamo ".$codigo." GROUP BY h_num_usuario, h_codigo_producto";


			$sql = mysqli_query($conexion, $sqlCompleta);

			//var_dump($sql);

			if($sql->num_rows > 0)
			{
				
				while($dato = $sql->fetch_assoc()) 
				{
					$data .=  
					'<tr>
						<td>'.$dato['h_num_usuario'].'</td>
						<td>'.$dato['h_correo'].'</td>
						<td>'.$dato['h_codigo_producto'].'</td>
					    <td>'.$dato['h_nombre'].'</td> 
					    <td>'.$dato['SUMA'].'</td> 
						</tr>';
				}
			}
			else $data = false;
		break;
	}
	echo ($data); 
}