<?php
require_once('../include/config.php');
if(count($_POST) > 0)
{
	
	$data = '';
	switch(@$_POST['funcion'])
	{
		case '1'://Listar

		   
             //echo "mostrar codigo".$codigo;
			$page = @$_POST['pagina'];

			$limit = 0;

			$limit = (($limit > 0) ? $limit:4);

			$page = (($page > 0) ? $page:1);

			
 
			$sqlCompleta ="SELECT  codigo_producto, nombre, fecha_prestamo, cantidad, cantidad_medible FROM usuario us JOIN usuario_has_producto uh ON (us.num_usuario=uh.usuario_num_usuario) JOIN producto p ON (uh.producto_codigo_producto=p.codigo_producto) WHERE  uh.estado=0 AND us.correo='".$_SESSION["usuario"]["correo"]."'";


			$sql = mysqli_query($conexion, $sqlCompleta);

			//var_dump($sql);

			if($sql->num_rows > 0)
			{
				
				while($dato = $sql->fetch_assoc()) 
				{
					$data .=  
					'<tr>
					    <td>'.$dato['codigo_producto'].'</td>
						<td>'.$dato['nombre'].'</td>
						<td>'.$dato['fecha_prestamo'].'</td>
					    <td>'.$dato['cantidad'].'</td> 
					    <td>'.$dato['cantidad_medible'].'</td> 
						</tr>';
				}
			}
			else $data = false;
		break;
	}
	echo ($data); 
}