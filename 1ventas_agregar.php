<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Detalle de Ventas</title>

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
                        <h3 class="page-header">Registar Ventas  
                            <a href="ventas_index.php" 
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
                            <?php $apertura=  consultas::get_datos("select * from v_apertura"); ?>
                            <?php $fecha=  consultas::get_datos("select * from v_fechanow"); ?>
                            <form action="ventas_control.php" method="post" role="form" class="form-horizontal">
                                <input type="hidden" name="accion" value="1">
                                <input type="hidden" name="vcod" value="0">
                                <input type="hidden" name="vtotal" value="0">
                                <input type="hidden" name="vestado" value="ACTIVO">
                                <input type="hidden" name="vusu" 
                                       value="<?php echo $_SESSION['usu_cod']; ?>">
                                <input type="hidden" name="pagina" value="ventas_index.php">  

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Fecha:</label>
                                    <div class="col-md-3">
                                        <input type="date" required="" placeholder="Ingrese Fecha" readonly=""
                                    class="form-control" name="vfecha" value="<?php echo $fecha[0]['fecha'] ?>">
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Clientes:</label>
                                    <div class="col-md-4">
                                        <?php $clientes = consultas::get_datos("select * "
                                                . "from v_clientes"); ?>                                 
                                        <select name="vcli" class="form-control chosen-select2">
                                            <?php
                                            if (!empty($clientes)) {
                                                foreach ($clientes as $cliente) {
                                                    ?>
                                                    <option value=
                                                        "<?php echo $cliente['id_cliente']; ?>">
                                                        <?php echo $cliente['cliente']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un cliente</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Condicion Venta:</label>                               
                                    <div class="col-md-2">                                                              
                                        <select name="vcondicion" class="form-control" 
                                            id="vcondicion" onchange="tiposelect();">                                         
                                            <option value="CONTADO">CONTADO</option>
                                            <option value="CREDITO">CREDITO</option>                                         
                                        </select>
                                    </div>                                   
                                </div>  
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Cantidad cuota:</label>                               
                                    <div class="col-md-1"> 
                                        <input type="hidden" class="form-control" 
                                               name="vcancuo" value="1">
                                        <input type="number" class="form-control" 
                                               name="vcancuo" disabled="" 
                                              id="vcancuo">
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
            </div>

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
             window.onload = tiposelect;
        </script>

    </body>
</html>
