
<?php 
	include('include/header.php');
	  $ultimo_usuario=mysqli_fetch_array(mysqli_query($conexion,"SELECT num_usuario 'f' FROM usuario WHERE num_usuario = (SELECT MAX(num_usuario) from usuario)"));
      $num = $ultimo_usuario['f'] +1;
	if (@($_POST["accion"]=="guardar"))
    {
      $correo = $_POST["correo"];
      $pass =  md5($_POST["contra"]);
     
      $query = "INSERT INTO usuario VALUES('$num','$correo','$pass',1)";
      mysqli_query($conexion,$query);


        $sql="SELECT num_permiso FROM permiso";
	    $rs = mysqli_query($conexion,$sql);
	    while($row=mysqli_fetch_array($rs)){
	      
	      if(isset($_POST["cbox".$row["num_permiso"]]))
	      {
	      	 $numeroPermiso= $row["num_permiso"];
	      	 $query = "INSERT INTO usuario_has_permiso VALUES('$num','$numeroPermiso')";
      		 mysqli_query($conexion,$query);
	      }
	    }


      sleep(1);
      echo '<script type="text/javascript">';
      echo ' swal({
				type: "success",
				html: "Usuario Agregado",
				title: "Usuario Agregado Con Exito",
			});';
      echo '</script>';
    }

    if (!accesoLink("agregar_usuario.php")) {
        header('Location: index.php');
    }
?>

	<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.10.0/css/alertify.min.css"/>
	<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.10.0/css/themes/default.min.css"/>
	<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.10.0/css/alertify.rtl.min.css"/>
	<div class="text-center">
		
		<h1>Módulo creación de usuario</h1>
		<hr class="hr-abajo">		
	</div>

	<div class="rows">
		<div class="col-xs-12">
			<div class="row"> 
				<form class="form-horizontal" action="agregar_usuario.php" method="POST" id="formularioAgregarTipo" enctype="multipart/form-data">
			    	<input type="hidden" name="funcion" value="1">
				    <div class="panel panel-default">
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Ingreso datos de usuario:</h3>
					 	</div>
					  	<div class="panel-body padding-30 padding-top-15 padding-bottom-15">
							<div class="form-group">
								<div class="col-xs-5">
									<label class="" for="correo">Correo de usuario :</label>
								</div>
								<div class="col-xs-7">
									<input type="text" class="form-control" name="correo" id="correo" placeholder="Ejemplo:  mario@zapato.cl" required="" autofocus="">
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-5">
									<label class="" for="contra">Contraseña:</label>
								</div>
								<div class="col-xs-7">
									<input type="password" class="form-control" name="contra" id="contra" placeholder="****" required="">
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-5">
									<label class="" for="contra2">Repita contraseña:</label>
								</div>
								<div class="col-xs-7">
									<input type="password" class="form-control" name="contra2" id="contra2" placeholder="****" required="">
								</div>
							</div>
						
							<div class="form-group">
							<div class="col-xs-5">
									<label class="" for="capacidad">Permisos:</label>
							</div>
							<div class="col-xs-7">
							
						             <tr style="background-color:#337AB7">

						    <table>

							<?php

								$sql="SELECT num_permiso, nombre_modulo,descripcion FROM permiso";
								$rs = mysqli_query($conexion,$sql);
								$count=0;


								while($row=mysqli_fetch_array($rs)){
									$count = $count+1;
									if($count==1){
										echo "<tr>";
									}
						  		?>							  
							 		<th><label><input style="margin-left: 7px; margin-right: 1px;" type="checkbox" id="cbox1" name="cbox<?php echo $row["num_permiso"];?>"  value="<?php echo $row["num_permiso"];?>"><?php echo utf8_decode(utf8_encode($row["nombre_modulo"]));?></label><th>
							   
							
						 		<?php
						 			if($count==3){
							 			$count=0;
							 			echo "</tr>";
							 		}

								}
							?>

					            			    		       	
				            </table>


							</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-4">
									<button type="reset" class="btn btn-danger btn-block" id="cancelar">Limpiar</button>
								</div>		
								<div class="col-xs-4">
									
								</div>	
								<div class="col-xs-4">
									 <button type="button" class="btn btn-primary btn-block" id="agregar" name="agregar">Guardar</button>
									  <input type="hidden" id="accion" name="accion" value="">
								</div>						
							</div>
						</div>
					</div>
				</form>
			</div>

			
		</div>
		


<style type="text/css">
	.selectable-text {
    -webkit-user-select: text;
    -moz-user-select: text;
    -ms-user-select: text;
    user-select: text;
}
</style>
<script type="text/javascript">
$(document).ready(function(){

	$("#agregar").click(function(){

		 var jpass = $("#contra").val();
		 var jpass2 = $("#contra2").val();
		 var jcorreo = $("#correo").val();

		 try{

		 	if(jpass=="" || jpass2=="" || jcorreo=="")
		 	{
		 		throw "Complete los campos faltantes";
		 	}

		 	if(jpass!=jpass2)
		 	{
		 		throw "Las contraseñas deben coincidir";
		 	}

		 	if ($('input[type=checkbox]:checked').length === 0) 
		 	{
       
		        throw "Debe seleccionar al menos un permiso";
		    }
		
		 
		  document.getElementById("accion").value = "guardar";
		  $("#formularioAgregarTipo").submit();
		}catch(error){
        swal({
				type: 'error',
				html: error,
				title: 'Ups, ocurrio un error',
			});
      }
	 });
});

</script>
<?php 
	include('include/footer.php');
?>