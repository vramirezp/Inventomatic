<?php
require_once('../include/config.php');
if(count($_POST) > 0)
{
	
	$data = '';
	switch(@$_POST['funcion'])
	{
		case '1':
		{
			$correo = strip_tags(@$_POST['correo']);
			$pass 	= md5(strip_tags(@$_POST['pass']));
			$sqlCompleta = 
				"SELECT
					num_usuario,
					correo
				FROM 
					usuario
				WHERE
					estado = 1 AND correo = '".$correo."' AND clave = '".$pass."'";

			$sql = mysqli_query($conexion, $sqlCompleta);
			
			if($sql->num_rows > 0)
			{
				$_SESSION["usuario"] = mysqli_fetch_array($sql, MYSQLI_ASSOC);
				mysqli_free_result($sql);
				$sqlCompleta = 
				"SELECT
					p.num_permiso,
					p.link
				FROM 
					usuario u 
					INNER JOIN usuario_has_permiso up ON u.num_usuario = up.usuario_num_usuario 
					INNER JOIN permiso p ON up.PERMISO_num_permiso = p.num_permiso
				WHERE
					u.num_usuario = '".$_SESSION["usuario"]["num_usuario"]."'";

				$sql = mysqli_query($conexion, $sqlCompleta);
				if ($sql->num_rows > 0) {
					$permisos = array();
					while ($dato = $sql->fetch_assoc()) {
						$permisos[]= $dato;
					}
					//echo var_dump($permisos);
					$_SESSION["permisos"] = $permisos;
					$data = true;
				}				
			}
			else
			{
				$data = 'Clave o contraseña incorrecta';
			}
			break;
		}
		case '2':
		{
			$data = "delete";
			//remover las sesiones
			session_destroy();
			break;
		}
	}
	echo $data;
}

?>