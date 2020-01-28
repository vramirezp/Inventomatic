<?php
    include 'conexion.php';

    $codigoproducto = $_REQUEST['codigo'];

    if($resultset = getSQLResultSet("SELECT codigo_producto, nombre, marca, stock FROM producto WHERE codigo_producto = '".$codigoproducto."' AND estado = 1", $conexion))
    {
    	while ($row = $resultset->fetch_array(MYSQLI_NUM)) 
    	{
    		echo json_encode($row);
    	}
    }
?>