<?php 
	include('include/config.php');
	include('include/scripts.php');

	if (!accesoLink("activarProducto.php")) {
		header('Location: index.php');
	}
?>

<?php
// Si pasa una ID POR GET entonces mostrar
$mostrar = [];
$id = @$_GET['id'];
if(count($_GET) > 0)
{
	
	if($id > 0 && is_numeric($id))
	{
		$sqlCompleta = 
			"SELECT
				nombre,
				stock
			FROM 
				producto
			WHERE
				codigo_producto= '".$id."'";

		$sql = mysqli_query($conexion, $sqlCompleta);

		if($sql->num_rows > 0)
		{
			$dato = $sql->fetch_assoc();

			$mostrar['nombre'] 	= $dato['nombre'];			
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
	    	<h1>Activar Producto: <?php echo $mostrar['nombre']; ?></h1>
			<hr class="hr-abajo">
		
	    	<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" id="formularioActivar">
			  	<input type="hidden" name="id" value="<?php echo $id; ?>">

			  	<input type="hidden" name="funcion" value="5">
			  	<div class="panel-body padding-30 padding-top-15 padding-bottom-15">
					<div class="form-group">
						<div class="alert alert-danger margin-0 text-center">
								<strong>Atención!</strong> Al activar este producto se restablecera, pero su stock sera 0.
							</div>
					</div>
			
					<div class="form-group">
						<div class="">
							<button type="submit" class="btn btn-primary btn-block" id="activar">Reactivar</button>
						</div>	
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="js/productosDesactivados.js"></script>