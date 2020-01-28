<?php
	require('include/config.php');

	$nombreArchivo = "productos_ajustados".time().'.xls';
	header("content-type:application/xls;charset=UTF-8");    
    header("Content-Disposition: attachment; filename=".$nombreArchivo.".xls");  
    header("Pragma: no-cache"); 
    header("Expires: 0");

	$sqlCompleta = 
		"SELECT
			CONCAT('N:',' ',id_tipo_producto) as id,
			nombre,
			fecha,
			precio,
			stock_ant,
			stock_nuv,
			(stock_nuv - stock_ant) as diferencia,
			((stock_nuv - stock_ant)*-1) * precio as perdida
		FROM 
			ajuste_inventario
		ORDER BY 
			fecha ASC";

?>
		<div>
			<h3 style="text-align: center;">Informes de productos [Ajustados] <?php echo date('Y-m-d'); ?></h3>
			<table style="border: 1px solid black">
				<thead>
					<tr style="background-color:#337AB7; border: 1px solid black;">
						<th class="text-center" style="color:#fff">Codigo Producto</th>
						<th class="text-center" style="color:#fff">Nombre</th>
						<th class="text-center" style="color:#fff">Fecha</th>
						<th class="text-center" style="color:#fff">Precio</th>
						<th class="text-center" style="color:#fff">Deficit</th>
						<th class="text-center" style="color:#fff">Total perdida</th>
					</tr>
				</thead>
				<tbody id="listaPerdidas" style="text-align: center;">
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
						<td><?php echo $dato['fecha']  ?></td>
						<td><?php echo $dato['precio'] ?></td>
						<?php if ($dato['diferencia'] < 0): ?>
							<td style="color:red"><?php echo $dato['diferencia'] ?></td>
							<td style="color:red"><?php echo $dato['perdida']    ?></td>
						<?php elseif($dato['diferencia'] >= 0):?>
							<td style="color:black"><?php echo $dato['diferencia']   ?></td>
							<td style="color:black"><?php echo ($dato['perdida'] * (-1)) ?></td>
						<?php endif; ?>
							
					</tr>
<?php  
				}
			}
			else;
?>						
				</tbody>
			</table>				
		</div>	