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
                    <!--impresion del titulo de la pagina-->
                    <div class="col-lg-12">
                        <h3 class="page-header">Listado de Recepcion
                            <a href="recepcion_index.php" 
                             class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Atras" >
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a>                    
                        </h3>
                    </div>     
                    <!--Buscador-->
                    <div class="col-lg-12">
                        <div class="panel-body">
                            
                            <?php $recepcion= consultas::get_datos
                                    ("select * from v_recepcion where id_recep=".$_REQUEST['vcod']) ?>
                            <form action="recepcion_control.php" method="post" role="form"class="form-horizontal">
                                <input type="hidden" name="accion" value="2">
                               
                                <input type="hidden" name="vcod"
                                       value="<?php echo $recepcion[0]['id_recep']; ?>">
                                <input type="hidden" name="pagina" value="recepcion_index.php">
                                
                                   <div class="form-group">
                                    <label class="col-md-2 control-label">CLIENTE:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $clientess = consultas::get_datos("select * from v_clientes "
                                                        . " order by id_cliente");
                                        ?>                                 
                                        <select name="vcli" class="form-control select2">
                                            <?php
                                            if (!empty($clientess)) {
                                                foreach ($clientess as $clientes) {
                                                    ?>
                                                    <option value="<?php echo $clientes['id_cliente']; ?>">
                                                        <?php echo $clientes['cliente']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un Cliente</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="col-md-2 control-label">USUARIO:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $usuarioss = consultas::get_datos("select * from v_usuarios "
                                                        . " order by usu_cod");
                                        ?>                                 
                                        <select name="vusu" class="form-control select2">
                                            <?php
                                            if (!empty($usuarioss)) {
                                                foreach ($usuarioss as $usuarios) {
                                                    ?>
                                                    <option value="<?php echo $usuarios['usu_cod']; ?>">
                                                        <?php echo $usuarios['usu_nombre']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un usuario</option>
                                            <?php } ?>
                                        </select>
                                    </div>
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
                                                <option value="0">Debe insertar una sucursal</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="col-md-2 control-label">FECHA:</label>
                                    <div class="col-md-3">
                                        <input type="date" required="" placeholder="Ingrese la Fecha" readonly=""  
                                           class="form-control" name="vfecha"
                                   value="<?php echo $recepcion[0]['recep_fecha'];?>">
                                    </div>
                               </div>
                                   
                                </div>
                              
                                 
                        
                                <div class="form-group">
                                    <label class="col-md-2 control-label">DESCRIPCION</label>
                                    <div class="col-md-8">
                                   <input type="text" required="" placeholder="Ingrese la Descripcion"  
                                           class="form-control" name="vdescri"
                                   value="<?php echo $recepcion[0]['recep_descri'];?>">
                                    </div>
                                </div>
                                
                                <br>
                                <br>
                                  <div class="form-group">
                                    <label class="col-md-5 control-label">ESTADO:</label>
                                  <div class="row">
                                    <div class="radio col-md-6">
                                        <?php if ($recepcion[0]['recep_estado'] == 'ACTIVO'){?>
                                        <label>
                                            <input type="radio" name="vestado" value="ACTIVO" checked=""> ACTIVO
                                        </label>
                                        
                                        <label>
                                            <input type="radio" name="vestado" value="ANULADO"> ANULADO
                                        </label> 
                                         <?php }else{ ?>
                                        <label>
                                            <input type="radio" name="vestado" value="ACTIVO" >ACTIVO
                                        <label>
                                            <input type="radio" name="vestado" value="ANULADO" checked=""> ANULADO
                                        </label> 
                                         <?php }?>
                                    </div>
                                  </div>                                  
                                </div>
                                        
                                    
                                <br>
                                <br>
                                <br>
                                <br>
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

                                               