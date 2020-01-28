<?php
//require_once('include/config.php');

function Validar_codigo($codigo, $conexion = null)
{

$sqlCompleta = 
        "SELECT
            codigo_producto
        FROM 
            producto

        WHERE estado = 1 AND codigo_producto = '".$codigo."'";

    $sql = mysqli_query($conexion, $sqlCompleta);
    
    if($sql->num_rows > 0) return true;
    else return false;
}

function buscar_productos($codigo, $conexion = null)
{

$sqlCompleta = 
        "SELECT
            codigo_producto
        FROM 
            producto

        WHERE codigo_producto = '".$codigo."'";

    $sql = mysqli_query($conexion, $sqlCompleta);
    
    if($sql->num_rows > 0) return true;
    else return false;
}

function buscar_producto_delete($codigo, $conexion = null)
{
	$sqlCompleta = 
        "SELECT
            codigo_producto
        FROM 
            producto

        WHERE estado = 0 AND codigo_producto = '".$codigo."'";

    $sql = mysqli_query($conexion, $sqlCompleta);
    
    if($sql->num_rows > 0) return true;
    else return false;
}

function accesoLink($link)
{
    foreach ($_SESSION["permisos"] as &$valor) {
        if ($valor["link"] == $link) {
            return true;
        }
    }
    return false;
}

function generarLink($link, $nombre)
{
    foreach ($_SESSION["permisos"] as &$valor) {
        if ($valor["link"] == $link) {
            return "<li><a href='".$link."'>".$nombre."</a></li>";
        }
    }
    return "";
}



?>