<?php
    include 'conexion.php';

    $user = $_REQUEST['user'];

    if($resultset = getSQLResultSet("SELECT p.codigo_producto, p.nombre, p.marca, up.cantidad FROM producto p, usuario_has_producto up WHERE p.codigo_producto = up.producto_codigo_producto AND up.usuario_num_usuario = $user AND up.estado = 0", $conexion))
    {
    	while ($row = $resultset->fetch_array(MYSQLI_NUM)) 
    	{
    		echo json_encode($row);
    	}
    }
?>