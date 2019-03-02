<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/blackbulls.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>BBG - RECLAMOS</title>

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
                        <h3 class="page-header">Registar Reclamo  
                            <a href="reclamos_index.php" 
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
                       
                            <?php $reclamos=consultas::get_datos("select * from v_reclamos"); ?>
                            <?php $fecha=consultas::get_datos("select * from v_fecha1"); ?>
                            <form action="reclamos_control.php" method="post" 
                                  role="form" class="form-horizontal">
                                <input type="hidden" name="accion" value="1">
                                <input type="hidden" name="vrecla" value="0">
                               <input type="hidden" name="pagina" value="reclamos_index.php">
                                <div class="form-group">
                                  
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Servicio:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $servicioss = consultas::get_datos("select * from v_servicio"
                                                        . " order by id_servicos");
                                        ?>                                 
                                        <select name="vserv" class="form-control select2">
                                            <?php
                                            if (!empty($servicioss)) {
                                                foreach ($servicioss as $servicios) {
                                                    ?>
                                                    <option value="<?php echo $servicios['id_servicos']; ?>">
                                                         <?php echo $servicios['id_servicos']." - ".$servicios['serv_descri']; ?></option>
                                                       
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un servicio</option>
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
                                                        <?php echo $usuario['usu_nick']; ?></option>
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
                                  
                        <BR>
                          
                           
                                
                        <div class="form-group">
                                    <label class="col-md-2 control-label">CLIENTES:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $clientess = consultas::get_datos("select * from v_clientes "
                                                        . " order by id_cliente");
                                        ?>                                 
                                        <select name="vclient" class="form-control select2">
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
                                                <option value="0">Debe insertar un cliente</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                 <label class="col-md-2 control-label">FECHA:</label>
                                    <div class="col-md-3">
                                        <input type="date" required="" placeholder="Ingrese fecha" readonly=""
                                               class="form-control" name="vfecarecl" value="<?php echo $fecha[0]['fecha'] ?>">
                                    </div>
                        </div>
                      
                        
                          
                    <BR>
                                <div class="form-group">
                                    
                                    <label class="col-md-2 control-label">OBS:</label>
                                    
                                    <div class="col-md-8">
                                        <textarea type="text" required="" placeholder="Ingrese una observacion del reclamo"  
                                               class="form-control" name="vobs"
                                               id="descri" rows="3"
                                               onchange="sololetras()"
                                               onkeyup="sololetras()"></textarea>
                                    </div>
                                    
                                </div>
                    
                    
                    
                        <br>
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
