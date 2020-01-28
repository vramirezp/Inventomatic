<?php
    include('include/header.php');
    
    if (!accesoLink("permisos.php")) {
        header('Location: index.php');
    }
    
    ?>
<div class="text-center">
    <h1>Módulo Permisos</h1>
    <hr class="hr-abajo">
</div>
<div class="rows">
    <div class="col-xs-12">
        <div class="row">
           <form class="form-horizontal" action="" method="POST" id="formularioAgregarPermiso" enctype="multipart/form-data">
                <input type="hidden" name="funcion" value="1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ingreso de Permiso</h3>
                    </div>
                    <div class="panel-body padding-30 padding-top-15 padding-bottom-15">
                        <div class="form-group">
                            <div class="col-xs-5">
                                <label class="" for="nombre_permiso">Nombre de Permiso:</label>
                            </div>
                            <div class="col-xs-7">
                                <input type="text" class="form-control" name="nombre_permiso" placeholder="Ej:Ingresar Usuario." required="" autofocus="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5">
                                <label class="" for="descrip_permiso">Descripción de Permiso:</label>
                            </div>
                            <div class="col-xs-7">
                                <input type="text" class="form-control" name="descrip_permiso" placeholder="Ej: Vista de Ingresar Usuario." required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5">
                                <label class="" for="marca">Vista a acceder:</label>
                            </div>
                            <div class="col-xs-7">
                                <select class="form-control" name="link_pagina" required="">
                                    <option value="0" selected="selected">Seleccione una opción...</option>
                                    
                                    <?php
                                        $sqlCompleta = 'SELECT link FROM Link';
                                        $sql = mysqli_query($conexion, $sqlCompleta);

                                        if($sql->num_rows > 0)
                                        {
                                            while($dato = $sql->fetch_assoc()) 
                                            {
                                                echo '<option>'.$dato['link'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4">
                                <button type="reset" class="btn btn-danger btn-block" id="cancelar">Limpiar</button>
                            </div>
                            <div class="col-xs-4">
                            </div>
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block" id="agregar">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Listado de Permiso</h3>
            </div>
            <div class="panel-body padding-30 padding-top-15 padding-bottom-15">
                <div class="">
                    <div class="panel-body padding-0">
                        <table class="table table-bordered fondo-blanco" id="tablasMax">
                            <thead>
                                <tr style="background-color:#337AB7">
                                    <th class="text-center" style="color:#fff">Código</th>
                                    <th class="text-center" style="color:#fff">Nombre</th>
                                    <th class="text-center" style="color:#fff">Descripción</th>
                                    <th class="text-center" style="color:#fff">Sitio</th>
                                    <th class="text-center" style="color:#fff">Acción</th>
                                </tr>
                            </thead>
                            <tbody id="listaPermisos">
                                <!-- LISTADO DE LOS PERMISOS-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .selectable-text {
    -webkit-user-select: text;
    -moz-user-select: text;
    -ms-user-select: text;
    user-select: text;
    }
</style>
<script type="text/javascript" src="js/permisos.js"></script>
<?php
    include('include/footer.php');
    ?>