<?php
	require('include/config.php');

	$nombreArchivo = "ajuste_inventario_".time().'.xls';
	header("Content-Transfer-Encoding: binary");
	header("Content-type:application/vnd.ms-excel; charset=UTF-8");    
    header("Content-Disposition: attachment; filename=".$nombreArchivo);
    header("Cache-Control: private");  
    header("Pragma: no-cache"); 
    header("Expires: 0");

	$sqlCompleta = 
		"SELECT CONCAT('N:',' ',id_tipo_producto) as id,
				CONCAT(nombre,' ',marca,' ',capacidad) as nombre,
				stock
		FROM producto ORDER BY fecha_ingreso ASC";

	if (!accesoLink("ajustes_inventario_pdf.php")) {
		header('Location: index.php');
	}

?>
		<div>
			<h3 style="text-align: center;">Ajuste de inventario <?php echo date('Y-m-d'); ?></h3>
			<table style="border: 1px solid" id="tablasMax">
				<thead>
					<tr style="background-color:#337AB7; border: 1px solid black;">
						<th class="text-center" style="color:#fff">Codigo Producto</th>
						<th class="text-center" style="color:#fff">Nombre</th>
						<th class="text-center" style="color:#fff">Stock</th>
						<th class="text-center" style="color:#fff">Stock Real</th>
					</tr>
				</thead>
				<tbody id="listaProductos" style="text-align: center;">
<?php  
		$sql = mysqli_query($conexion, $sqlCompleta);

			if($sql->num_rows > 0)
			{
				
				while($dato = $sql->fetch_assoc()) 
				{
?>
					<tr style="border: 1px solid black">
						<td><?php echo (string)$dato['id']?></td>
						<td><?php echo $dato['nombre'] ?></td>
						<td><?php echo $dato['stock']  ?></td>
						<td><input type="number" class="form-control"></td>
					</tr>
<?php  
				}
			}
			else;
?>						
				</tbody>
			</table>
		</div>					