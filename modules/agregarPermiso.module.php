<?php
require_once('../include/config.php');
if(count($_POST) > 0)
{
	
	$data = '';
	switch(@$_POST['funcion'])
	{
		case '1'://agregar
				
			$nombre 	= strip_tags(@$_POST['nombre_permiso']);
			$descripcion = strip_tags(@$_POST['descrip_permiso']);
			$link_pagina = strip_tags(@$_POST['link_pagina']);
			//var_dump($link_pagina);
			//var_dump($descripcion);
			if(isset($nombre) && isset($descripcion) )
			{
					if (strlen($nombre) < 30 && strlen($descripcion) < 200) 
					{
						if ($link_pagina != '0') {
						
							$sql = mysqli_query($conexion, "INSERT INTO permiso (nombre_modulo, descripcion, link) 
								VALUES ('".$nombre."', '".$descripcion."', '".$link_pagina."')");
									
									
							$data = true;
							
							
						}
						else $data = 'Debe seleccionar un link';
					}
					else $data = 'Nombre, descripcion o Capacidad superan los 45 caracteres!';
			}
			else $data = 'Campos vacios, rellene';
		
		break;
		/*------------------------------------------------------------------------------------------------------------------------------------------*/
		case '2': // Listar los permisos
				
		   $codigo = @$_POST['codigo'];
              //echo "mostrar codigo".$codigo;
			$page = @$_POST['pagina'];

			$limit = 0;

			$limit = (($limit > 0) ? $limit:4);

			$page = (($page > 0) ? $page:1);

			if(isset($codigo))
			{
				$codigo = ' WHERE nombre_modulo = "'.$codigo.'"';
				
			}
 
			$sqlCompleta = 
			"SELECT
				num_permiso,nombre_modulo,descripcion,link
			FROM 
				permiso
			".$codigo."
			
			ORDER BY 
				num_permiso DESC";


			$sql = mysqli_query($conexion, $sqlCompleta);

			//var_dump($sql);

			if($sql->num_rows > 0)
			{
				
				while($dato = $sql->fetch_assoc()) 
				{
					$data .=  
					'<tr>
						<td>'.$dato['num_permiso'].'</td>
						<td>'.$dato['nombre_modulo'].'</td>
						<td>'.$dato['descripcion'].'</td>
						<td>'.$dato['link'].'</td>
						<td class="text-center">
							<div class="btn-group pull-right">
								<a data-fancybox data-src="ModificarPermiso.php?id='.$dato['num_permiso'].'"  class="btn btn-primary" data-type="iframe" href="javascript:;">Modificar</a>
								<a data-fancybox data-src="eliminarpermiso.php?id='.$dato['num_permiso'].'"  class="btn btn-danger" data-type="iframe" href="javascript:;">Eliminar</a>
							</div>
						</td>
					</tr>';
				}
			}
			else $data = false;
		break;
		/*------------------------------------------------------------------------------------------------------------------------------------------*/
		case '3': /*listar informacion del permiso a modificar*/
		
			$codigo = strip_tags(@$_POST['codigo']);

			$page = strip_tags(@$_POST['pagina']);

			$limit = 0;

			$limit = (($limit > 0) ? $limit:15);

			$page = (($page > 0) ? $page:1);

			if(isset($codigo))
			{
				$codigo = '  num_permiso = "'.$codigo.'"';
			}

			$sqlCompleta = 
			"SELECT
				num_permiso,
				nombre_modulo,
				descripcion,
				link
			FROM 
				permiso
			WHERE
				num_permiso = ".$codigo."
			
			ORDER BY 
				num_permiso desc

			LIMIT ".($limit*($page-1)).", ".$limit;

			$sql = mysqli_query($conexion, $sqlCompleta);


			
		
			case '4': // Modificar permiso
		
			$id = @$_POST['id'];
			
				$nombre 	= strip_tags(@$_POST['nombre_permiso']);
				$marca 		= strip_tags(@$_POST['descrip_permiso']);
				$pag 		= strip_tags(@$_POST['link_pagina']);
			
				if(isset($nombre) && isset($marca))
				{
					if (strlen($nombre) < 46 && strlen($marca) < 46) 
					{
						$sql2 = mysqli_query($conexion, "SELECT link FROM permiso WHERE link='permisos.php' AND num_permiso = ".$id);

						if($dato2 = $sql2->fetch_assoc())
						{
							$data = "Este Permiso no se puede modificar";
						}
						else
						{
		     				$sql = mysqli_query($conexion, "UPDATE permiso SET nombre_modulo = '".$nombre."' , descripcion = '".$marca."' , link='".$pag."' WHERE num_permiso = '".$id."' LIMIT 1");
							$data = true;
						}

							
					}
					else $data = 'Nombre de Modulo o Descripción muy largos!';
				}
				else $data = 'Campos vacios, rellene';	
			
		
			break;
		case '5': // Eliminar permiso
		
			$id = @$_POST['id'];

			$sql2 = mysqli_query($conexion, "SELECT link FROM permiso WHERE link='permisos.php' AND num_permiso = ".$id);

			if($dato2 = $sql2->fetch_assoc())
			{
				$data = "Este Permiso no se puede eliminar";
			}
			else
			{
				$sql = mysqli_query($conexion, "DELETE FROM usuario_has_permiso WHERE PERMISO_num_permiso = ".$id);
	            $sql = mysqli_query($conexion, "DELETE FROM permiso WHERE num_permiso = ".$id);
				$data = true;
				/*if (!$sql) {
					$data = "Permiso en uso, no se puede eliminar";
				}*/
			}
			break;
	}

	echo ($data); 
}
?>