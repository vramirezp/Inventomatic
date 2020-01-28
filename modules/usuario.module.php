<?php
require('../include/config.php');
if(count($_POST) > 0)
{
	$data = '';
	switch(@$_POST['funcion'])
	{
		case '1':
		{
			$codigo = @$_POST['codigo'];
			
			$page = @$_POST['pagina'];

			$limit = 0;

			$limit = (($limit > 0) ? $limit:15);

			$page = (($page > 0) ? $page:1);

			if(isset($codigo))
			{
				$codigo = ' WHERE num_usuario = "'.$codigo.'"';
			}

			$sqlCompleta = 
			"SELECT
				num_usuario,
				correo,
				estado
			FROM 
				usuario

			".$codigo."

			LIMIT ".($limit*($page-1)).", ".$limit;

			//var_dump($sqlCompleta);

			$sql = mysqli_query($conexion, $sqlCompleta);

			//var_dump($sql);
		

			if($sql->num_rows > 0)
			{	
				while($dato = $sql->fetch_assoc()) 
				{
					$usuarioNumero = $dato['num_usuario'];
					$permisos = "";
					$sql1="SELECT peruser.permiso_num_permiso,permi.nombre_modulo FROM usuario_has_permiso peruser LEFT JOIN permiso permi ON peruser.PERMISO_num_permiso=permi.num_permiso  WHERE peruser.USUARIO_num_usuario='".$usuarioNumero."' ORDER BY permi.nombre_modulo DESC";
		            $rs = mysqli_query($conexion,$sql1);
		            while($row=mysqli_fetch_array($rs)){
		              
		              	$porciones = explode(" ", $row['nombre_modulo']);
		                $permisos.=substr(ucwords($porciones[0]),0,1).'/';
		           }
		           	$estadobacan= "";
		            if($dato['estado']==1){$estadobacan= "Activo";}else{$estadobacan= "Inactivo";}
					$data .=  
					'<tr>
						<td>'.$dato['num_usuario'].'</td>
						<td>'.$dato['correo'].'</td>
						<td>'.$permisos.'</td>
						<td>'.$estadobacan.'</td>
						<td class="text-center">
							<div class="btn-group">
							<a data-fancybox data-src="modificarpass.php?id='.$dato['num_usuario'].'"  class="btn btn-default" data-type="iframe" href="javascript:;">Cambiar Contraseña</a>
								<a data-fancybox data-src="modificarUsuario.php?id='.$dato['num_usuario'].'"  class="btn btn-primary" data-type="iframe" href="javascript:;">Modificar</a>
								<a data-fancybox data-src="eliminarUsuario.php?id='.$dato['num_usuario'].'" class="btn btn-danger" data-type="iframe" href="javascript:;">Eliminar</a>
							</div>
						</td>
					</tr>';
				}
			}
			else $data = false;
		}
		break;
		case '2': // Eliminar usuario
		{
			$id = @$_POST['id'];
			$estad=@$_POST['est'];
			if($id > 0)
			{	
				if($estad==0){
					$estado = 1;
					$sql = mysqli_query($conexion, "UPDATE usuario SET estado = '".$estado."' WHERE num_usuario = '".$id."' LIMIT 1");
					$data = true;
				} else if ($estad==1){
					$estado = 0;
				$sql = mysqli_query($conexion, "UPDATE usuario SET estado = '".$estado."' WHERE num_usuario = '".$id."' LIMIT 1");
				$data = true;
				}
				
				
			}
		}
		break;

		case '3': // Modificar usuario
		{
			$id = @$_POST['id'];
			if($id > 0)
			{
				$correo 	= strip_tags(@$_POST['correo']);
				$permisominimo = 0;
				if(isset($correo))
				{
				
				$sql="SELECT num_permiso FROM permiso";
				     $rs = mysqli_query($conexion,$sql);
				     while($row=mysqli_fetch_array($rs)){
				      
				       if(isset($_POST["cbox".$row["num_permiso"]]))
				       {
				       	 $permisominimo= 1;
				      	 break;
				       }
				     }

				     if($permisominimo>=1)
				     {
				     	$sql = mysqli_query($conexion, "UPDATE usuario SET correo = '".$correo."'  WHERE num_usuario = '".$id."' LIMIT 1");
						$query1 = "DELETE FROM usuario_has_permiso WHERE USUARIO_num_usuario='$id'";
  						mysqli_query($conexion,$sql);
  						mysqli_query($conexion,$query1);
						 $sql="SELECT num_permiso FROM permiso";
					     $rs = mysqli_query($conexion,$sql);
					     while($row=mysqli_fetch_array($rs)){
					      
					       if(isset($_POST["cbox".$row["num_permiso"]]))
					       {
					       	 
					      	 $numeroPermiso= $row["num_permiso"];
					      	 $query2 = "INSERT INTO usuario_has_permiso VALUES('$id','$numeroPermiso')";
				    		 mysqli_query($conexion,$query2);
				       		}
				       		$data = true;
				     }
				 }
				     else $data = 'Debe seleccionar al menos un permiso';

				}
				else $data = 'Campos vacios, rellene';	
			}
		}
		break;
		case '4': // Modificar contraseña usuario
		{
			$id = @$_POST['id'];
			if($id > 0)
			{
				$pass 		= strip_tags(@$_POST['contra']);
				$pass2 		= strip_tags(@$_POST['contra2']);
				if(isset($pass) && isset($pass2) )
				{
					if ($pass==$pass2) 
					{
						$sql = mysqli_query($conexion, "UPDATE usuario SET clave = '".md5($pass)."' WHERE num_usuario = '".$id."' LIMIT 1");
						mysqli_query($conexion,$sql);
						$data = true;
					}
					else $data = 'Las contraseñas introducidas no coinciden';
				}
				else  $data = 'Campos vacios, rellene';

			}
			else $data = "una mierda";
		}
		break;

	}
	echo $data;
}
?>	