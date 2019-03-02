<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/blackbulls.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>BBG - ORDEN DE TRABAJO</title>

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
                        <h3 class="page-header">Listado de Orden de Trabajo
                           
                            <a href="orden_trabajo_agregar.php" 
                             class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar" >
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
                            $ordentrabajos = consultas::get_datos("select * from v_orden_trabajo
                                         order by id_orden_trabajo asc ");
                            if (!empty($ordentrabajos)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"># ORDEN</th>
                                                    <th class="text-center">PRESUPUESTO</th>
                                                    <th class="text-center">ARTICULO</th>
                                                    <th class="text-center">USUARIO</th>
                                                    <th class="text-center">FECHA INICIO</th>
                                                    <th class="text-center">FECHA FIN</th>
                                                    <th class="text-center">ESTADO</th>
                                                    <th class="text-center">SUCURSAL</th>
                                                    <th class="text-center">TECNICO</th>
                                                  <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($ordentrabajos as $ordentrabajo) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $ordentrabajo['id_orden_trabajo']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['id_presu']." - ".
                                                                $ordentrabajo['presupuesto']." - "."Gs.".$ordentrabajo['costo']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['articulo']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['ordtrab_fecha_ini']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['ordtrab_fecha_fin']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['estado']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['sucursal']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['tecnico']; ?></td>
                                                        
                                                        <td class="text-center">
                                                            <!--//<a  
                                                                href="ordendetrabajo_editar.php?vordentrab=<?php echo $ordentrabajo['id_orden_trabajo'];?>"
                                                               class="btn btn-xs btn-primary" rel='tooltip' data-title="Editar" >
                                                                <span class="glyphicon glyphicon-pencil"></span></a>//-->
                                                               
                                                            <a onclick="borrar(<?php echo"'". $ordentrabajo['id_orden_trabajo']."_".
                                                                    $ordentrabajo['presupuesto']."'";?>)"
                                                                    data-toggle="modal" data-target="#delete"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Borrar"
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
            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href',
                'ordentrab_control.php?vordtrab=' + dat[0] +
                        '&vpres=null'+
                        '&varticulo=null'+
                        '&vusu=null'+
                        '&vfini=1900-01-01'+
                        '&vffin=1900-01-01'+
                        '&vestado=null'+
                        '&vsuc=null'+
                        '&vtecnico=null'+
                        '&accion=3'+
                       '&pagina=ordendetrabajo_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
        Desea Borrar la orden de trabajo?'); 
            }
                    </script>
   


    </body>
</html>
