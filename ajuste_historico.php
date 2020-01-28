<?php 
	include('include/header.php');

    if (!accesoLink("ajuste_historico.php")) {
        header('Location: /inventomatic');
    }
?>



 <div class="text-center">
        <h1>Ajuste histórico</h1>
        <hr class="hr-abajo">        
    </div>

<div class="text-center">

 <table class="table table-bordered fondo-blanco tabla5" id="tablasMax">
<thead>
    <tr style="background-color:#337AB7">
        <th class="text-center" style="color:#fff">Código Ajuste</th>
        <th class="text-center" style="color:#fff">Fecha Ajuste</th>
        <th class="text-center" style="color:#fff">Stock Fisico</th>
        <th class="text-center" style="color:#fff">Stock Virtual</th>
        <th class="text-center" style="color:#fff">Merma</th>
        <th class="text-center" style="color:#fff">Producto</th>
        <th class="text-center" style="color:#fff">Usuario</th>
        <th class="text-center" style="color:#fff">Motivo</th>
    
    </tr>
</thead>
<tbody id="ListarReporteUsuarios">
    <!-- LISTADO DE LOS USUARIOS PRESTAMO GG-->
</tbody>
</table>

<div class="col-xs-2">
<a href="#" class="btn btn-default" onclick="genPDF('Ajuste Historico')"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar</a></div>
</div>
<style type="text/css">
    .selectable-text {
    -webkit-user-select: text;
    -moz-user-select: text;
    -ms-user-select: text;
    user-select: text;
}
</style>
<script type="text/javascript" src="js/ajuste_inventario.js"></script>
<script type="text/javascript" src="js/pdf.js"></script>    
<?php
    include('include/footer.php');
?>