<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/blackbulls.ico"/>
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
                        <h3 class="page-header">Registar Recepcion 
                            <a href="recepcion_index.php" 
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
                            
                        <?php $fecha=consultas::get_datos("select * from v_fecha1"); ?>
                        <form action="recepcion_control.php" method="post" 
                                  role="form" class="form-horizontal">
                                <input type="hidden" name="accion" value="1">
                                <input type="hidden" name="vcod" value="0">
                                <input type="hidden" name="vestado" value="ACTIVO">
                                <input type="hidden" name="pagina" value="recepcion_index.php">
                                
                           
                                    <div class="form-group">
                                    <label class="col-md-2 control-label">CLIENTE:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $clientes = consultas::get_datos("select * from clientes "
                                                        . " order by id_cliente");
                                        ?>                                 
                                        <select name="vcli" class="form-control select2">
                                            <?php
                                            if (!empty($clientes)) {
                                                foreach ($clientes as $cliente) {
                                                    ?>
                                                    <option value="<?php echo $cliente['id_cliente']; ?>">
                                                        <?php echo $cliente['cli_nombre']." - ".$cliente['cli_apellido']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un Cliente</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                     
                                    <label class="col-md-2 control-label">USUARIO:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $usuarios = consultas::get_datos("select * from usuarios "
                                                        . " order by usu_cod");
                                        ?>                                 
                                        <select name="vusu" class="form-control select2">
                                            <?php
                                            if (!empty($usuarios)) {
                                                foreach ($usuarios as $usuario) {
                                                    ?>
                                                    <option value="<?php echo $usuario['usu_cod']; ?>">
                                                        <?php echo $usuario['usu_nombre']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un usuario</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                
                                </div>
                                    
                                <div class="form-group">
                                    <label class="col-md-2 control-label">SUCURSAL:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $sucursals = consultas::get_datos("select * from sucursal "
                                                        . " order by cod_suc");
                                        ?>                                 
                                        <select name="vsuc" class="form-control select2">
                                            <?php
                                            if (!empty($sucursals)) {
                                                foreach ($sucursals as $sucursal) {
                                                    ?>
                                                    <option value="<?php echo $sucursal['cod_suc']; ?>">
                                                        <?php echo $sucursal['suc_descri']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar sucursal</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label class="col-md-2 control-label">FECHA:</label>
                                    <div class="col-md-2">
                                        <input type="date" required="" placeholder="Ingrese fecha" readonly=""
                                               class="form-control" name="vfecha" value="<?php echo $fecha[0]['fecdate1'] ?>">
                                    </div>
                                    
                                        
                                </div>
                                
                                                                     
                              <div class="form-group">
                                    <label class="col-md-2 control-label">DESCRIPCION:</label>
                                    <div class="col-xs-10 col-md-8">
                                        <textarea type="text" required="" 
                                               placeholder="Ingrese una descripcion" 
                                               class="form-control" name="vdescri" rows="3"></textarea>
                                    </div>
                                    </div>  
                              
                              <br>
                              <br>
                                <div class="form-group">
                                    <div class="col-md-offset-5 col-md-10">
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
