<?php 
	include('include/config.php');
	include('include/scripts.php');

	/*if (!accesoLink("eliminarpermiso.php")) {
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
              num_permiso,nombre_modulo,descripcion
            FROM 
                permiso
            WHERE
                num_permiso= '".$id."'";

	    $sql = mysqli_query($conexion, $sqlCompleta);

        //var_dump($sql);

        if($sql->num_rows > 0)
        {
            $dato = $sql->fetch_assoc();

            $mostrar['num_permiso']      = $dato['num_permiso'];
            $mostrar['nombre_modulo']       = $dato['nombre_modulo'];
            $mostrar['descripcion']      = $dato['descripcion'];
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
	    	<h1>Eliminar Permiso</h1>
			<hr class="hr-abajo">
		
	    	<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" id="formularioEliminar">
	    	
			  	<input type="hidden" name="id" value="<?php echo $mostrar['num_permiso'];?>">
			  	<input type="hidden" name="funcion" value="5">
			  	<div class="panel-body padding-30 padding-top-15 padding-bottom-15">
					<div class="form-group">
						<div class="alert alert-danger margin-0 text-justified">
								<strong>Atención!</strong> Al eliminar este permiso, <strong>TODOS</strong> los usuarios perderán el acceso a <strong><?php echo $mostrar['nombre_modulo']; ?></strong>. 
							</div>
					</div>
					<div class="form-group">
						<div class="">
						<button type="reset" class="btn btn-danger btn-block" id="cancelar">Cancelar</button>
					    <button type="submit" class="btn btn-primary btn-block" id="eliminar">Eliminar</button>
						</div>	
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="js/permisos.js"></script>