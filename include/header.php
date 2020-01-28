<?php 
	require_once('config.php'); 
	if (!isset($_SESSION['usuario'])) {
		header('Location: login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inventomatic</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="imagenes/icono.ico" type="image/x-icon">
	<link rel="icon" href="imagenes/icono.ico" type="image/x-icon">
<?php 
	include('scripts.php'); 
?>
	
</head>
<style>
	input::-webkit-outer-spin-button,input::-webkit-inner-spin-button 
	{
    	-webkit-appearance: none;
    	margin: 0;
	}
</style>
<body>
<div class="fondo-arriba">
	<div class="container">
		<div class="titulo-pagina">

			<a href="index.php"><div class="pull-left"><img src="imagenes/logo4.png" class=""></div></a>
			<div class="pull-right"><img src="imagenes/logo.png" class="logo pull-right"></div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>


<nav class="navbar navbar-default border-bottom-0 border-abajo-celeste fondo-abajo-trans border-radius-0" role="navigation">
	<div class="container nav-inferior-padding ">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			</button>
  			<a class="navbar-brand" style="font-size: 14px;" href="index.php"><span class="fa fa-home"></span> Inicio</a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav nav-inferior">
				<li id="productosid" class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="fa fa-briefcase"></span> Productos <b class="caret"></b>
						</a>
					<ul class="dropdown-menu">
						<?php $productos = 0;?>
						<?php echo $retorno = (generarLink("agregar_inventario.php", "Agregar Inventario"));if ($retorno != "") {$productos++;}?>
						<?php echo $retorno = (generarLink("ajustes_inventario.php", "Ajuste de Inventario"));if ($retorno != "") {$productos++;} ?>
						<?php echo $retorno = (generarLink("listaProductosEliminados.php", "Productos Deshabilitados")); if ($retorno != "") {$productos++;}?>
					</ul>
				</li>
				<li id="permisosid" class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="fa fa-key"></span> Permisos <b class="caret"></b>
						</a>
					<ul class="dropdown-menu">
						<?php $permisos = 0; ?>
						<?php echo $retorno = (generarLink("permisos.php", " Módulo Permisos")); if ($retorno != "") {$permisos++;}?>
					</ul>
				</li>
				<li id="usuariosid" class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="fa fa-user"></span> Usuarios <b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<?php $usuarios = 0;?>
						<?php echo $retorno = (generarLink("agregar_usuario.php", " Agregar")); if ($retorno != "") {$usuarios++;} ?>
						<?php echo $retorno = (generarLink("listarUsuario.php", "Listar - Modificar y Eliminar")); if ($retorno != "") {$usuarios++;} ?>
					</ul>
				</li>
				<li id="prestamosid" class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="fa fa-shopping-cart"></span> Préstamos <b class="caret"></b>
						</a>
					<ul class="dropdown-menu">
						<?php $prestamos = 0; ?>
						<?php echo $retorno = (generarLink("prestamo.php", " Préstamo")); if ($retorno != "") {$prestamos++;} ?>
						<?php echo $retorno = (generarLink("devolucion.php", " Devolución")); if ($retorno != "") {$prestamos++;} ?>
					</ul>
				</li>
				<li id="reportesid" class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="fa fa-book"></span> Reportes <b class="caret"></b>
						</a>
					<ul class="dropdown-menu">
					<?php $reportes = 0; ?>
					<?php echo $retorno = (generarLink("ReporteProductos.php", "Productos Disponibles")); if ($retorno != "") {$reportes++;} ?>
					<?php echo $retorno = (generarLink("reporte_usuario.php", "Préstamos Generales")); if ($retorno != "") {$reportes++;} ?>
					<?php echo $retorno = (generarLink("tuhistorial.php", "Historial Préstamos")); if ($retorno != "") {$reportes++;} ?>
					<?php echo $retorno = (generarLink("pedido_devuelto.php", "Historial Devoluciones")); if ($retorno != "") {$reportes++;} ?>
					<?php echo $retorno = (generarLink("pedido_actual.php", "Pedido Actual")); if ($retorno != "") {$reportes++;} ?>
					<?php echo $retorno = (generarLink("ajuste_historico.php", "Histórico Ajustes")); if ($retorno != "") {$reportes++;} ?>
					</ul>
				</li>	
			</ul>
	    	<ul class="nav navbar-nav navbar-right">
		        <p class="navbar-text"><?//php echo $_SESSION["usuario"]["correo"]; ?></p>
		        <li><a href="Inventomatic.apk" class="subar"><i class="fa fa-download"></i> Descargar App</a></li>
		        <li><a href="#" id="cerrarSesion"><span class="glyphicon glyphicon-log-in"></span> Cerrar Sesión</a></li>
		    </ul>
	    </div>
	</div>
</nav>
</div>



<div class="container fondo-principio">
<link rel="stylesheet" type="text/css" href="css/stacktable.css">
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript">

    var productos = "<?php echo $productos; ?>";
    var permisos = "<?php echo $permisos; ?>";
    var usuarios = "<?php echo $usuarios; ?>";
    var prestamos = "<?php echo $prestamos; ?>";
    var reportes = "<?php echo $reportes; ?>";
    if (productos == 0) { document.getElementById('productosid').style.display= 'none';}
    if (permisos == 0) { document.getElementById('permisosid').style.display= 'none';}
    if (usuarios == 0) { document.getElementById('usuariosid').style.display= 'none';}
    if (prestamos == 0) { document.getElementById('prestamosid').style.display= 'none';}
    if (reportes == 0) { document.getElementById('reportesid').style.display= 'none';}


</script>
