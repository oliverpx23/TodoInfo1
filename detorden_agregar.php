<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/inf.ico"/>   
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> TodoInfo</title>

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
                        <h3 class="page-header">Datos de Orden de Compras 
                            <!--                            <a href="imprimir_ventas.php" 
                                                           class="btn btn-primary btn-circle pull-right" 
                                                           rel="tooltip" data-title="Imprimir" target="_blank">
                                                            <i class="fa fa-print"></i>
                                                        </a> -->
                            <a href="ordencompra_index.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Atras" >
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a>                    
                        </h3>
                    </div>     
                    <!--Buscador-->
                    <!--                    <div class="col-lg-12">
                                            <div class="panel-heading">
                                                <div class="input-group custom-search-form">
                                                    <input id="filtrar" type="text" class="form-control" placeholder="Buscar...">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button" rel="tooltip" title="Buscar">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>                      
                                        </div>-->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Datos Cabecera
                            </div>
                            <?php
                            $ordencompras = consultas::get_datos
                                            ("select * from v_orden_compras where cod_orden_compra=" . $_REQUEST ['vcod'] . "order by cod_orden_compra asc");
//                            if (!empty($ventas)) {
                            ?>                         
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table width="100%"
                                           class="table table-bordered">
                                        <thead>
                                            <tr class="success">
                                                <th class="text-center">PROVEEDOR</th>
                                                <th class="text-center">FECHA</th>
                                                <th class="text-center">MONTO</th>
                                                <th class="text-center">ESTADO</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ordencompras as $ordencompra) { ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <?php echo $ordencompra['prov_descri']; ?></td>
                                                    <td class="text-center">
                                                        <?php echo $ordencompra['orden_compra_fecha']; ?></td>
                                                    <td class="text-center">
                                                        <?php echo number_format($ordencompra['total_orden'], 0, ',', '.'); ?></td>
                                                    <td class="text-center">
                                                        <?php echo $ordencompra['orden_compra_estado']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- COMIENZO PARA EL DETALLE-->
                        <?php
                        $detordencompras = consultas::get_datos
                                        ("select * from v_det_orden_compra where cod_orden_compra=" . $_REQUEST['vcod'] . "order by id_articulo asc");
                        ?>
                        <!-- <div class="col-md-12">-->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Detalle de la Orden
                            </div>
                            <?php if (!empty($detordencompras)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Articulos</th>
                                                <th>Deposito</th>
                                                <th>Precio Unit</th>
                                                <th>Cantidad</th>
                                                <th>Subtotal</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($detordencompras as $detordencompra) { ?>
                                                <tr>
                                                    <td><?php echo $detordencompra['id_articulo']; ?></td>
                                                    <td><?php echo $detordencompra['descri_art']; ?></td>
                                                    <td><?php echo $detordencompra['descri_depo']; ?></td>
                                                    <td><?php echo number_format($detordencompra['precio_unitario'], 0, ',', '.'); ?></td>
                                                    <td><?php echo $detordencompra['cantidad']; ?></td>
                                                    
                                                    <td><?php echo number_format($detordencompra['orden_subtotal'], 0, ',', '.'); ?></td>
                                                    <td>
                                                        <a onclick="borrar(<?php
                                                        echo "'" . $detordencompra['id_articulo'] . "_" .
                                                        $_REQUEST['vcod'] . "_" .
                                                        $detordencompra['cod_depo'] . "_" .
                                                        $detordencompra['cantidad'] . "_" .
                                                        $detordencompra['descri_art'] . "'"
                                                        ?>)"

                                                           class="btn btn-xs btn-danger"
                                                           rel="tooltip" data-title="Borrar"
                                                           data-toggle="modal"
                                                           data-target="#delete">
                                                            <span class="glyphicon glyphicon-trash"></span></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-info alert-dismissable">
                                            <button type="button" class="close"
                                                    data-dismiss="alert" aria-hidden="true">&times;
                                            </button>
                                            <strong>No se encontraron detalles para la orden....!</strong>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                
                <!--Carga para el detalle-->
                <div class="col-md-12">
                    <div class="panel-body">
                        <form action="detorden_control.php" method="get"
                              role="form" class="form-horizontal">
                            <input type="hidden" name="accion" value="1">
                            <input type="hidden" name="vcod" value="<?php echo $_REQUEST['vcod'] ?>">
                            <input type="hidden" name="vtotal" value="0">
                            <input type="hidden" name="vsubtotal" value="0">
                            <input type="hidden" name="pagina" value="detorden_agregar.php">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Deposito</label>
                                <div class="col-md-4">
                                    <?php $depositos = consultas::get_datos("select * from deposito"); ?>
                                    <select name="vdep"
                                            class="form-control" id="depo"
                                            onchange="articulo()"
                                            onkeyup="articulo()">
                                        <option value="">Seleccione un deposito</option>
                                        <?php
                                        if (!empty($depositos)) {
                                            foreach ($depositos as $deposito) {
                                                ?>  
                                                <option value="<?php echo $deposito['cod_depo']; ?>">
                                                    <?php echo $deposito['descri_depo']; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="0">Debe insertar un deposito</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Articulos</label>
                                <div class="col-md-4" id="detalles">
                                    <select class="form-control" required>
                                        <option>Seleccione un articulo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Precio Unit</label>
                                <div class="col-md-3" id="precio">
                                    <input type="text" required=""
                                           placeholder="Precio del articulo"
                                           class="form-control"
                                           name="vprecio" id="precio" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Cantidad:</label>
                                <div class="col-md-3">
                                    <input type="number" required=""
                                           class="form-control"
                                           required min="1" name="vcant"
                                           id="cant" value="0"
                                           onmouseup="calsubtotal()"
                                           onkeyup="calsubtotal(), stock()"
                                           onchange="calsubtotal()"
                                           onclick="stock()"
                                           onkeypress="stock()">
                                </div>
                            </div>
                           

                            <br>
                            <div class="form-group">
                                <div class="col-md-offset-4 col-md-10">
                                    <button class="btn btn-success"
                                            type="submit">
                                        <i class="fa fa-floppy-o">

                                        </i> Grabar</button>
                                </div>
                            </div>
                                                        

                            
                        </form>
                    </div>

                </div>
                
                
            </div>
        </div>
                <!--borrar-->
                <div class="modal fade" id="delete" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title custom_align" id="Heading">Atenci&oacute;n!!!</h4>
                            </div>
                            <div class="modal-body">
                                
                                <div class="alert alert-warning" id="confirmacion"></div>

                            </div>
                            <div class="modal-footer">
                                <a id="si" role="button" class="btn btn-primary" ><span class="glyphicon glyphicon-ok-sign"></span> Si</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                            </div>
                        </div>
                    </div>
                </div> 
                <!--fin-->
            </div>
            <!--archivos js-->  
            <?php require 'menu/js.ctp'; ?>
            
            <script>
                function articulo(){
                    if (parseInt($('#depo').val()) > 0) {
                        $.ajax({
                            type: "GET",
                            url: "/TodoInfo/lista_articulos.php?vdep=" + 
                                    $('#depo').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#detalles').
                            html('<img src="/TodoInfo/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#detalles').html(msg);
                                        obtenerprecio();
                                    }
                        });
                    }
                }
                function obtenerprecio(){
                    var dat = $('#arti').val().split("_");
                    if (parseInt($('#arti').val()) > 0) {
                        $.ajax({
                            type: "GET",
                            url: "/TodoInfo/lista_precios.php?varti=" +  dat[0] + '&vdep=' +
                                    $('#depo').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#precio').
                            html('<img src="/TodoInfo/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#precio').html(msg);
                                        calsubtotal();
                                        $('#cant').select();
                                    }
                        });
                    }
                        
                }
                    
            </script>
            <script>
            function calsubtotal() {
                var dat = $('#artic').val().split("_");
                $('#subtotal').val(parseInt(dat[1]) * parseInt($('#cant').val()));
            }
            
            </script>
            <script>
                function stock() {
                    var cant = parseInt ($('#cantstock').val());
                    if (cant > 0){
                        if (parseInt ($('#cant').val()) > cant) {
                            alert ('SOLO HAY ' + cant + 
                                    ' EN STOCK DE ESTE PRODUCTO');
                            $('#cant').val(cant);
                            calsubtotal();
                        }
                    }else{
                        $('#cant').val('0'); {
                            alert ('PRODUCTO AGOTADO EN STOCK ');
                        }
                        calsubtotal();
                    }
                }
            </script>
            <script>
                function borrar (datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href',
                    'detorden_control.php?vcod=' + dat[1] +
                            '&vdep=' + dat[2] +
                            '&vcant=' + dat[3] +
                            '&vsubtotal=0' +
                            '&varti=' + dat[0] +
                            '&vprecio=0' +
                            '&accion=2' +
                            '&pagina=detorden_agregar.php');
                    $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar el Articulo <i><strong>' + dat[4] + '</strong></i> ?');
                
                }
            
            </script>
                






    </body>
</html>