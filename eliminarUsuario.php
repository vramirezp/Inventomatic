<?php 
	include('include/config.php');
	include('include/scripts.php');

	/*if (!accesoLink("eliminarUsuario.php")) {
		header('Location: index.php');
	}*/
?>

<?php
// Si pasa una ID POR GET entonces mostrar
$mostrar = [];
$id = @$_GET['id'];
$de=0;

if(count($_GET) > 0)
{
	$de=1;
	if($id > 0 && is_numeric($id))
	{
		$de=2;
		$sqlCompleta = 
			"SELECT
				num_usuario,
				correo,
				estado
			FROM 
				usuario
			WHERE
				num_usuario= '".$id."'";

		$sql = mysqli_query($conexion, $sqlCompleta);

		if($sql->num_rows > 0)
		{
			$de=3;
			$dato = $sql->fetch_assoc();

			$mostrar['num_usuario'] = $dato['num_usuario'];
			$mostrar['correo']  	= $dato['correo'];
			$mostrar['estado']  	= $dato['estado'];
		}
	}
}
?>
<style>
	body
	{
		background: none !important;
		max-width:500px;
		max-height:300px;
		overflow-y: auto;
		overflow-x: hidden;
		padding:30px;
	}
</style>


<div class="row">
	<div class="container">
	    <div class="">
	    	<h1>Eliminar usuario: <?php echo  $id ; ?></h1>
			<hr class="hr-abajo">
	    	<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" id="formularioEliminar">
			  	<input type="hidden" name="id" value="<?php echo $id; ?>">
				  <input type="hidden" name="est" value="<?php echo $mostrar['estado']; ?>">
			  	<input type="hidden" name="funcion" value="2">
			  	<div class="panel-body padding-30 padding-top-15 padding-bottom-15">
					<div class="form-group">
						<div class="alert alert-danger margin-0 text-center">
								<strong>Atención!</strong> Este usuario no podrá realizar ningún tipo de acción! <? echo 'ID = '.$de; ?>
						</div>
					</div>
					<div class="form-group">
						<div class="">
							<button type="submit" class="btn btn-primary btn-block" id="eliminar">Eliminar</button>
						</div>	
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="js/listarUsuario.js"></script>