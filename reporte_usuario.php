<?php 
	include('include/header.php');

    if (!accesoLink("reporte_usuario.php")) {
        header('Location: index.php');
    }
?>

 <div class="text-center">
        <h1>Préstamos históricos de usuarios</h1>
        <hr class="hr-abajo">        
    </div>

    <div class="text-center">

 <table class="table table-bordered fondo-blanco tabla1" id="tablasMax" >
<thead>
    <tr style="background-color:#337AB7">
        <th class="text-center" style="color:#fff">Código Usuario</th>
        <th class="text-center" style="color:#fff">Correo</th>
        <th class="text-center" style="color:#fff">Códdigo Producto</th>
        <th class="text-center" style="color:#fff">Nombre Producto</th>
        <th class="text-center" style="color:#fff">Cantidad Total</th>  
    </tr>
</thead>
<tbody id="ListarReporteUsuarios">

    <!-- LISTADO DE LOS USUARIOS PRESTAMO GG-->
</tbody>

</table>

<div class="clearfix"></div>
<div class="col-xs-2">
<a href="#" class="btn btn-default" onclick="genPDF('Reporte Historico de Usuario')"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar</a>
</div>

<div class="clearfix"></div>
<style type="text/css">
    .selectable-text {
    -webkit-user-select: text;
    -moz-user-select: text;
    -ms-user-select: text;
    user-select: text;
}
</style>
<script type="text/javascript" src="js/reporte_usuario.js"></script>
<script type="text/javascript" src="js/pdf.js"></script>
<?php
    include('include/footer.php');
?>