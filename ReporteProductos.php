<?php 
	include('include/header.php');

    if (!accesoLink("ReporteProductos.php")) {
        header('Location: index.php');
    }
?>

 <div class="text-center">
        <h1>Productos Disponibles</h1>
        <hr class="hr-abajo">        
    </div>
    <div class="text-center">

 <table class="table table-bordered fondo-blanco" id="tablasMax">
<thead>
    <tr style="background-color:#337AB7">
                                <th class="text-center" style="color:#fff">Codigo Producto</th>
                                <th class="text-center" style="color:#fff">Nombre</th>
                                <th class="text-center" style="color:#fff">Marca</th>
                                <th class="text-center" style="color:#fff">Capacidad</th>
                                <th class="text-center" style="color:#fff">Fecha Ingreso</th>
                                <th class="text-center" style="color:#fff">Stock</th> 
    
    </tr>
</thead>
<tbody id="ListarReporteUsuarios">
    <!-- LISTADO DE LOS USUARIOS PRESTAMO GG-->
</tbody>
</table>

<div class="clearfix"></div>
<div class="col-xs-2">
<a href="#" class="btn btn-default" onclick="genPDF('Productos Disponibles')"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar</a>
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
<script type="text/javascript" src="js/ReporteProductos.js"></script>

<script type="text/javascript" src="js/pdf.js"></script>
<?php
    include('include/footer.php');
?>