<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/blackbulls.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>BBG - ORDEN DE TRABAJO</title>

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
                        <h3 class="page-header">Registar Orden de trabajo 
                            <a href="ordendetrabajo_index.php" 
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
                          <?php $ordentrabajo=consultas::get_datos("select * from v_orden_trabajo"); ?>
                            <?php $fecha=consultas::get_datos("select * from v_fecha1   "); ?>
                            <form action="ordentrab_control.php" method="post" 
                                  role="form" class="form-horizontal" >
                                <input type="hidden" name="accion" value="1">
                                <input type="hidden" name="vordtrab" value="0">
                                <input type="hidden" name="vestado" value="ACTIVO">
                               <input type="hidden" name="pagina" value="ordendetrabajo_index.php">
                                 <div class="form-group">
                                     

                                     
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
                         </div>
                                 
                                 
                        </div>
                                    
                                   <label class="col-md-2 control-label">FECHA INICIO:</label>
                                    <div class="col-md-3">
                                        <input type="date" required="" placeholder="Ingrese fecha" 
                                               class="form-control" name="vfini" value="<?php echo $fecha[0]['fecdate1'] ?>">
                                    </div>
                                   
                                       <label class="col-md-2 control-label">FECHA FIN:</label>
                                    <div class="col-md-3">
                                        <input type="date" required="" placeholder="Ingrese fecha" 
                                               class="form-control" name="vffin" value="<?php echo $fecha[0]['fecdate1'] ?>">
                                    </div>
                        
                                   
                        
                                  
                        
                             
                    <br>
                    <br>
                    <br>
                    
                        
                        <div class="form-group">
                                    <label class="col-md-2 control-label">PRESUPUESTO:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $presupuestos = consultas::get_datos("select * from presupuesto "
                                                        . " order by id_presu");
                                        ?>                                 
                                        <select name="vpres" class="form-control select2">
                                            <?php
                                            if (!empty($presupuestos)) {
                                                foreach ($presupuestos as $presupuesto) {
                                                    ?>
                                                    <option value="<?php echo $presupuesto['id_presu']; ?>">
                                                        <?php echo $presupuesto['id_presu']." - ".$presupuesto['pres_descri']." - "."Gs. ".$presupuesto['pres_costo']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un presupuesto</option>
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
                                        <select name="vtecnico" class="form-control select2 ">
                                            <?php
                                            if (!empty($tecnicos)) {
                                                foreach ($tecnicos as $tecnico) {
                                                    ?>
                                                    <option value="<?php echo $tecnico['id_tecnico']; ?>">
                                                        <?php echo $tecnico['tec_nombre']." - ".$tecnico['tec_apellido']; ?></option>
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
                                     <label class="col-md-2 control-label">ARTICULO:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $articulos = consultas::get_datos("select * from articulos "
                                                        . " order by id_articulo");
                                        ?>                                 
                                        <select name="varticulo" class="form-control select2">
                                            <?php
                                            if (!empty($articulos)) {
                                                foreach ($articulos as $articulo) {
                                                    ?>
                                                    <option value="<?php echo $articulo['id_articulo']; ?>">
                                                        <?php echo $articulo['art_descri']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un articulo</option>
                                            <?php } ?>
                                        </select>
                                    </div>   
                                 </div>                        
                                    
                        </div>
                    
                       
                     
                    
                  
                    
                       
                        <br>
                        
                       
                                  
                            
                     
                        
                        <br>
                        <br>
                         <br>
                                <div class="form-group">
                                    <div class="col-md-offset-4 col-md-10">
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
