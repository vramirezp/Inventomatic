<?php 
	include('include/header.php');

    if (!accesoLink("pedido_devuelto.php")) {
        header('Location: /inventomatic');
    }
?>

 <div class="text-center">
        <h1>Tu historial de devoluciones</h1>
        <hr class="hr-abajo">        
    </div>

    <div class="text-center">       

 <table class="table table-bordered fondo-blanco tabla3" id="tablasMax">
<thead>
    <tr style="background-color:#337AB7">
        <th class="text-center" style="color:#fff">Código</th>
        <th class="text-center" style="color:#fff">Código Producto</th>
        <th class="text-center" style="color:#fff">Nombre Producto</th>
        <th class="text-center" style="color:#fff">Cantidad</th>
        <th class="text-center" style="color:#fff">Fecha</th>   
    </tr>
</thead>
<tbody id="ListarReporteUsuarios">
    <!-- LISTADO DE LOS USUARIOS PRESTAMO GG-->
</tbody>
</table>

<div class="col-xs-2">
<a href="#" class="btn btn-default" onclick="genPDF('Reporte Tu pedido devuelto')"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar</a></div>
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
<script type="text/javascript" src="js/pedido_devuelto.js"></script>
<script type="text/javascript" src="js/pdf.js"></script>    
<?php
    include('include/footer.php');
?>