<?php 
	include('include/header.php');
	if (!accesoLink("listaProductosEliminados.php")) {
		header('Location: index.php');
	}
?>

	<div class="text-center">
		<h1>Productos Deshabilitados</h1>
		<hr class="hr-abajo">
		<div class="">
			  	<div class="panel-body padding-0">

			  		<table class="table table-bordered fondo-blanco" id="tablasMax">
						<thead>
							<tr style="background-color:#337AB7">
								<th class="text-center" style="color:#fff">Codigo Producto</th>
								<th class="text-center" style="color:#fff">Nombre</th>
								<th class="text-center" style="color:#fff">Marca</th>
								<th class="text-center" style="color:#fff">Capacidad</th>
								<th class="text-center" style="color:#fff">Acción</th>
							</tr>
						</thead>
						<tbody id="listaProductos">

						</tbody>
					</table>
			  	</div>
		  	</div>
	</div>
	<script type="text/javascript" src="js/habilitarProduto.js"></script>
<?php 
	include('include/footer.php');
?>