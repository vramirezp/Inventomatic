<?php
	error_reporting(E_ALL & ~E_DEPRECATED);
	//error_reporting(0);
	ob_start();
	session_start();
	header('Content-Type: text/html; charset=utf-8');

	$conexion = mysqli_connect('localhost', 'root', '', 'inforcon_inventomatic');

	if (!$conexion) {
	    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
	    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
	    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}

	define('TITULO', 'Inventomatic');
	
	date_default_timezone_set('America/Santiago');
	require_once("funciones.php");
?> 
