<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>TIENDA INFORMATICA</title>

        <?php
        require './ver_sesion.php';
        require 'menu/css.php';
        ?>

    </head>
    <body>
        <div id="wrapper">
            <?php require 'menu/navbar.php'; ?><!--BARRA DE HERRAMIENTAS-->
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Registar Nota de Crédito  
                            <a href="nota_credito_index.php" 
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
                            <form action="nota_credito_control.php" method="post"
                                  role="form" class="form-horizontal">
                                <input type="hidden" name="accion" value="1">
                                <input type="hidden" name="vnota" value="0">
                                <input type="hidden" name="vusuario" value="<?php echo $_SESSION['usu_cod'] ?>">
                                <input type="hidden" name="vestado" value="ACTIVO">
                                <input type="hidden" name="vmonto" value="0">
                                <input type="hidden" name="pagina" value="nota_credito_index.php">
                                
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Venta</label>
                                    <div class="col-md-6">
                                        <?php
                                        $ventas = consultas::get_datos("select * from v_ventas "
                                                        . " order by ven_cod");
                                        ?>                                 
                                        <select name="vventa" class="form-control select2">
                                            <?php
                                            if (!empty($ventas)) {
                                                foreach ($ventas as $venta) {
                                                    ?>
                                                    <option value="<?php echo $venta['ven_cod']; ?>">
                                                        <?php echo $venta['nro_factura']." - ".$venta['ven_fecha']." - ".
                                                                $venta['cliente']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar una venta</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Sucursal</label>
                                    <div class="col-md-3">
                                        <?php
                                        $sucursales = consultas::get_datos("select * from sucursal "
                                                        . " order by sucu_cod");
                                        ?>                                 
                                        <select name="vsucursal" class="form-control">
                                            <?php
                                            if (!empty($sucursales)) {
                                                foreach ($sucursales as $sucursal) {
                                                    ?>
                                                    <option value="<?php echo $sucursal['sucu_cod']; ?>">
                                                        <?php echo $sucursal['sucu_nombre']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar una sucursal</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Cliente</label>
                                    <div class="col-md-3">
                                        <?php
                                        $clientes = consultas::get_datos("select * from v_cliente "
                                                        . " order by cli_cod");
                                        ?>                                 
                                        <select name="vcliente" class="form-control select2">
                                            <?php
                                            if (!empty($clientes)) {
                                                foreach ($clientes as $cliente) {
                                                    ?>
                                                    <option value="<?php echo $cliente['cli_cod']; ?>">
                                                        <?php echo $cliente['per_nombre']." - ".$cliente['per_apellido']; ?></option>
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
                                    <label class="col-md-2 control-label">Fecha</label>
                                    <div class="col-md-5">
                                        <input type="date" required="" id="fec"
                                           placeholder="Ingrese fecha"  
                                           class="form-control" name="vfecha"
                                             onmouseup="validar()"
                                               onkeyup="validar()"
                                               onchange="validar()"
                                               onclick="validar()"
                                               onkeypress="validar()">
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
        <?php require 'menu/js.php'; ?>

        <script>
            function validar() {
                var hoy = new Date();
                var fechaFormulario = new Date($('#fec').val());
                if (fechaFormulario > hoy) {
                    alert('Fecha superior al actual!!!');
                    $('#fecha').val(hoy);
                    $('#fec').val(hoy);
                }
                else {

                }
            }
            
            function reemplazar(){
//                   alert($('#apel').val());
                var valor=document.getElementById('obs').value.replace("'","");
                document.getElementById('obs').value=valor;
                }
        </script>
        
    </body>
</html>

