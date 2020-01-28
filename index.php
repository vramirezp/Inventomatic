
<?php 
	include('include/header.php');
	$arrayVenta = 'array';
?>

	<div class="text-center">

		<h1>Bienvenido a Inventomatic</h1>
		<hr class="hr-abajo">

		<picture>
		  <source media="(max-width: 799px)" srcset="imagenes/sanandres2.jpg">
		  <source media="(min-width: 800px)" srcset="imagenes/sanandres.jpg">
		  <img src="imagenes/sanandres.jpg" class="img-responsive img-rounded">
		</picture>

		
		<!-- <hr class="hr-abajo">

		<div class="text-center">
			<div class="col-xs-6" >
				<h3>
					Fecha:
					<?php echo date('Y-m-d');  ?>
				</h3>
			</div>
			<div class="col-xs-6">
				<h3>
					Hora:
					<?php echo date('H:i:s');?>
				</h3>
			</div>
		</div>
		</br>
		<hr>
		<script type="text/javascript" src="js/ventas.js"></script>	
		<div class="">
			<div class="col-xs-8">
				<div class="">
					<div class="panel-body padding-0">
						<form class="form-horizontal" action="" method="POST" id="agregarProductoLista" enctype="multipart/form-data">
							<input type="hidden" name="funcion" value="3">
							<div class="form-group">

								<div class="col-xs-9"">
									<div class = "input-group">
										<span class = "input-group-addon"><i class="fa fa-home"></i>  Agregar:</span>
										<input type="text" class="form-control" name="codigo" id="codigoF" placeholder="Lea el codigo del producto para agregar" required="" autofocus="">
									</div>
								</div>
								<div class="col-xs-3"">
									<div class="btn-group" >
										<button type="submit" class="btn btn-primary" id="agregarLista">Agregar</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="">
					  	<div class="panel-body padding-0">

					  		<table class="table table-bordered fondo-blanco" id="tablasMax">
								<thead>
									<tr style="background-color:#337AB7">
										<th class="text-center" style="color:#fff">ID</th>
										<th class="text-center" style="color:#fff">Codigo</th>
										<th class="text-center" style="color:#fff">Nombre producto</th>
										<th class="text-center" style="color:#fff">Precio c/u/</th>
										<th class="text-center" style="color:#fff">Cantidad/</th>
										<th class="text-center" style="color:#fff">Sub-Total/</th>
										<th class="text-center" style="color:#fff">Acciones</th>
									</tr>
								</thead>
								<tbody id="listaVentas">

								</tbody>
							</table>
					  	</div>
				  	</div>
			</div>		
			</div>
				<div class="col-xs-4 padding-right-5">
							<form class="form-horizontal" action="" method="POST" id="agregarVenta" enctype="multipart/form-data">
			    	<input type="hidden" name="arrayVenta2" value="<?php echo $arrayVenta ?>">
			    	<input type="hidden" name="funcion" value="2">
				    <div class="panel panel-default">
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Detalle de la compra:</h3>
					 	</div>
					  	<div class="panel-body padding-20 padding-top-15 padding-bottom-15">
							</br>
							
							<div class="">
								<h4>Cantidad de Productos:</h4>
								</br>
								<label class="" for="cantidad"><span id="total_items"></span> productos</label>
							</div>
							
							</br>
							<div class="">
								<h4>Total de la venta:</h4>
								</br>
								<label class="" for="cantidad">$ <span id="total_precio"></span> pesos</label>

							</div>
							<div class="margin-top-10">
							</br>
							
								<div class="btn-group btn-group-justified">
									<div class="btn-group">
										<button type="button" class="btn btn-danger" id="cancelarC">Cancelar</button>
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
			<div class="col-xs-8">
			</div>
		</ div>	-->
	</div>





<?php 
	include('include/footer.php');
?>