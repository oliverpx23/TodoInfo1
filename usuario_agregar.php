<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/blackbulls.ico"/><!-- Imagen de la pestaña del navegador --> 
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SYS - VENTA</title>

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
                        <h3 class="page-header">Registar Usuario  
                            <a href="usuario_index.php" 
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
                            <form action="usuario_control.php" method="post" 
                                  role="form" class="form-horizontal">
                                <input type="hidden" name="accion" value="1">
                                <input type="hidden" name="vcod" value="0">
                                <input type="hidden" name="pagina" value="usuario_index.php">
                                <input type="hidden" name="vestado" value="ACTIVO">
                                <div class="form-group">
                                      <label class="col-md-2 control-label">Nick</label>
                                    <div class="col-md-5">
                                        <input type="text" required="" 
                                               placeholder="Ingrese su Nick"  
                                               class="form-control" name="vnick" pattern="[A-Za-z]{5,40}" title="Ingresa sólo letras. Tamaño mínimo: 5. Tamaño máximo: 40" autofocus="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Clave</label>
                                    <div class="col-md-5">
                                        <input type="password" required="" placeholder="Ingrese su Clave"  
                                               class="form-control" name="vclave">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Grupo</label>
                                    <div class="col-md-3">
                                        <?php
                                        $grupos = consultas::get_datos("select * from grupos "
                                                        . " order by gru_nombre");
                                        ?>                                 
                                        <select name="vgrup" class="form-control select2">
                                            <?php
                                            if (!empty($grupos)) {
                                                foreach ($grupos as $grupo) {
                                                    ?>
                                                    <option value="<?php echo $grupo['gru_cod']; ?>">
                                                        <?php echo $grupo['gru_nombre']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un Grupo</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Nombre</label>
                                    <div class="col-md-5">
                                        <input type="text" required=""
                                               placeholder="Ingrese su nombre"  
                                               class="form-control"
                                               name="vnombre">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Sucursal</label>
                                    <div class="col-md-3">
                                        <?php
                                        $sucursales = consultas::get_datos("select * from sucursal "
                                                        . " order by cod_suc");
                                        ?>                                 
                                        <select name="vcodsuc" class="form-control select2">
                                            <?php
                                            if (!empty($sucursales)) {
                                                foreach ($sucursales as $sucursal) {
                                                    ?>
                                                    <option value="<?php echo $sucursal['cod_suc']; ?>">
                                                        <?php echo $sucursal['suc_descri']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar una Sucursal</option>
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

                            
                            
                                
                       
                                
