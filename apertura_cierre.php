<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="img/inf.ico"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> - Apertura Cierre</title>

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
                    <?php $aperturas = consultas::get_datos("select * from v_apertura where usu_cod = " . $_SESSION['usu_cod'] . " and estado = 'ACTIVO' "); 
                        if($aperturas){
                             $_SESSION['idapertura'] = $aperturas[0]['cod_ape'];
                         } else {
                             $_SESSION['idapertura'] = null;
                         }
                     ?>
                    <!--impresion del titulo de la pagina-->
                    <div class="col-lg-12">
                        <h3 class="page-header">Apertura Cierre de cajas - <?= $_SESSION['nombres'] ?> 
         <a <?= isset($_SESSION['idapertura']) ? "disabled" : "data-toggle='modal' data-target='#registrar' " ?>
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar Apertura">
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
                                    ?>    
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Fecha Apertura</th> 
                                                    <th class="text-center">Monto Apertura</th> 
                                                    <th class="text-center">Caja</th> 
                                                    <th class="text-center">Factura Sig.</th>
                                                    <th class="text-center">Monto Efectivo</th>
                                                    <th class="text-center">Monto Cheque</th>
                                                    <th class="text-center">Monto Tarjeta</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($aperturas as $apertura) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?= $apertura['cod_ape']; ?></td>
                                                        <td class="text-center"><?php echo date('d/m/Y',  strtotime($apertura['ape_fecha'])); ?></td>
                                                        <td class="text-center"><?php echo number_format($apertura['ape_monto_ape'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo $apertura['caj_descrip']; ?></td>
                                                        <td class="text-center"><?php echo $apertura['siguiente_factura']; ?></td>
                                                        <td class="text-center"><?php echo number_format($apertura['monto_efectivo'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo number_format($apertura['monto_cheque'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo number_format($apertura['monto_tarjeta'], 0, ',', '.'); ?></td>
                                                        <td class="text-center">
                                                          <?php if($apertura['estado'] != "CERRADO"){?>
                                                            <a onclick="cerrar(<?php echo "'".($apertura['monto_efectivo'] + $apertura['monto_cheque'] + $apertura['monto_tarjeta'])."_".$apertura['cod_ape']."_".$apertura['caj_descrip']."_".$apertura['caj_cod']."_".$apertura['usu_cod']."'";?>)"
                                                               class="btn btn-xs btn-success" rel='tooltip' data-title="Cerrar Caja" 
                                                               data-toggle="modal" data-target="#cerrar">
                                                                <span class="glyphicon glyphicon-usd"></span></a>
                                                          <?php }?>
                                                            <a href="arqueo_caja.php?vcod=<?= $apertura['cod_ape']?>" target="_blank" 
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Imprimir Arqueo">
                                                                <span class="glyphicon glyphicon-print"></span></a>
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
                                        <span class="glyphicon glyphicon-info-sign"></span><strong> No posee ninguna apertura hecha a la fecha....!</strong>
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
                <div id="registrar" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>Registrar Apertura</strong></h4>
                            </div>
                            <form action="apertura_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vcod" value="0"/> 
                                    <input type="hidden" name="vmoncierre" value="0"/> 
                                    <input type="hidden" name="pagina" value="apertura_cierre.php">
                                     <div class="form-group">
                                        <label class="col-md-3 control-label">Monto Inicial:</label>
                                        <div class="col-md-5">
                                            <input type="number" required="" placeholder="Ingrese monto" min="1" class="form-control" value="0" name="vmonto" autofocus="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Caja:</label>
                                        <div class="col-md-3">
                                            <?php
                                            $cajas = consultas::get_datos("select * from caja where caj_estado = 'CERRADA'");
                                            ?>                                 
                                            <select name="vcaja" class="form-control select2" style="width: 180%">
                                                <?php
                                                if (!empty($cajas)) {
                                                    foreach ($cajas as $caja) {
                                                        ?>
                                                        <option value="<?php echo $caja['caj_cod']; ?>">
                                                            <?php echo $caja['caj_descrip']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">Debe insertar una caja</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" data-dismiss="modal" class="btn btn-default">
                                        <i class="fa fa-close"></i> Cerrar</button>
                                    <button type="submit" class="btn btn-primary pull-right">
                                        <i class="fa fa-floppy-o"></i> Registrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
