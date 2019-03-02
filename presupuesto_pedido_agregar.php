<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Presupuesto de Compras</title>

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
                        <h3 class="page-header">Datos de Presupuesto de Compras
                            
                            <a href="presupuesto_index.php" 
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
                            $presupuestos= consultas::get_datos
                                            ("select * from v_presupuesto where cod_pres_compra = " .$_REQUEST ['vpresu']. " order by cod_pres_compra asc");
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
                                                <th class="text-center">PEDIDO DE COMPRA</th>
                                                <th class="text-center">ESTADO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($presupuestos as $presupuesto) { ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <?php echo $presupuesto['prov_descri']; ?></td>
                                                    <td class="text-center">
                                                        <?php echo $presupuesto['pres_compra_fecha']; ?></td>
                                                    <td class="text-center">
                                                        <?php echo number_format($presupuesto['pres_compra_total'], 0, ',', '.'); ?></td>
                                                    <td class="text-center">
                                                        <?php echo $presupuesto['cod_pedido_compra']; ?></td>
                                                    <td class="text-center">
                                                        <?php echo $presupuesto['pres_compra_estado']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- COMIENZO PARA EL DETALLE-->
                        <?php
                        $detpresupuestos = consultas::get_datos
                                        ("select * from v_detprescompras where cod_pres_compra=" . $_REQUEST['vpresu'] . "order by id_articulo asc");
                        ?>
                        <!-- <div class="col-md-12">-->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Detalle de Presupuesto
                            </div>
                            <?php if (!empty($detpresupuestos)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Articulos</th>
                                                <th>Precio Compra</th>
                                                <th>Cantidad</th>
                                                <th>Subtotal</th>
                                                <th>Estado</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($detpresupuestos as $detpresupuesto) { ?>
                                                <tr>
                                                    <td><?php echo $detpresupuesto['cod_pres_compra']; ?></td>
                                                    <td><?php echo $detpresupuesto['id_articulo']; ?></td>
                                                    
                                                    <td><?php echo number_format($detpresupuesto['precio_unit'], 0, ',', '.'); ?></td>
                                                    <td><?php echo $detpresupuesto['cantidad']; ?></td>
                                                    <td><?php echo number_format($detpresupuesto['subtotal'], 0, ',', '.'); ?></td>
                                                    <td><?php echo $detpresupuesto['estado']; ?></td>
                                                    
                                                    <td>
                                                        <?php if($detpresupuesto['estado']=='CONFIRMADO'){ ?>
                                                                
                                                           <?php }else {?>
                                                        <a onclick="borrar(<?php echo "'".$_REQUEST['vpresu'] . "_" .
                                                        $detpresupuesto['id_articulo'] . "_" .
                                                        $detpresupuesto['precio_unit'] . "_" .
                                                        $detpresupuesto['cantidad'] . "_" .
                                                        $detpresupuesto['subtotal'] . "'"
                                                        
                                                        ?>)"
                                                               class="btn btn-xs btn-success" rel='tooltip' data-title="Borrar"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-trash"></span></a>
                                                         
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-info alert-dismissable">
                                            <button type="button" class="close"
                                                    data-dismiss="alert" aria-hidden="true">&times;
                                            </button>
                                            <strong>No se encontraron detalles para el presupuesto....!</strong>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!--Carga para el detalle-->
                <div class="col-md-12">
                    <div class="panel-body">
                        <form action="detpresu_control.php" method="get"
                              role="form" class="form-horizontal">
                            <input type="hidden" name="accion" value="1">
                            <input type="hidden" name="vpresu" value="<?php echo $_REQUEST['vpresu'] ?>">
                            <input type="hidden" name="vtotal" value="0">
                            <input type="hidden" name="pagina" value="detpresu_agregar.php">
                            
<!--                            cargar datos de los campos-->
                            <div class="form-group">
                                <label class="col-md-4 control-label">Articulo</label>
                                <div class="col-md-4">
                                    <?php $articulos = consultas::get_datos("select * from articulo"); ?>
                                    <select name="varti"
                                     class="form-control" id="artic" required="" autofocus=""
                                    <option value="">Seleccione un articulo</option>
                                        <?php
                                        if (!empty($articulos)) {
                                            foreach ($articulos as $articulo) {
                                                ?>  
                                                <option value="<?php echo $articulo['id_articulo']; ?>">
                                                    <?php echo $articulo['descri_art']; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="0">Debe insertar un articulo</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                                   <div class="form-group"> 
                                    <label class="col-md-4 control-label">Precio</label>
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
                                    <input type="number" required="" autofocus=""
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
//                function articulo(){
//                    if (parseInt($('#depo').val()) > 0) {
//                        $.ajax({
//                            type: "GET",
//                            url: "/bd_produccion/lista_articulos.php?vdep=" + 
//                                    $('#depo').val (),
//                            cache: false,
//                            beforeSend: function () {
//                                $('#detalles').
//                            html('<img src="/bd_produccion/img/cargando.GIF">\n\
//                            <strong><i>Cargando...</i><strong>');
//                            },
//                                    success: function (msg){
//                                        $('#detalles').html(msg);
//                                        obtenerprecio();
//                                    }
//                        });
//                    }
//                }
//                function obtenerprecio(){
//                    var dat = $('#artic').val().split("_");
//                    if (parseInt($('#artic').val()) > 0) {
//                        $.ajax({
//                            type: "GET",
//                            url: "/bd_produccion/lista_precios.php?vart=" +  dat[0] + '&vdep=' +
//                                    $('#depo').val (),
//                            cache: false,
//                            beforeSend: function () {
//                                $('#precio').
//                            html('<img src="/bd_produccion/img/cargando.GIF">\n\
//                            <strong><i>Cargando...</i><strong>');
//                            },
//                                    success: function (msg){
//                                        $('#precio').html(msg);
//                                        calsubtotal();
//                                        $('#precio').select();
//                                    }
//                        });
//                    }
//                        
//                }
                    
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
                 function borrar(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href',
                    'detpresu_control.php?vpresu=' + dat[0] +
                            '&varti=' + dat[1] +
                            '&vprecio=null' +                            
                            '&vcant=' + dat[2] +
                            '&vsubtotal=null' +
                            '&accion=2' +
                            '&pagina=detpresu_agregar.php');
                    $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar el Articulo <i><strong>' + dat[1] + '</strong></i> ?');
                
                }
            
            </script>
                
    </body>
</html>