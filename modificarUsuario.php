<?php 
	include('include/config.php');
	include('include/scripts.php');

	/*if (!accesoLink("modificarUsuario.php")) {
        header('Location: index.php');
    }*/
?>

<?php
// Si pasa una ID POR GET entonces mostrar
$mostrar = [];
$id = @$_GET['id'];
if(count($_GET) > 0)
{
	
	if($id > 0 && is_numeric($id))
	{
		$listaPermisos = array();
		$sqlCompleta = 
			"SELECT
			    num_usuario,
				correo
			FROM 
				usuario
			WHERE
				num_usuario= '".$id."'";

		$sql = mysqli_query($conexion, $sqlCompleta);

		$sql1="SELECT peruser.PERMISO_num_permiso, permi.nombre_modulo FROM usuario_has_permiso peruser LEFT JOIN permiso permi ON peruser.PERMISO_num_permiso=permi.num_permiso  WHERE USUARIO_num_usuario='".$id."'";
		$rs = mysqli_query($conexion,$sql1);


		while($row=mysqli_fetch_array($rs)){
			array_push($listaPermisos, $row['PERMISO_num_permiso']);
		}
		//var_dump($sql);

		if($sql->num_rows > 0)
		{
			$dato = $sql->fetch_assoc();
			$mostrar['num_usuario'] = $dato['num_usuario'];
			$mostrar['correo'] 		= $dato['correo'];
			
		}
	}
}
?>
<style>
	body
	{
		background: none !important;
	}
</style>

<script type="text/javascript" src="js/listarUsuario.js"></script>
<div class="row">
	<div class="container">
	    <div class="">
	    	<h1>Modificar Usuario</h1>
			<hr class="hr-abajo">
	    	<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" id="formularioModificar">
			  	<input type="hidden" name="id" value="<?php echo $id; ?>">
			  	<input type="hidden" name="funcion" value="3">
			  	<div class="panel-body padding-30 padding-top-15 padding-bottom-15">
					<div class="form-group">
						<label class="" for="nombre">Modificar Correo:</label>
						<div class="">
							<input type="text" class="form-control" id="correo" name="correo" value="<?php echo $mostrar['correo']; ?>">
						</div>
					</div>
				
				
					<div class="col-xs-5">
		             	<tr style="background-color:#337AB7">
							<?php

								$sql="SELECT num_permiso, nombre_modulo,descripcion FROM permiso ORDER BY nombre_modulo ASC";
								$rs = mysqli_query($conexion,$sql);
								while($row=mysqli_fetch_array($rs)){
						  	?>							  
							 <label><input type="checkbox" id="cbox1" name="cbox<?php echo $row["num_permiso"];?>" <?php echo in_array($row["num_permiso"], $listaPermisos) ? 'checked' : '';  ?> value="<?php echo $row["num_permiso"];?>"><?php echo " ".utf8_decode(utf8_encode($row["nombre_modulo"]));?></label></br>	
							   
							 
						 	<?php   
								}
							?>			            			    		       	
		          		</tr>
					</div>
					<div class="form-group">
						<div class="">
							<button type="submit" class="btn btn-primary btn-block" id="guardar">Guardar</button>
						</div>	
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
