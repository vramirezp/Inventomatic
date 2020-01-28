<?php
	include 'conexion.php';

    $correo=$_REQUEST["correo"];
    $clave=md5($_REQUEST["clave"]);


    if ($resultset = getSQLResultSet("SELECT correo, clave FROM usuario WHERE correo='$correo' AND clave='$clave' AND estado=1", $conexion)) 
    {
    	if($resultset->fetch_array(MYSQLI_NUM) == "") 
    	{
    		echo 0;
    	}
        else
        {
            echo 1;
        }
    }
?>