<?php
	include 'conexion.php';

    $usuario=$_REQUEST["usuario"];
    $codigo=$_REQUEST["codigo"];
    $can=$_REQUEST["cantidad"];

    if ($resultset = getSQLResultSet("SELECT cantidad FROM usuario_has_producto WHERE usuario_num_usuario='$usuario' AND producto_codigo_producto = '$codigo'", $conexion)) 
    {
        while($row = $resultset->fetch_array(MYSQLI_NUM))
        {
            $canti = $row[0];
            $canti = $canti-$can;
        }

        if($canti == 0) 
        { 
            $sql="UPDATE usuario_has_producto SET cantidad = ".$canti.", estado = 1 WHERE usuario_num_usuario='$usuario' AND producto_codigo_producto = '$codigo'";

            if (mysqli_query($conexion,$sql)>0)
            {
                $sql2="UPDATE producto SET stock = (stock + ".$can.") WHERE codigo_producto = '$codigo'";

                if (mysqli_query($conexion,$sql2)>0)
                {
                	if ($resultset2 = getSQLResultSet("SELECT correo FROM usuario WHERE num_usuario='$usuario'", $conexion)) 
                    {
                        while($row = $resultset2->fetch_array(MYSQLI_NUM))
                        {
                            $h_correo = $row[0];
                        }
                    }
                    else
                    {
                        echo "error 10";
                    }

                    if ($resultset3 = getSQLResultSet("SELECT nombre, marca FROM producto WHERE codigo_producto = '$codigo'", $conexion))
                    {
                        while($row = $resultset3->fetch_array(MYSQLI_NUM))
                        {
                            $h_nombre = $row[0] . " " . $row[1];
                        }

                        $hoy = getdate();
                        $fecha = $hoy[year].'-'.$hoy[mon].'-'.$hoy[mday];

                        $sql5="INSERT INTO historico_devolucion (hd_num_usuario,hd_correo,hd_codigo_producto,hd_nombre,hd_cantidad,hd_fecha_devolucion) VALUES ($usuario, '$h_correo','$codigo','$h_nombre',$can,'$fecha')";

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
            $sql="UPDATE usuario_has_producto SET cantidad = ".$canti." WHERE usuario_num_usuario='$usuario' AND producto_codigo_producto = '$codigo'";

            if (mysqli_query($conexion,$sql)>0)
            {
                $sql2="UPDATE producto SET stock = (stock + ".$can.") WHERE codigo_producto = '$codigo'";

                if (mysqli_query($conexion,$sql2)>0)
                {
                    if ($resultset2 = getSQLResultSet("SELECT correo FROM usuario WHERE num_usuario='$usuario'", $conexion)) 
                    {
                        while($row = $resultset2->fetch_array(MYSQLI_NUM))
                        {
                            $h_correo = $row[0];
                        }
                    }
                    else
                    {
                        echo "error 10";
                    }

                    if ($resultset3 = getSQLResultSet("SELECT nombre, marca FROM producto WHERE codigo_producto = '$codigo'", $conexion))
                    {
                        while($row = $resultset3->fetch_array(MYSQLI_NUM))
                        {
                            $h_nombre = $row[0] . " " . $row[1];
                        }

                        $hoy = getdate();
                        $fecha = $hoy[year].'-'.$hoy[mon].'-'.$hoy[mday];

                        $sql5="INSERT INTO historico_devolucion (hd_num_usuario,hd_correo,hd_codigo_producto,hd_nombre,hd_cantidad,hd_fecha_devolucion) VALUES ($usuario, '$h_correo','$codigo','$h_nombre',$can,'$fecha')";

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
    }
    else
    {
        echo "error4";
    }
?>