<?php
require_once('../include/config.php');
if(count($_POST) > 0)
{
	
	$data = '';
	switch(@$_POST['funcion'])
	{
		case '1'://Listar

		   
            $filtro = @$_POST['filtro'];
			$codigo = @$_POST['codigo'];
			

				if(isset($codigo))
			{
		

				$codigo = ' and '.$filtro.' = "'.$codigo.'"';
			}
 
			$sqlCompleta ="SELECT hd_id, hd_codigo_producto, hd_nombre, hd_fecha_devolucion, hd_cantidad FROM historico_devolucion WHERE hd_num_usuario='".$_SESSION["usuario"]["num_usuario"]."'" ;


			$sql = mysqli_query($conexion, $sqlCompleta);

			//var_dump($sql);

			if($sql->num_rows > 0)
			{	
				while($dato = $sql->fetch_assoc()) 
				{
					$data .=  
					'<tr>
						<td>'.$dato['hd_id'].'</td>
						<td>'.$dato['hd_codigo_producto'].'</td>
						<td>'.$dato['hd_nombre'].'</td>
					    <td>'.$dato['hd_cantidad'].'</td> 
					    <td>'.$dato['hd_fecha_devolucion'].'</td> 
						</tr>';
				}
			}
			else $data = false;
		break;
	}
	echo ($data); 
}