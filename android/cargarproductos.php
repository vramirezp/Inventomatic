<?php
    include 'conexion.php';

    $user = $_REQUEST['user'];

    if($resultset = getSQLResultSet("SELECT codigo_producto, nombre, marca, stock FROM producto WHERE estado = 1", $conexion))
    {
    	while ($row = $resultset->fetch_array(MYSQLI_NUM)) 
    	{
    		echo json_encode($row);
    	}
    }
?>