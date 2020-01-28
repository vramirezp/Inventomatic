
<?php 
	include('include/header.php');
	$pagina = @$_GET['pagina'];
	if(!isset($pagina)) 
	{
		$pagina = 1;
		$pagina_siguiente = $pagina + 1;
		$pagina_atras = 1;
	}
	else
	{
		if($pagina <= 1) $pagina_atras = 1;
		else $pagina_atras = $pagina - 1;

		$pagina_siguiente = $pagina + 1;
	}

	if (!accesoLink("informe_general.php")) {
		header('Location: index.php');
	}
?>
	<input type="hidden" name="pagina" value="<?php echo $pagina; ?>" id="pagina">
	<div class="text-center">
		<h1>Informe general de inventario</h1>
		<div>
		<hr class="hr-abajo">
		<div class="">
			<div class="panel-body padding-0">
				<form class="form-horizontal" action="" method="POST" id="buscarProducto" enctype="multipart/form-data">
					<input type="hidden" name="funcion" value="1">
					<div class="form-group">
						<div class="col-sm-9">
							<div class = "input-group">
								<span class = "input-group-addon"><i class="fa fa-search"></i>  Buscar:</span>
								<input type="text" class="form-control" name="codigo" id="codigoF" placeholder="Lea el codigo del producto a buscar" required=""autofocus>
							</div>
							
						</div>
						<div class="col-sm-3">
							<div class="btn-group" >
								<button type="submit" class="btn btn-primary" id="buscar">Buscar</button>
								<button type="button" class="btn btn-default" id="mTodos">Mostrar todos</button>
							</div>
							
						</div>	
					</div>
				</form>
			</div>
		</div>
		<hr class="hr-abajo">
		<div class="">
		  	<div class="panel-body padding-0">
		  		<div class="table-responsive">
			  		<table class="table table-bordered fondo-blanco" id="tablasMax">
						<thead>
							<tr style="background-color:#337AB7">
								<th class="text-center" style="color:#fff">Codigo Producto</th>
								<th class="text-center" style="color:#fff">Nombre</th>
								<th class="text-center" style="color:#fff">Marca</th>
								<th class="text-center" style="color:#fff">Capacidad</th>
								<th class="text-center" style="color:#fff">Fecha Ingreso</th>
								<th class="text-center" style="color:#fff">Stock</th>
								<th class="text-center" style="color:#fff">Acciones</th>
							</tr>
						</thead>
						<tbody id="listaProductos">

						</tbody>
					</table>
		  		</div>
		  	</div>
	  	</div>
	</div>
	<script type="text/javascript" src="js/informegeneral.js"></script>
	
<?php 
	include('include/footer.php');
?>