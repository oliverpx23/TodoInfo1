<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Agregar Orden de Compra</title>

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
                        <h3 class="page-header">Registar Presupuesto Compra
                            <a href="ordencompra_index.php
                               " 
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
                            <form action="ordencompra_control.php" method="post" 
                                  role="form" class="form-horizontal">
                                <input type="hidden" name="accion" value="1">
                                <input type="hidden" name="vorden" value="1">
                                <input type="hidden" name="vpresu" value="0">
                                 <input type="hidden" name="vtotal" value="0">
                                  <input type="hidden" name="vestado" value="PENDIENTE">
                                   <input type="hidden" name="vusu" value="<?php echo $_SESSION['usu_cod']; ?>">
                                <input type="hidden" name="pagina" value="ordencompra_index.php">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Fecha</label>
                                    <div class="col-md-4">
                                        <input type="date" required="" id="fec"
                                               placeholder="Especifique fecha"
                                               class="form-control"
                                               value="<?php echo date("Y-m-d") ?>" name="vfecha" 
                                               onmouseup="validar()"
                                               onkeyup="validar()"
                                               onchange="validar()"
                                               onclick="validar()"
                                               onkeypress="validar()">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Proveedor</label>
                                    <div class="col-md-4">
                                        <?php $proveedores = consultas::get_datos("select * from v_proveedores"); ?>
                                        <select name="vprov" class="form-control select2">
                                            <?php 
                                            if (!empty($proveedores)) {
                                                foreach ($proveedores as $proveedor) {
                                                    ?>
                                            <option value="<?php echo $proveedor['id_proveedor']; ?>">
                                                    <?php echo $proveedor['prov_descri']; ?></option>
                                            <?php
                                                }
                                            }else {
                                                ?>
                                            <option value="0">Debe ingresar un Proveedor</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Sucursal</label>
                                    <div class="col-md-4">
                                        <?php $sucursales = consultas::get_datos("select * from v_sucursal"); ?>
                                        <select name="vsuc" class="form-control select2">
                                            <?php 
                                            if (!empty($sucursales)) {
                                                foreach ($sucursales as $sucursal) {
                                                    ?>
                                            <option value="<?php echo $sucursal['cod_suc']; ?>">
                                                    <?php echo $sucursal['nombre_suc']; ?></option>
                                            <?php
                                                }
                                            }else {
                                                ?>
                                            <option value="0">Debe ingresar una Sucursal</option>
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
            function nronegativo() {

                var numero = document.getElementById("cuo").value;
                if (numero.match(/^-?[0-9]+(\.[0-9]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    alert("No se permite numeros negativos, ni letras");
                    document.getElementById("cuo").value = "";
                }
            }
        </script>
    </body>
</html>
