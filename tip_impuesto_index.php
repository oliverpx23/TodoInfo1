<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/blackbulls.ico"/><!-- Imagen de la pestaña del navegador --> 
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SYS - VENTA</title>

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
                        <h3 class="page-header">Listado de Tipos de Impuestos
                            <a href="#" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Imprimir" target="_blank">
                                <i class="fa fa-print"></i>
                            </a> 
                            <a data-toggle="modal" data-target="#registrar" 
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
                            $timpuestos = consultas::get_datos("select * from tipo_impuesto 
                                         order by id_iva  asc ");
                            if (!empty($timpuestos)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Porcentaje</th>
                                                    <th class="text-center">Descripción</th>                                        
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($timpuestos as $timpuesto) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $timpuesto['id_iva']; ?></td>
                                                        <td class="text-center"><?php echo $timpuesto['iva_porcentaje']; ?></td>
                                                        <td class="text-center"><?php echo $timpuesto['iva_descrip']; ?></td>
                                                        <td class="text-center">
                                                            <a onclick="editar(<?php
                                                            echo "'" . $timpuesto['id_iva'] . "_"
                                                            . $timpuesto['iva_porcentaje'] . "_"
                                                            . $timpuesto['iva_descrip'] . "'";
                                                            ?>)"
                                                               class="btn btn-xs btn-primary" rel='tooltip' data-title="Editar" 
                                                               data-toggle="modal" data-target="#editar">
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                            <a onclick="borrar(<?php
                                                            echo "'" . $timpuesto['id_iva'] . "_"
                                                            . $timpuesto['iva_porcentaje'] . "_"
                                                            . $timpuesto['iva_descrip'] . "'";
                                                            ?>)" 
                                                               class="btn btn-xs btn-primary" rel='tooltip' data-title="Borrar"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-trash"></span></a>
                                                        </td>
                                                    </tr>
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

                <!--registrar-->
                <div id="registrar" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>Registrar Tipo de Impuesto</strong></h4>
                            </div>
                            <form action="tip_impuesto_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vtimp_cod" value="0"/> 
                                    <input type="hidden" name="pagina" value="tip_impuesto_index.php">

                                    <label class="col-lg-2 control-label">Descripción:</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="vtimp_nom" 
                                               required="" autofocus="">
                                    </div>
                                    <br></br>  
                                    <label class="col-lg-2 control-label">Porcentaje:</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control" name="vtimp_por" 
                                               required="" autofocus="">
                                    </div>
                                    
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                        <i class="fa fa-close"></i> Cerrar</button>
                                    <button type="submit" class="btn btn-primary pull-right">
                                        <i class="fa fa-floppy-o"></i> Registrar</button>
                                </div>
                        </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--fin-->
        <!--editar-->
        <div id="editar" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" 
                                data-dismiss="modal" arial-label="Close">x</button>
                        <h4 class="modal-title"><strong>Editar Tipo de Impuesto</strong></h4>
                    </div>
                    <form action="tip_impuesto_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="panel-body">
                            <input name="accion" value="2" type="hidden"/>
                            <input type="hidden" name="pagina" value="tip_impuesto_index.php">
                            <input id="porcen" type="hidden" name="vtimp_cod"/>

                             <label class="col-lg-2 control-label">Descripción:</label>
                            <div class="col-lg-10">
                                <input id="descri" type="text" class="form-control" name="vtimp_nom" 
                                       required="" autofocus="">
                            </div>
                             
                            <label class="col-lg-2 control-label">Porcentaje:</label>
                            <div class="col-lg-10">
                                <input id="porcen" type="number" class="form-control" name="vtimp_por" 
                                       required="" autofocus="">
                            </div>
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                <i class="fa fa-close"></i> Cerrar</button>
                            <button type="submit" class="btn btn-primary pull-right">
                                <i class="fa fa-refresh"></i> Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--fin-->

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
            $('#porcen').val(dat[1]);
            $('#descri').val(dat[2]);

        }

        function borrar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href', 'tip_impuesto_control.php?vtimp_cod= ' + dat[0] 
                    +'&vtimp_por=' + dat[1]
                    + '&vtimp_nom=' + dat[2]
                    + '&accion=3'
                    +'&pagina=tip_impuesto_index.php');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
        Desea Borrar el Tipo de Impuesto <i><strong>' + dat[2] + '</strong></i>?');
        }
    </script>


</body>
</html>
