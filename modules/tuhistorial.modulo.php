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
			
             //echo "mostrar codigo".$codigo;
			

			if(isset($codigo))
			{
	
				$codigo = ' and '.$filtro.' = "'.$codigo.'"';
			}

			
 
			$sqlCompleta ="SELECT h_id, h_codigo_producto, h_nombre, h_fecha_prestamo, h_cantidad FROM historico_prestamo WHERE h_correo='".$_SESSION["usuario"]["correo"]."'";


			$sql = mysqli_query($conexion, $sqlCompleta);

			//var_dump($sql);

			if($sql->num_rows > 0)
			{
				
				while($dato = $sql->fetch_assoc()) 
				{
					$data .=  
					'<tr>
						<td>'.$dato['h_id'].'</td>
						<td>'.$dato['h_codigo_producto'].'</td>
						<td>'.$dato['h_nombre'].'</td>
					    <td>'.$dato['h_cantidad'].'</td> 
					    <td>'.$dato['h_fecha_prestamo'].'</td> 
					</tr>';
				}
			}
			else $data = false;
		break;
	}
	echo ($data); 
}