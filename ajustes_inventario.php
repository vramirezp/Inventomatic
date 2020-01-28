
<?php 
	include('include/header.php');

	if (!accesoLink("ajustes_inventario.php")) {
		header('Location: /inventomatic');
	}
?>
<div class="text-center">
	<h1>Ajuste de inventario</h1>
	<hr class="hr-abajo">	
</div>
<div class="rows">

	<div class="text-center">		
		
		<div class="">
			  	<div class="panel-body padding-0">
<input type="hidden" id="test" value="5"/>
			  		<table class="table table-bordered fondo-blanco" id="tablasMax">
						<thead>
							<tr style="background-color:#337AB7">
								<th class="text-center" style="color:#fff">Codigo Producto</th>
								<th class="text-center" style="color:#fff">Nombre</th>
								<th class="text-center" style="color:#fff">Stock Virtual</th>
								<th class="text-center" style="color:#fff">Acciones</th>
							</tr>
						</thead>
						<tbody id="listaProductos">

						</tbody>
					</table>
			  	</div>
		  	</div>
	</div>
	<script type="text/javascript" src="js/ajuste.js"></script>
	
<?php 
	include('include/footer.php');
?>