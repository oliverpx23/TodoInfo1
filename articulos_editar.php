<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/inf.ico"/><!-- Imagen de la pestaña del navegador --> 
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> - Editar Articulos</title>

        <?php
        require './ver_sesion.php';
        require 'menu/css.ctp';
        ?>

    </head>
    <body>
        <div id="wrapper">
            <?php require 'menu/navbar.php'; ?><!--BARRA DE HERRAMIENTAS-->
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Editar Articulo 
                            <a href="articulos_index.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel='tooltip' title="Atras">
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a> 
                        </h3>
                    </div>                       
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">                                         
                        <div class="panel-body">
                            <?php $articulos = consultas::get_datos("select * from articulo where id_articulo=" . $_REQUEST['vcodart']) ?>                        
                            <form action="articulos_control.php" method="post" role="form" class="form-horizontal">
                                <input type="hidden" name="accion" value="2">
                                <input type="hidden" name="vcodart" value="<?php echo $articulos[0]['id_articulo']; ?>">
                                <input type="hidden" name="pagina" value="articulos_index.php">

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Marca:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $marcas = consultas::get_datos("select * from marca order by cod_marca=" . $articulos[0]['cod_marca'] . "desc");
                                        ?>                                 
                                        <select name="vcodmar" class="form-control select2">
                                            <?php
                                            if (!empty($marcas)) {
                                                foreach ($marcas as $marca) {
                                                    ?>
                                                    <option value="<?php echo $marca['cod_marca']; ?>">
                                                        <?php echo $marca['descri_marca']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar una Marca:</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Precio:</label>
                                    <div class="col-md-5">
                                        <input type="number" required="" placeholder="Ingrese precio"  
                                               class="form-control" name="vprecio" 
                                               value="<?php echo $articulos[0]['precio_art']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Descripcion:</label>
                                    <div class="col-md-5">
                                        <input type="text" required="" placeholder="Ingrese Descripcion"  
                                               class="form-control" name="vartdescri" 
                                               value="<?php echo $articulos[0]['descri_art']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Imagen:</label>
                                    <div class="col-md-5">
                                        <input type="file" required="" placeholder="Ingrese imagen"  
                                               class="form-control" name="vartimg" 
                                               value="<?php echo $articulos[0]['imagen_art']; ?>"
                                                <br />
                                        <img id="imgSalida" width="50%" height="50%" src=""
                                    </div>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Tipo de articulo:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $tipoarticulos = consultas::get_datos("select * from tipo_art "
                                                        . " order by cod_tipoart=".$articulos[0]['cod_tipoart']."desc");
                                        ?>                                 
                                        <select name="vtipoart" class="form-control select2">
                                            <?php
                                            if (!empty($tipoarticulos)) {
                                                foreach ($tipoarticulos as $tipoarticulo) {
                                                    ?>
                                                    <option value="<?php echo $tipoarticulo['cod_tipoart']; ?>">
                                                        <?php echo $tipoarticulo['descri_tipoart']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un tipo de articulo</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                        
                        <div class="form-group">
                                    <label class="col-md-2 control-label">Costo:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $costos = consultas::get_datos("select * from costo_produccion "
                                                        . " order by cod_costoprod");
                                        ?>                                 
                                        <select name="vcosto" class="form-control select2">
                                            <?php
                                            if (!empty($costos)) {
                                                foreach ($costos as $costo) {
                                                    ?>
                                                    <option value="<?php echo $costo['cod_costoprod']; ?>">
                                                        <?php echo $costo['costo_total']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar el costo del articulo</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                               

                                <br>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-refresh-o"></i> Actualizar</button>
                                    </div>
                                </div>
                            </form>     
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>

        </div> 
        <!--fin-->
        <!--archivos js-->   
        <?php require 'menu/js.ctp'; ?>

    </body>
</html>

