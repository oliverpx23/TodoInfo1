<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/inf.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Orden de Compras</title>

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
                        <h3 class="page-header">Listado Orden de Compras
                            <a href="ordencompra_agregar.php" class="btn btn-primary btn-circle pull-right">
                                <i class="fa fa-plus" rel="tooltip" data-title="Registrar"></i>
                            </a>  
                        </h3>
                    </div>     
                    <!--Buscador-->
                    <div class="col-lg-12">
                        <!--<div class="panel panel-default">-->
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
                        <!--</div>-->
                    </div>
                </div>
                
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Datos
                            </div>
                            <?php
                            $orden_compras = consultas::get_datos("select * from v_orden_compras 
                                         order by cod_orden_compra asc");
                            if (!empty($orden_compras)) {
                                ?>                         
                                <!--fin-->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">ID PROVEEDOR</th>   
                                                    <th class="text-center">PROVEEDOR</th>  
                                                    <th class="text-center">FECHA</th>   
                                                    <th class="text-center">MONTO</th>   
                                                    
                                                    <th class="text-center">ESTADO</th>
                                                    
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($orden_compras as $orden_compra) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $orden_compra['cod_orden_compra']; ?></td>
                                                        <td class="text-center"><?php echo $orden_compra['id_proveedor']; ?></td>
                                                        <td class="text-center"><?php echo $orden_compra['prov_descri']; ?></td>
                                                        <td class="text-center"><?php echo $orden_compra['orden_compra_fecha']; ?></td>
                                                        <td class="text-center"><?php echo $orden_compra['total_orden']; ?></td>
                                                        <td class="text-center"><?php echo $orden_compra['orden_compra_estado']; ?></td>  
                                                         
                                                        
                                                        <td class="text-center">  
                                                           <?php if($orden_compra['orden_compra_estado'] == 'ANULADO'){ ?> 
                                                           <?php }else{ ?>
                                                            <a href="detorden_agregar.php?vcod=<?php echo 
                                                            $orden_compra['cod_orden_compra']; ?>" 
                                                               class="btn btn-xs btn-success" rel='tooltip' 
                                                               data-title="Detalles">
                                                                <span class="glyphicon glyphicon-th-list"></span></a>

                                                         <a href="imprimir_factura.php?vcod=<?php echo $orden_compra['cod_orden_compra']; ?>" 
                                                               target="_blank" 
                                                               class="btn btn-xs btn-primary" 
                                                               rel='tooltip' data-title="Imprimir">
                                                                <span class="glyphicon glyphicon-print"></span></a>

                                                            <a onclick="borrar(<?php echo "'".$orden_compra['cod_orden_compra']."_".$orden_compra['id_proveedor']."'" ?>)"                           
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                           <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>                         
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-info alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>No se encontraron registros....!</strong>
                                    </div>
                                <?php } ?>  
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
            </div> 
            <!--fin-->
            <!--archivos js-->   
            <?php require 'menu/js.ctp'; ?>


            <script>
                function borrar(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href', 'ordencompra_control.php?accion=2'+
                            '&vorden=' + dat[0] +
                            '&vfecha=1900-01-01' +
                            '&vestado=ANULADO' +
                            '&vusu=null' +
                            '&vprov=null' +
                            '&vtotal=0' +
                            '&vpresu=0' +
                            '&pagina=ordencompra_index.php');
                    $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea Borrar el Pedido <i><strong> ' + dat[0] + '</strong></i>?');
                }
            </script>



    </body>
</html>