<?php 
	include('include/config.php');
	include('include/scripts.php');

	/*if (!accesoLink("modificarproducto.php")) {
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
		$sqlCompleta = 
			"SELECT
				nombre,
				marca,
				capacidad
			FROM 
				producto
			WHERE
				codigo_producto= '".$id."'";

		$sql = mysqli_query($conexion, $sqlCompleta);

		//var_dump($sql);

		if($sql->num_rows > 0)
		{
			$dato = $sql->fetch_assoc();

			$mostrar['nombre'] 		= $dato['nombre'];
			$mostrar['marca'] 		= $dato['marca'];
			$mostrar['capacidad'] 	= $dato['capacidad'];
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

<script type="text/javascript" src="js/informegeneral.js"></script>
<div class="row">
	<div class="container">
	    <div class="">
	    	<h1>Modificar Producto: <?php echo $mostrar['nombre']; ?></h1>
			<hr class="hr-abajo">
		
	    	<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" id="formularioModificar">
			  	<input type="hidden" name="id" value="<?php echo $id; ?>">
			  	<input type="hidden" name="funcion" value="3">
			  	<div class="panel-body padding-30 padding-top-15 padding-bottom-15">
					<div class="form-group">
						<label class="" for="nombre">Modificar Nombre:</label>
						<div class="">
							<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $mostrar['nombre']; ?>" placeholder="Ejemplo: Galletas Kuky">
						</div>
					</div>
					<div class="form-group">
						<label class="" for="marca">Modificar Marca:</label>
						<div class="">
							<input type="text" class="form-control" id="marca" name="marca" value="<?php echo $mostrar['marca']; ?>" placeholder="Ejemplo: Nestlé">
						</div>
					</div>
					<div class="form-group">
						<label class="" for="capacidad">Modificar Capacidad:</label>
						<div class="">
							<input type="text" class="form-control" id="capacidad" name="capacidad" value="<?php echo $mostrar['capacidad']; ?>" placeholder="Ejemplo: 20 gramos">
						</div>
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
