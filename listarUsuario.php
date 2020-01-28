
<?php 
	include('include/header.php');
	if (!accesoLink("listarUsuario.php")) {
		header('Location: index.php');
	}
?>
	<div class="text-center">
		<h1>Informe general de usuarios</h1>		
		<hr class="hr-abajo">
		<div class="">
		  	<div class="panel-body padding-0">  		
		  		<table class="table table-bordered fondo-blanco" id="tablasMax">
					<thead>
						<tr style="background-color:#337AB7">
							<th class="text-center" style="color:#fff">Número de usuario</th>
							<th class="text-center" style="color:#fff">Correo</th>
							<th class="text-center" style="color:#fff">Permisos</th>
							<th class="text-center" style="color:#fff">Estado</th>
							<th class="text-center" style="color:#fff">Acciones</th>
						</tr>
					</thead>
					<tbody id="listaProductos">

					</tbody>
				</table>
		  	</div>
	  	</div>
	</div>
	<script type="text/javascript" src="js/listarUsuario.js"></script>
	
<?php 
	include('include/footer.php');
?>