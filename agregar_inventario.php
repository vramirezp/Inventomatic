
<?php 
	include('include/header.php');

	if (!accesoLink("agregar_inventario.php")) {
		header('Location: index.php');
	}
?>
	<script type="text/javascript" src="js/agregarInventario.js"></script>
	
	<div class="text-center">
		<h1>Módulo Ingreso Producto</h1>
		<hr class="hr-abajo">		
	</div>
	<div class="rows">
		<div class="col-sm-8">
			<div class="row"> 
				<form class="form-horizontal" action="" method="POST" id="formularioAgregarTipo" enctype="multipart/form-data">
			    	<input type="hidden" name="funcion" value="1">
				    <div class="panel panel-default">
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Ingreso tipo de producto:</h3>
					 	</div>
					  	<div class="panel-body padding-30 padding-top-15 padding-bottom-15">
							<div class="form-group">
								<div class="col-sm-5">
									<label class="" for="nombre">Nombre del Producto:</label>
								</div>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="nombre" placeholder="Ejemplo: Cable de Red Cat5" required="" autofocus="" maxlength="45">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-5">
									<label class="" for="marca">Marca del Producto:</label>
								</div>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="marca" placeholder="Ejemplo: Spektra" required="">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-5">
									<label class="" for="capacidad">Capacidad del producto:</label>
								</div>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="capacidad" placeholder="Ejemplo: 20 mts" required="">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-5">
									<label class="" for="codigo">Lea el código del producto:</label>
								</div>
								<div class="col-sm-7">
									<input type="number" class="form-control" min="1" max="9999999999999" name="codigo" placeholder="7 883212 32541 " required="" >
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-4">
									<button type="reset" class="btn btn-danger btn-block" id="cancelar">Limpiar</button>
								</div>		
								<div class="col-sm-4">
									
								</div>	
								<div class="col-sm-4">
									<button type="submit" class="btn btn-primary btn-block" id="agregar">Guardar</button>
								</div>						
							</div>
						</div>
					</div>
				</form>
			</div>			
		</div>	
		<div class="col-sm-4 padding-right-5">
			<form class="form-horizontal" action="" method="POST" id="formularioAddRapido" enctype="multipart/form-data">
				
				<input type="hidden" name="funcion" value="3">
			    <div class="panel panel-default">
				  	<div class="panel-heading">
				    	<h3 class="panel-title">Ingreso de inventario automático</h3>
				 	</div>
				  	<div class="panel-body padding-20 padding-top-15 padding-bottom-15">
						<div class="alert alert-info margin-0">
							<strong>Información:</strong> EL PRODUCTO DEBE HABER SIDO INGRESADO.
						</div>
						<div class="form-group">
							<label class="col-sm-5" for="cantidad">Cantidad:</label>
							<div class="col-sm-7">
								<input type="number" min="0" max="99999" class="form-control" name="cantidad" placeholder="Ejemplo: 200" id="quantityFast" required>
							</div>
						</div>
						<div class="">
							<label class="" for="codigo">Lea el codigo del producto:</label>
							<div class="">
								<input type="text" autocomplete="off" class="form-control" name="codigo" placeholder="Ejemplo: 7 883212 32541" id="codebarFast" required="">
							</div>
						</div>
						<div class="margin-top-10">

							<div class="btn-group btn-group-justified">
								<div class="btn-group">
									<button type="reset" class="btn btn-danger" id="cancelar">Limpiar</button>
								</div>
								<div class="btn-group">
									<button type="submit" class="btn btn-primary" id="guardar3">Guardar</button>
								</div>
								
							</div>
							
							<div class="clearfix"></div>					
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</form>
		</div>
		<div class="col-sm-4"></div>	
	</div>
	<div class="text-center">
		<div class="">
			<div class="panel-body padding-0">
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

<style type="text/css">
	.selectable-text {
    -webkit-user-select: text;
    -moz-user-select: text;
    -ms-user-select: text;
    user-select: text;
}
</style>

<?php 
	include('include/footer.php');
?>