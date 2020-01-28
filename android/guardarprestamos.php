<?php
	include 'conexion.php';

    $usuario=$_REQUEST["usuario"];
    $codigo=$_REQUEST["codigo"];
    $can=$_REQUEST["cantidad"];

    $hoy = getdate();
    $fecha = $hoy[year].'-'.$hoy[mon].'-'.$hoy[mday];

    if ($resultset = getSQLResultSet("SELECT cantidad FROM usuario_has_producto WHERE usuario_num_usuario='$usuario' AND producto_codigo_producto = '$codigo'", $conexion)) 
    {
        while($row = $resultset->fetch_array(MYSQLI_NUM))
        {
            $canti = $row[0];
            $canti = $canti+$can;
        }

        if($canti != "") 
        { 
            $sql="UPDATE usuario_has_producto SET cantidad = ".$canti.", fecha_prestamo = '$fecha', estado = 0 WHERE usuario_num_usuario='$usuario' AND producto_codigo_producto = '$codigo'";

            if (mysqli_query($conexion,$sql)>0)
            {
                $sql2="UPDATE producto SET stock = (stock - ".$can.") WHERE codigo_producto = '$codigo'";

                if (mysqli_query($conexion,$sql2)>0)
                {
                	if ($resultset2 = getSQLResultSet("SELECT u.num_usuario, u.correo, p.codigo_producto, p.nombre , up.cantidad, up.fecha_prestamo, p.marca FROM usuario_has_producto up, producto p, usuario u WHERE up.producto_codigo_producto = p.codigo_producto AND up.usuario_num_usuario = u.num_usuario AND up.usuario_num_usuario='$usuario' AND up.producto_codigo_producto = '$codigo'", $conexion)) 
                	{
                		while($row = $resultset2->fetch_array(MYSQLI_NUM))
				        {
				            $h_num_usuario = $row[0];
				            $h_correo = $row[1];
				            $h_codigo_producto = $row[2];
				            $h_nombre = $row[3] . " " . $row[6];
				            $h_cantidad = $row[4];
				            $h_fecha_prestamo = $row[5];
				        }

				        $sql5="INSERT INTO historico_prestamo (h_num_usuario,h_correo,h_codigo_producto,h_nombre,h_cantidad,h_fecha_prestamo) VALUES ($h_num_usuario, '$h_correo','$h_codigo_producto','$h_nombre',$can,'$fecha')";

				        if (mysqli_query($conexion,$sql5)>0)
				        {
				            echo "ok";
				        }
				        else
	    	            {
			                echo "error6";
			            }
		            }
		            else
		            {
		                echo "error9";
		            }
                }
                else
                {
                    echo "error5";
                }
            }
            else
            {
                echo "error1";
            }
        }
        else
        {
            $sql="INSERT INTO usuario_has_producto(usuario_num_usuario,producto_codigo_producto,cantidad,fecha_prestamo,estado) VALUES ('$usuario','$codigo',$can,'$fecha',0)";
      
            if (mysqli_query($conexion,$sql)>0)
            {
                $sql2="UPDATE producto SET stock = (stock - ".$can.") WHERE codigo_producto = '$codigo'";

                if (mysqli_query($conexion,$sql2)>0)
                {
                    if ($resultset2 = getSQLResultSet("SELECT u.num_usuario, u.correo, p.codigo_producto, p.nombre , up.cantidad, up.fecha_prestamo, p.marca FROM usuario_has_producto up, producto p, usuario u WHERE up.producto_codigo_producto = p.codigo_producto AND up.usuario_num_usuario = u.num_usuario AND up.usuario_num_usuario='$usuario' AND up.producto_codigo_producto = '$codigo'", $conexion)) 
                    {
                        while($row = $resultset2->fetch_array(MYSQLI_NUM))
                        {
                            $h_num_usuario = $row[0];
                            $h_correo = $row[1];
                            $h_codigo_producto = $row[2];
                            $h_nombre = $row[3] . " " . $row[6];
                            $h_cantidad = $row[4];
                            $h_fecha_prestamo = $row[5];
                        }

                        $sql5="INSERT INTO historico_prestamo (h_num_usuario,h_correo,h_codigo_producto,h_nombre,h_cantidad,h_fecha_prestamo) VALUES ($h_num_usuario, '$h_correo','$h_codigo_producto','$h_nombre',$can,'$fecha')";

                        if (mysqli_query($conexion,$sql5)>0)
                        {
                            echo "ok";
                        }
                        else
                        {
                            echo "error6";
                        }
                    }
                    else
                    {
                        echo "error9";
                    }
                }
                else
                {
                    echo "error2";
                }
            }
            else
            {
                echo "error3";
            }
        }
    }
    else
    {
        echo "error4";
    }
?>