<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/inf.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Agregar Pedidos de Compra</title>

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
                        <h3 class="page-header">Registar Pedidos de Compra  
                            <a href="pedido_compras_index.php" 
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
                             <?php $pedcompras=consultas::get_datos("select * from v_pedido_compras"); ?>
                             <?php $fecha=consultas::get_datos("select * from v_fechanow"); ?>
                            <form action="pedido_compras_control.php" method="post" 
                                  role="form" class="form-horizontal">
                                <input type="hidden" name="accion" value="1">
                                <input type="hidden" name="vcod" value="0">
                                <input type="hidden" name="vtotal" value="0">
                                <input type="hidden" name="vestado" value="ACTIVO">
                                <input type="hidden" name="vusu" 
                                        value="<?php echo $_SESSION['usu_cod']; ?>">
                                
                                
                                        
                                <input type="hidden" name="pagina" value="pedido_compras_index.php">
                             
                              
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Proveedor</label>
                                    <div class="col-md-5">
                                        <?php
                                        $proveedores = consultas::get_datos("select * from v_proveedores");
                                        ?>                                 
                                        <select name="vprov" class="form-control select" required="">
                                            <?php
                                            if (!empty($proveedores)) {
                                                foreach ($proveedores as $proveedor) {
                                                    ?>
                                                    <option value="<?php echo $proveedor['id_proveedor']; ?>">
                                                        <?php echo $proveedor['prov_descri']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un Proveedor</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                     <label class="col-md-2 control-label">FECHA:</label>
                                    <div class="col-md-3">
                                        <input type="date" required="" placeholder="Ingrese fecha" readonly=""
                                               class="form-control" name="vfecha" value="<?php echo $fecha[0]['fecha'] ?>">
                                    </div>
                                </div>
                                
                                 
                                    
                               
                                
                                
                                   
                         </div>

                               

                                <br>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> Grabar</button>
                                    </div>
                                </div>
                               
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>

         
        <!--fin-->
        <!--archivos js-->   
        <?php require 'menu/js.ctp'; ?>
        
        <script>
            function tiposelect() {
                if (document.getElementById('vcondicion').
                        value === "CONTADO") {
                    document.getElementById('vcancuo').
                            setAttribute('disabled','true');
                    document.getElementById('vcancuo').
                            value = '1';
                        } else {
                            document.getElementById('vcancuo').
                                    removeAttribute('disabled');
                            document.getElementById('vcancuo').
                                    value = '1';
                        }
                    }
                    window.onload = tiposelect();
                                    </script>
                        
                
            

    </body>
</html>

