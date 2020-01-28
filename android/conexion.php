<?php
    //error_reporting(E_ALL & ~E_DEPRECATED);
	//error_reporting(0);
    
	$conexion = new mysqli("localhost", "inforcon", "blackballoon17", "inforcon_inventomatic");

	function getSQLResultSet($commando, $conexion)
    {
 		$mysqli=$conexion;

		if ($mysqli->connect_errno) 
		{
    		printf("Connect failed: %s\n", $mysqli->connect_error);
    		exit();
		}

		if ( $mysqli->multi_query($commando)) 
		{
			return $mysqli->store_result();
		}

		$mysqli->close();
    }
?>