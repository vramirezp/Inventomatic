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
 
			$sqlCompleta ="SELECT nro_ajuste, fecha, stock_fisico, stock_virtual, merma, nombre,usuario,motivo FROM ajuste_inventario us JOIN producto uh ON (us.producto_codigo_producto=uh.codigo_producto)  ".$codigo."";


			$sql = mysqli_query($conexion, $sqlCompleta);

			if($sql->num_rows > 0)
			{
				
				while($dato = $sql->fetch_assoc()) 
				{
					$data .=  
					'<tr>
					    <td>'.$dato['nro_ajuste'].'</td>
						<td>'.$dato['fecha'].'</td>
						<td>'.$dato['stock_fisico'].'</td>
					    <td>'.$dato['stock_virtual'].'</td> 
					    <td>'.$dato['merma'].'</td> 
					     <td>'.$dato['nombre'].'</td> 
					    <td>'.$dato['usuario'].'</td> 
					    <td>'.$dato['motivo'].'</td> 
						</tr>';
				}
			}
			else $data = false;
		break;
	}
	echo ($data); 
}