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
                        <h3 class="page-header">Listado de Diagnostico
                            <a href="diagnostico_index.php" 
                             class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Atras" >
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a>                    
                        </h3>
                    </div>     
                    <!--Buscador-->
                    <div class="col-lg-12">
                        <div class="panel-body">
                            <?php $fecha=consultas::get_datos("select * from v_fecha1"); ?>
                            <?php $diagnostico= consultas::get_datos
                                    ("select * from v_diagnostico where id_diag=".$_REQUEST['vcod']) ?>
                            <form action="diagnostico_control.php" method="post" role="form"class="form-horizontal">
                                <input type="hidden" name="accion" value="2">
                               
                                <input type="hidden" name="vcod"
                                       value="<?php echo $diagnostico[0]['id_diag']; ?>">
                                <input type="hidden" name="pagina" value="diagnostico_index.php">
                                
                                   <div class="form-group">
                                    <label class="col-md-2 control-label">RECEPCION:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $recepciones = consultas::get_datos("select * from recepcion "
                                                        . " order by id_recep");
                                        ?>                                 
                                        <select name="vrecep" class="form-control select2">
                                            <?php
                                            if (!empty($recepciones)) {
                                                foreach ($recepciones as $recepcion) {
                                                    ?>
                                                    <option value="<?php echo $recepcion['id_recep']; ?>">
                                                        <?php echo $recepcion['id_recep']." - ".$recepcion['recep_descri']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar una recepcion</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="col-md-2 control-label">TECNICO:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $tecnicos = consultas::get_datos("select * from tecnico "
                                                        . " order by id_tecnico");
                                        ?>                                 
                                        <select name="vtecnico" class="form-control select2">
                                            <?php
                                            if (!empty($tecnicos)) {
                                                foreach ($tecnicos as $tecnico) {
                                                    ?>
                                                    <option value="<?php echo $tecnico['id_tecnico']; ?>">
                                                        <?php echo $tecnico['tec_nombre']." ". $tecnico['tec_apellido']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un tecnico</option>
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
                                    
                                    <label class="col-md-2 control-label">FECHA:</label>
                                    <div class="col-md-2">
                                        <input type="date" required="" placeholder="Ingrese fecha" readonly=""
                                               class="form-control" name="vfecha"
                                               value="<?php echo $fecha[0]['fecdate1'] ?>">
                                    </div>
                               </div>
                                   
                                
                        
                        <br>
                                 <div class="form-group">
                                <label class="col-md-2 control-label">TOTAL:</label>
                                <div class="col-md-2">
                                    
                                    <input type="number" required="" placeholder="Ingrese precio total"
                                           class="form-control"
                                           required="" name="vtotal" min="1"
                                           id="precio1"
                                           value="<?php echo $diagnostico[0]['diag_total'];?>">
                                </div>
                            </div>
                        
                                
                                <br>
                                <br>
                                  <div class="form-group">
                                    <label class="col-md-5 control-label">ESTADO:</label>
                                  <div class="row">
                                    <div class="radio col-md-6">
                                        <?php if ($diagnostico[0]['diag_estado'] == 'ACTIVO'){?>
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

                                               