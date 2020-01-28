

<?php 
	include('include/header.php');
	$arrayVenta = 'array';
?>
<div class="text-center">

		<h1>Módulo de Devolución</h1>
		<hr class="hr-abajo">
		<hr>
		<script type="text/javascript" src="js/devolucion.js"></script>	
		<div class="">
			<div class="col-xs-12">
				
				<div class="">
					<div class="panel-body padding-0">
						<form class="form-horizontal" action="" method="POST" id="agregarProductoLista" enctype="multipart/form-data">
							<input type="hidden" name="funcion" value="3">
							<div class="form-group">

								<div class="col-xs-6"">
									<div class = "input-group">
										<span class = "input-group-addon"><i class="fa fa-product-hunt"></i>  Codigo:</span>
										<input type="text" class="form-control" name="codigo" id="codigoF" placeholder="Código del producto" required="" autofocus="true">
									</div>
								</div>
								<div class="col-xs-4"">
									<div class = "input-group">
										<span class = "input-group-addon"><i class="fa fa-sort-numeric-asc"></i>  Cantidad:</span>
										<input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad" required="" autofocus="" value="1" onfocus="sobreCampo(this)">
									</div>
								</div>
								<div class="col-xs-2">
									<div class="btn-group" >
										<button type="submit" class="btn btn-primary" id="devolverProducto">Devolver producto</button>
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
										<th class="text-center" style="color:#fff">Codigo Producto</th>
										<th class="text-center" style="color:#fff">Nombre Producto</th>
										<th class="text-center" style="color:#fff">Cantidad</th>
										<th class="text-center" style="color:#fff">Fecha Prestamo</th>
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
			<!--
				<div class="col-xs-4 padding-right-5">
							<form class="form-horizontal" action="" method="POST" id="agregarVenta" enctype="multipart/form-data">
			    	<input type="hidden" name="arrayVenta2" value="<?php echo $arrayVenta ?>">
			    	<input type="hidden" name="funcion" value="2">
				    <div class="panel panel-default">
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Detalle de Devolución:</h3>
					 	</div>
					  	<div class="panel-body padding-20 padding-top-15 padding-bottom-15">
							</br>
							
							<div class="">
								<h4>Cantidad de Productos:</h4>
								</br>
								<label class="" for="cantidad"><span id="total_items"></span> por devolver</label>
							</div>
							
							</br>
							
							<div class="margin-top-10">
							</br>
							
								<div class="btn-group btn-group-justified">
									<div class="btn-group">								
										<button type="submit" class="btn btn-primary" id="guardar3">Devolución Completa</button>
									</div>
									
								</div>
								
								<div class="clearfix"></div>					
							</div>
							<div class="clearfix"></div>
						
						</div>
					</div>
				</form>
		</div>
		-->
			<div class="col-xs-8">
			</div>
		</div>	
	</div>





<?php 
	include('include/footer.php');
?>