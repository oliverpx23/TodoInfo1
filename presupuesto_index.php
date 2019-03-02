<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/inf.ico"/><!-- Imagen de la pestaña del navegador -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Presupuesto de Compra</title>

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
                        <h3 class="page-header">Listado de Presupuesto de Compras
                            
                            <a href="presupuesto_agregar.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar Presupuesto Compra" >
                                <i class="fa fa-plus"></i>
                            </a>
                            
                        </h3>
                    </div>     
                    <!--Buscador-->
                    <div class="col-lg-12">
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
                            $presupuestoscompras = consultas::get_datos("select * from v_presupuesto
                                         order by cod_pres_compra asc ");
                            if (!empty($presupuestoscompras)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Proveedores</th>
                                                    
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">Usuario</th>
                                                    <th class="text-center">Monto</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($presupuestoscompras as $presupuestocompra) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $presupuestocompra['cod_pres_compra']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestocompra['prov_descri']; ?></td>
                                                        
                                                        <td class="text-center"><?php echo $presupuestocompra['pres_compra_fecha']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestocompra['usu_nombre']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestocompra['pres_compra_total']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestocompra['pres_compra_estado']; ?></td>
                                                        <td class="text-center">
                                                            
                                                            <?php if($presupuestocompra['pres_compra_estado']=='ACEPTADO'){ ?>
                                                                
                                                           <?php }else{?>
                                                            
                                                            <a  
                                                                href="detpresu_agregar.php?vpresu=<?php echo $presupuestocompra['cod_pres_compra']; ?>"
                                                                class="btn btn-xs btn-success" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-th-list"></span></a>
                                                                                                        
                                                                <a onclick="borrar(<?php echo "'".$presupuestocompra['cod_pres_compra']."_".
                                                                    $presupuestocompra['prov_descri']."'"; ?>)"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular Presupuesto"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                                
<!--                                                            <a href="#" class="btn btn-xs btn-primary" rel="tooltip" data-title="Imprimir"
                                                               <span class="glyphicon glyphicon-print"></span></a>-->
                                                        </td>
                                                    </tr>
                                                     <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>                         
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-info alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>No se encontraron registro....!</strong>
                                    </div>
                                <?php } ?>  
                                <!-- /.panel-body -->
                            </div>
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
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
            function editar(datos) {
                var dat = datos.split("_");
                $('#cod').val(dat[0]);
                $('#descri').val(dat[1]);

            }

            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'presupuesto_control.php?vpresu=' + dat[0] + 
                        '&vtotal=null'+
                        '&vfecha=1900-01-01'+
                        '&vprov=null'+
                        '&vusu=null'+
                        '&vestado=ANULADO'+
                        '&vped=null'+
                        '&accion=2'+
                        '&pagina=presupuesto_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar el Presupuesto del Proveedor <i><strong>' + dat[1] + '</strong></i>?');
            }
        </script>
    </body>
</html>
