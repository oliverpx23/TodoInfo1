<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="img/inf.ico"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Cobros</title>

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
                    
                         
<!--                         $cobros = consultas::get_datos("select *from v_cobros where cod_ape = " . $aperturas[0]['cod_ape']); 
                     ?>-->
                    <!--impresion del titulo de la pagina-->
                    <div class="col-lg-12">
                        <h3 class="page-header">Cobros 
                                <?php $aperturas = consultas::get_datos("select * from v_apertura where usu_cod = " . $_SESSION['usu_cod'] . " and estado = 'ACTIVO' "); 
                        if(Empty($aperturas)){ 
                             $_SESSION[' idapertura '] = null; ?>
                              <a                           class="btn btn-info btn-circle pull-right" 
                               rel="tooltip" data-title="Debe Realizar una Apertura">
                                <i class="fa fa-info"></i>
                            </a> 
                    <?php         
                         } else {
                             $_SESSION['idapertura'] = $aperturas[0]['cod_ape'];
                             ?>
                                <a href="cobros_agregar.php"
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar Cobros">
                                <i class="fa fa-plus"></i>
                            </a>
                            
                      <?php } ?>                  
                        </h3>
                    </div>     
                    <!--Buscador-->
                    <div class="col-lg-12">
                        <div class="panel-heading">
                            <div class="input-group custom-search-form">
                                <input id="filtrar" type="text" class="form-control" placeholder="Buscar...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" rel="tooltip" title="Buscar">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>                      
                    </div>
                    <!--fin-->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Datos
                            </div>                     
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <?php
                                if (!empty($aperturas)) { 
                                    $cobros = consultas::get_datos("select *from v_cobros where cod_ape = " . $aperturas[0]['cod_ape']); 
                     
                                    if(!empty($cobros)){
                                    ?>    
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Fecha Cobro</th> 
                                                    <th class="text-center">Importe</th> 
                                                    <th class="text-center">Efectivo</th> 
                                                    <th class="text-center">Tarjeta</th>
                                                    <th class="text-center">Cheque</th>
                                                    <th class="text-center">Usuario</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($cobros as $cob) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?= $cob['cod_cob']; ?></td>
                                                        <td class="text-center"><?= date('d/m/Y',  strtotime($cob['cob_fecha'])); ?></td>
                                                        <td class="text-center"><?= number_format($cob['cob_importe'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?= number_format($cob['efectivo'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?= number_format($cob['tarjeta'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?= number_format($cob['cheque'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?= $cob['usu_nombre']; ?></td>
                                                        <td class="text-center"><?= $cob['cob_estado']; ?></td>
                                                        <td class="text-center">
                                                            <a onclick=""
                                                               class="btn btn-xs btn-success" rel='tooltip' data-title="Detalle Cobro" 
                                                               data-toggle="modal" data-target="#cerrar">
                                                                <span class="glyphicon glyphicon-th-list"></span></a>
                                                            <a onclick="borrar(<?php echo "'".$cob['cod_cob']."_".$cob['id_cliente']."'" ?>)"                           
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>                         
                                    </div>
                                             <?php } else { ?>
                                            <div class="alert alert-info alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                    &times;</button>
                                                <span class="glyphicon glyphicon-info-sign"></span><strong> No se encontraron registros....!</strong>
                                            </div>
                                            <?php } ?>  
                                <?php } else { ?>
                                    <div class="alert alert-info alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                            &times;</button>
                                        <span class="glyphicon glyphicon-info-sign"></span><strong> Debe realizar una apertura de caja....!</strong>
                                    </div>
                                <?php } ?>  
                                <!-- /.panel-body -->
                            </div>
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <!--registrar-->
                
                <!--fin-->
            </div>
            <!--borrar-->
            <div id="cerrar" class="modal fade" tabindex="-1" role="dialog">
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
            function cerrar(datos) {
                var dat = datos.split("_");                
                $('#si').attr('href', 'apertura_control.php?vcod=' + dat[1] + '&vcaja=' + dat[3]
                        + '&usu_cod=' + dat[4] + '&vmonto=0' + '&vmoncierre='+dat[0]
                        + '&accion=2&pagina=apertura_cierre.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                Desea Cerrar la Caja <i><strong>' + dat[2] + '</strong></i>?');
            }
        </script>
    </body>
</html>
