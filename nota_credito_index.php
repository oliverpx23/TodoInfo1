<!DOCTYPE html>
<html lang="es">
    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=egde">
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
                    <!--impresion del titulo de la pagina-->
                    <div class="col-lg-12">
                        <h3 class="page-header">Listado de Nota de Credito 
                            <a href="nota_credito_agregar.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar">
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
                            $notacreditos = consultas::get_datos("select * from v_notacredito 
                                         order by notacredi_cod asc ");
                            if (!empty($notacreditos)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"># Nota</th>
                                                    <th class="text-center"># Venta</th>
                                                    <th class="text-center">Factura</th>
                                                    <th class="text-center">Monto Venta</th>
                                                    <th class="text-center">Cliente</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($notacreditos as $notacredito) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $notacredito['notacredi_cod']; ?></td>
                                                        <td class="text-center"><?php echo $notacredito['ven_cod']; ?></td>
                                                        <td class="text-center"><?php echo $notacredito['nro_factura']; ?></td>
                                                        <td class="text-center"><?php echo $notacredito['ven_total']; ?></td>
                                                        <td class="text-center"><?php echo $notacredito['cliente']; ?></td>
                                                        <td class="text-center"><?php echo $notacredito['notacredi_estado']; ?></td>
                                                        <td class="text-center">
                                                            
                                                        <?php 
                                                        
                                                        if($notacredito['notacredi_estado'] == 'CANCELADO') { ?>
                                                             
                                                        <?php } else { ?>
                                                            
                                                            <a href="notacredito_detalle.php?vnota=<?php echo $notacredito['notacredi_cod'];?>&vven=<?php echo $notacredito['ven_cod'];?>" 
                                                               class="btn btn-xs btn-success" rel='tooltip' data-title="Detalles"
                                                               data-toggle="modal">
                                                                <span class="glyphicon glyphicon-th-list"></span></a>
                                                                
                                                            <a onclick="cancelar(<?php echo "'".$notacredito['notacredi_cod']."_".
                                                                    $notacredito['ven_cod']."_".$notacredito['sucu_cod']."_".
                                                                    $notacredito['cli_cod']."_".$notacredito['notacredi_estado']."'"; ?>)" 
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Cancelar"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="fa fa-ban"></span></a>
                                                            
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
        </div>
            
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
        
        <script>
            function cancelar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'reclamo_control.php?vnota=' + dat[0] + 
                        '&vventa='+ dat[1] +
                        '&vusuario='+ dat[2] +
                        '&vsucursal='+ dat[3] +
                        '&vfecha=' +
                        '&vmonto=0' + 
                        '&vcliente=' + dat [4] +
                        '&vestado=CANCELADO' +
                        '&accion=2'+
                        '&pagina=nota_credito_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea <strong> Cancelar </strong> la Nota <i><strong> N°' + dat[0] + '</strong></i>?');
            }
        </script>
        
        <?php
        require './menu/footer.php';
        require './menu/js.php';
        ?>
    </body>
</html>