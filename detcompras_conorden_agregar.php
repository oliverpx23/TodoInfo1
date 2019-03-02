<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/blackbulls.ico"/>   
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
                        <h3 class="page-header">Datos de Compras 
                            <!--                            <a href="imprimir_ventas.php" 
                                                           class="btn btn-primary btn-circle pull-right" 
                                                           rel="tooltip" data-title="Imprimir" target="_blank">
                                                            <i class="fa fa-print"></i>
                                                        </a> -->
                            <a href="compras_conorden_index.php" 
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
                            $comprasords = consultas::get_datos
                                            ("select * from v_compras where cod_compra=" . $_REQUEST ['vcod'] . "order by cod_compra asc");
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
                                                <th class="text-center">CONDICION COMPRA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($comprasords as $compraord) { ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <?php echo $compraord['prov_descri']; ?></td>
                                                    <td class="text-center">
                                                        <?php echo $compraord['fecha']; ?></td>
                                                    <td class="text-center">
                                                        <?php echo number_format($compraord['total_compra'], 0, ',', '.'); ?></td>
                                                    <td class="text-center">
                                                        <?php echo $compraord['condicion_compra']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- COMIENZO PARA EL DETALLE-->
                        <?php
                        $detcomprasords = consultas::get_datos
                                        ("select * from v_detcompras where cod_compra=" . $_REQUEST['vcod'] . "order by id_articulo asc");
                        ?>
                        <!-- <div class="col-md-12">-->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Detalle de Orden de Compra
                            </div>
                            <?php if (!empty($detcomprasords)) { ?>
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
                                            <?php foreach ($detcomprasords as $detcompraord) { ?>
                                                <tr>
                                                    <td><?php echo $detcompraord['id_articulo']; ?></td>
                                                    <td><?php echo $detcompraord['descri_art']; ?></td>
                                                    <td><?php echo $detcompraord['descri_depo']; ?></td>
                                                    <td><?php echo number_format($detcompraord['det_precio_unit'], 0, ',', '.'); ?></td>
                                                    <td><?php echo $detcompraord['det_cantidad']; ?></td>
                                                    
                                                    <td><?php echo number_format($detcompraord['detcompra_subtotal'], 0, ',', '.'); ?></td>
                                                    <td>
                                                        <a onclick="borrar(<?php
                                                        echo "'" . $detcompraord['id_articulo'] . "_" .
                                                        $_REQUEST['vcod'] . "_" .
                                                        $detcompraord['cod_depo'] . "_" .
                                                        $detcompraord['det_cantidad'] . "_" .
                                                        $detcompraord['descri_art'] . "'"
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
                                            <strong>No se encontraron detalles para la compra....!</strong>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                
                <!--                DETALLES DE LA ORDEN DE COMPRA-->
                   
<!--                <div class="row">-->
<!--                    <div class="col-lg-12">-->
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                DETALLES DE LA ORDEN DE COMPRA
                            </div>
                            
                                               
                            <?php
                            $detordencompras = consultas::get_datos("select * from v_det_ordencompra where det_estado='PENDIENTE' and cod_orden_compra=". $_REQUEST ['vorden'].
                                    "order by id_articulo asc ");
                            if (!empty($detordencompras)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="table-responsive">
<!--                                    <div>-->
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Articulo</th>                                        
                                                    <th class="text-center">Deposito</th>
                                                    <th class="text-center">Precio Comp.</th>
                                                    <th class="text-center">Cantidad</th>
                                                    <th class="text-center">Subtotal</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($detordencompras as $detordencompra) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $detordencompra['id_articulo']; ?></td>
                                                        <td class="text-center"><?php echo $detordencompra['descri_art']; ?></td>
                                                        <td class="text-center"><?php echo $detordencompra['descri_depo']; ?></td>
                                                        <td class="text-center"><?php echo $detordencompra['precio_unitario']; ?></td>
                                                        <td class="text-center"><?php echo $detordencompra['cantidad']; ?></td>
                                                        <td class="text-center"><?php echo $detordencompra['orden_subtotal']; ?></td>
                                                        <td class="text-center"><?php echo $detordencompra['det_estado']; ?></td>
                                                        <td class="text-center">
                                                            
                                                         <?php if($detordencompra['det_estado']=='CONFIRMADO'){ ?>
                                                                
                                                           <?php }else{?>   
                                                            
                                                                
                                                        <a onclick="confirmar(<?php echo "'".$_REQUEST['vcod'] . "_" .
                                                        $detordencompra['cod_depo'] . "_" .
                                                                $detordencompra['id_articulo'] . "_" .
                                                        
                                                        $detordencompra['precio_unitario'] . "_" .
                                                        $detordencompra['cantidad'] . "_" .
                                                        $detordencompra['orden_subtotal'] . "_".
                                                          $_REQUEST ['vorden']."'"       
                                                        ?>)"
                                                               class="btn btn-xs btn-success" rel='tooltip' data-title="Confirmar"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                                
<!--                                                            <a href="#" class="btn btn-xs btn-primary" rel="tooltip" data-title="Imprimir"
                                                               <span class="glyphicon glyphicon-print"></span></a>-->
                                                        </td>
                                                    </tr>
                                                     <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>                         
<!--                                    </div>-->
                                <?php } else { ?>
                                    <div class="alert alert-info alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>No se encontraron registros del - Detalle  Orden de Compra....!</strong>
                                    </div>
                                <?php } ?>
                            
                                   
                                
                                <!-- /.panel-body -->
                            </div>
                        </div>
                        <!-- /.panel -->
<!--                    </div>-->
                    <!-- /.col-lg-12 -->
<!--                </div>-->
<!--                </div>-->
                </div>
            </div>
            
                <!--Carga para el detalle-->
                <div class="col-md-12">
                    <div class="panel-body">
                        <form action="detcompras_conorden_control.php?vcod=<?php echo $compraorden['cod_compra']; ?>&vorden=<?php echo $compraorden['cod_orden_compra']; ?>" method="get"
                              role="form" class="form-horizontal">
                            <input type="hidden" name="accion" value="1">
                            <input type="hidden" name="vcod" value="<?php echo $_REQUEST['vcod'] ?>">
                            <input type="hidden" name="vorden" value="<?php echo $_REQUEST['vorden'] ?>">
                            <input type="hidden" name="vtotal" value="0">
                            <input type="hidden" name="pagina" value="detcompras_conorden_agregar.php">
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
                                    <label class="col-md-4 control-label">Precio Compra</label>
                                    <div class="col-md-3">
                                        <input type="number" required=""
                                               placeholder="Ingrese Precio"
                                               class="form-control" name="vprecio" autofocus=""
                                               id="precio" value="0" min="1">
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
                                           onkeyup="calsubtotal()"
                                           onchange="calsubtotal()"
                                           >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Subtotal</label>
                                <div class="col-md-3">
                                    <input type="number" required=""
                                           placeholder="Subtotal del producto"
                                           class="form-control"
                                           name="vsubtotal" value="0"
                                           readonly="" id="subtotal">
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
                    var dat = $('#artic').val().split("_");
                    if (parseInt($('#artic').val()) > 0) {
                        $.ajax({
                            type: "GET",
                            url: "/TodoInfo/lista_precios.php?vart=" +  dat[0] + '&vdep=' +
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
                                        $('#precio').select();
                                    }
                        });
                    }
                        
                }
                    
            </script>
            <script>
            function calsubtotal() {
//                var dat = $('#artic').val().split("_");
                $('#subtotal').val(parseInt($('#precio').val()) * parseInt($('#cant').val()));
            }
            
            </script>
<!--            <script>
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
            </script>-->
            <script>
                function borrar (datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href',
                    'detcompras_conorden_control.php?vcod=' + dat[1] +
                            '&varti=' + dat[0] +
                            '&vdep=' + dat[2] +
                            '&vprecio=null' +
                            '&vcant=' + dat[3] +
                            '&vsubtotal=null' +
                            '&vorden='+ dat[5] +
                            '&accion=2' +
                            '&pagina=detcompras_conorden_agregar.php');
                    $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar el Articulo <i><strong>' + dat[4] + '</strong></i> ?');
                
                }
                
                function confirmar (datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href',
                    'detcompras_conorden_control2.php?vcod=' + dat[0] +
                            '&vdep=' + dat[2] +
                            '&varti=' + dat[1] +
                            '&vprecio='+ dat[3] +
                            '&vcant=' + dat[4] +
                            '&vsubtotal=' + dat[5] +
                            '&vorden='+ dat[6] +
                            '&accion=1' +
                            '&pagina=detcompras_conorden_agregar.php');
                    $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Confirmar este Articulo del Detalle de Orden?');
                
                }
            
            </script>
                
    </body>
</html>

