<?php 
	include('include/config.php');
	include('include/scripts.php');
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
			$mostrar['stock']  	= $dato['stock'];
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
	    	<h1>Ajustando Producto: <?php echo $mostrar['nombre']; ?></h1>
			<hr class="hr-abajo">
		
	    	<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" id="formularioAjustar">
			  	<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
			  	<input type="hidden" name="stock" value="<?php echo $mostrar['stock']; ?>">
			  	<input type="hidden" name="funcion" value="2">
			  	<div class="panel-body padding-30 padding-top-15 padding-bottom-15">
			  		<div class="form-group">
						<label class="" for="marca"> Nuevo stock:</label>
						<div class="">
							<input type="number" class="form-control" name="NewStock" id="NewStock" placeholder="Nuevo stock">
						</div>
					</div>
					<div class="form-group">
						<label class="" for="marca"> Razón de ajuste de stock:</label>
						<div class="">
							<textarea class="form-control" id="razon" name="razon" placeholder="Ejemplo: Los productos estan vencidos" style="max-width: 100%;" maxlength="255" rows="4" cols="50"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="">
							<button type="submit" class="btn btn-primary btn-block" id="ajustarStock" name="ajustar">Ajustar</button>
						</div>	
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="js/ajuste.js"></script>

