<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/inf.ico"/><!-- Imagen de la pestaña del navegador --> 
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title></title>

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
                        <h3 class="page-header">Registar Articulos  
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
                            <form action="articulos_control.php" method="post" 
                                  role="form" class="form-horizontal">
                                <input type="hidden" name="accion" value="1">
                                <input type="hidden" name="vcodart" value="0">
                                <input type="hidden" name="pagina" value="articulos_index.php">
<!--                                <div class="form-group">
                                    <label class="col-md-2 control-label">#</label>
                                    <div class="col-md-5">
                                        <input type="text" required="" 
                                               placeholder="Ingrese nro de codigo"  
                                               class="form-control" name="vcodart" autofocus="">
                                    </div>
                                </div>-->
                               <div class="form-group">
                                    <label class="col-md-2 control-label">Marcas:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $marcas = consultas::get_datos("select * from marca "
                                                        . " order by descri_marca");
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
                                                <option value="0">Debe insertar una Marca</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Descripcion articulo:</label>
                                    <div class="col-md-5">
                                        <input type="text" required="" 
                                               placeholder="Ingrese descripcion del articulo"  
                                               class="form-control" name="vartdescri">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Precio:</label>
                                    <div class="col-md-5">
                                        <input type="number" required=""
                                               placeholder="Ingrese precio del articulo"  
                                               class="form-control"
                                               name="vprecio">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Imagen del articulo:</label>
                                    <div class="col-md-5">
                                        <input type="file"  required="" 
                                               placeholder="Ingrese imagen del articulo" 
                                               class="form-control" name="vartimg"
                                               >
                                        <br />
                                        <img id="imgSalida" width="50%" height="50%" src="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Tipo de Articulo:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $tarticulos = consultas::get_datos("select * from tipo_art "
                                                        . " order by cod_tipoart");
                                        ?>                                 
                                        <select name="vtipoart" class="form-control select2">
                                            <?php
                                            if (!empty($tarticulos)) {
                                                foreach ($tarticulos as $tarticulo) {
                                                    ?>
                                                    <option value="<?php echo $tarticulo['cod_tipoart']; ?>">
                                                        <?php echo $tarticulo['descri_tipoart']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un Tipo de Articulo</option>
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
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> Grabar</button>
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

