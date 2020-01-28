<?php
	include 'conexion.php';

    $correo=$_REQUEST["correo"];
    $clave=md5($_REQUEST["clave"]);


    if ($resultset = getSQLResultSet("SELECT num_usuario FROM usuario WHERE correo='$correo' AND clave='$clave'", $conexion)) 
    {
    	while ($row = $resultset->fetch_array(MYSQLI_NUM)) 
        {
            echo json_encode($row);
        }
    }
?>