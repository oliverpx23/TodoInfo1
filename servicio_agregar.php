<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/blackbulls.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>BBG - SERVICIOS</title>

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
                        <h3 class="page-header">Registar Servicio 
                            <a href="servicio_index.php" 
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
                            
                            <?php $recepcion=consultas::get_datos("select * from v_recepcion"); ?>
                            <?php $fecha=consultas::get_datos("select * from v_fecha1"); ?>
                            <form action="servicio_control.php" method="post" 
                                  role="form" class="form-horizontal">
                                <input type="hidden" name="accion" value="1">
                                <input type="hidden" name="vserv" value="0">
                                <input type="hidden" name="vestado" value="ACTIVO">
                              <input type="hidden" name="pagina" value="servicio_index.php">
                                <div class="form-group">
                                  
                                  <div class="form-group">
                                    
                                 
                                  <label class="col-md-2 control-label">FECHA:</label>
                                    <div class="col-md-3">
                                        <input type="date" required="" placeholder="Ingrese fecha" readonly=""
                                               class="form-control" name="vfecha" value="<?php echo $fecha[0]['fecdate1'] ?>">
                                    </div>
                                 
                                            <label class="col-md-2 control-label">SERVICIO:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $servicioss = consultas::get_datos("select * from tipo_servicio "
                                                        . " order by id_tip_servi");
                                        ?>                                 
                                        <select name="vtipserv" class="form-control select2">
                                            <?php
                                            if (!empty($servicioss)) {
                                                foreach ($servicioss as $servicios) {
                                                    ?>
                                                    <option value="<?php echo $servicios['id_tip_servi']; ?>">
                                                        <?php echo $servicios['servi_descri']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un servicio</option>
                                            <?php } ?>
                                        </select>
                                    </div>   
                        </div>
                                    
                                </div>
                                 
                   
                          
                        
                                
                        <div class="form-group">
                                    <label class="col-md-3 control-label">ORDEN DE TRABAJO:</label>
                                    <div class="col-md-4">
                                        <?php
                                        $ordentrabajos = consultas::get_datos("select * from orden_trabajo "
                                                        . " order by id_orden_trabajo");
                                        ?>                                 
                                        <select name="vordtrab" class="form-control select2">
                                            <?php
                                            if (!empty($ordentrabajos)) {
                                                foreach ($ordentrabajos as $ordentrabajo) {
                                                    ?>
                                                    <option value="<?php echo $ordentrabajo['id_orden_trabajo']; ?>">
<?php echo $ordentrabajo['id_orden_trabajo']." - "."DESDE ".$ordentrabajo['ordtrab_fecha_ini']." HASTA ".$ordentrabajo['ordtrab_fecha_fin']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar una orden</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                 
                        </div>
                      
                        
                          
                    
                              
                    
                    
                        <br>
                        <br>
                        <br>
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
   <script>  
   
      
             function sololetras() {
                var numero = document.getElementById("descri").value;
                if (numero.match(/^[a-z A-Z,]+$/))
                {

                } else {
                    alert("Solo letras");
                    document.getElementById("descri").value ="";
                }
            }
               
        </script>        

    </body>
</html>
