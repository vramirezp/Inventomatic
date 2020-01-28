<?php 
    include('include/config.php');
    include('include/scripts.php');

    /*if (!accesoLink("ModificarPermiso.php")) {
        header('Location: index.php');
    }*/
?>
<?php
// Si pasa una ID POR GET entonces mostrar
$mostrar = [];
$id = @$_GET['id'];
if(count($_GET) > 0)
{
    
    if($id > 0 && is_numeric($id))
    {
        $sqlCompleta = 
            "SELECT
              num_permiso,nombre_modulo,descripcion,link
            FROM 
                permiso
            WHERE
                num_permiso= '".$id."'";

        $sql = mysqli_query($conexion, $sqlCompleta);

        if($sql->num_rows > 0)
        {
            $dato = $sql->fetch_assoc();

            $mostrar['num_permiso']      = $dato['num_permiso'];
            $mostrar['nombre_modulo']       = $dato['nombre_modulo'];
            $mostrar['descripcion']      = $dato['descripcion'];
            $mostrar['link']      = $dato['link'];
        }
    }
}
?>
<style>
    body
    {
        background: none !important;
    }
</style>
<script type="text/javascript" src="js/permisos.js"></script>
   <div class="row"> 
                <form class="form-horizontal" action="" method="POST" id="formularioModificarPermiso" enctype="multipart/form-data">
                    <input type="hidden" name="funcion" value="4">
                    <input type="hidden" name="id" value="<?php echo $mostrar['num_permiso'];?>">
                    <div class="panel panel-default">
                          <div class="panel-heading">
                            <h3 class="panel-title">Ingreso de Permiso</h3>
                         </div>
                          <div class="panel-body padding-30 padding-top-15 padding-bottom-15">
                            <div class="form-group">
                                <div class="col-xs-5">
                                    <label class="" for="nombre">Nombre de Permiso:</label>
                                </div>
                                <div class="col-xs-7">
                                    <input type="text" value="<?php echo $mostrar['nombre_modulo']; ?>" class="form-control" name="nombre_permiso" placeholder="Ej:Ingresar Usuario." required="" autofocus="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-5">
                                    <label class="" for="marca">Descripción de Permiso:</label>
                                </div>
                                <div class="col-xs-7">
                                    <input type="text" class="form-control" name="descrip_permiso" placeholder="Ej: Vista de Ingresar Usuario." required="" 
                                    value="<?php echo $mostrar['descripcion']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-5">
                                    <label class="" for="marca">Vista a Acceder:</label>
                                </div>
                                <div class="col-xs-7">
                                <select class="form-control" name="link_pagina" required="">
                                    <?php
                                        $sqlCompleta = 'SELECT link FROM Link';
                                        $sql = mysqli_query($conexion, $sqlCompleta);

                                        if($sql->num_rows > 0)
                                        {
                                            while($dato = $sql->fetch_assoc()) 
                                            {
                                                if('http://inventomatic.inforconce.com/'.$mostrar['link'] == $dato['link'])
                                                {
                                                    echo '<option selected="selected">'.$dato['link'].'</option>';
                                                }
                                                else
                                                {
                                                    echo '<option>'.$dato['link'].'</option>';
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-4">
                                    <button type="reset" class="btn btn-danger btn-block" id="cancelar">Cancelar</button>
                                </div>        
                                <div class="col-xs-4">
                                    
                                </div>    
                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-primary btn-block" id="Modificar">Guardar Cambios</button>
                                </div>                        
                            </div>
                        </div>
                    </div>
                </form>
            </div>
