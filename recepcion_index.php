<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/blackbulls.ico"/>
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
                        <h3 class="page-header">Listado de Recepción
                           
                            <a href="recepcion_agregar.php" 
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
                            $recepcions = consultas::get_datos("select * from v_recepcion
                                         order by id_recep asc ");
                            if (!empty($recepcions)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">DESCRIPCION</th>                                        
                                                    <th class="text-center">CLIENTE</th>
                                                    <th class="text-center">USUARIO</th>
                                                    <th class="text-center">SUCURSAL</th>
                                                    <th class="text-center">FECHA</th>
                                                    <th class="text-center">ESTADO</th>
                                                    <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($recepcions as $recepcion) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $recepcion['id_recep']; ?></td>
                                                        <td class="text-center"><?php echo $recepcion['recep_descri']; ?></td>
                                                        <td class="text-center"><?php echo $recepcion['cliente']; ?></td>
                                                        <td class="text-center"><?php echo $recepcion['usu_nombre']; ?></td>
                                                        <td class="text-center"><?php echo $recepcion['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $recepcion['recep_fecha']; ?></td>
                                                        <td class="text-center"><?php echo $recepcion['recep_estado']; ?></td>
                                                        <td class="text-center">
                                                            <a  
                                                                href="recepcion_editar.php?vcod=<?php echo $recepcion['id_recep'];?>"
                                                               class="btn btn-xs btn-primary" rel='tooltip' data-title="Editar" >
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                                
                                                                <a  
                                                                href="detrecep_agregar.php?vcod=<?php echo $recepcion['id_recep'];?>"
                                                               class="btn btn-xs btn-success" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>
                                                                
                                                            <a onclick="borrar(<?php echo"'". $recepcion['id_recep']."_".
                                                                    $recepcion['recep_descri']."'";?>)"
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
                'recepcion_control.php?vcod=' + dat[0] +
                        '&vdescri='+
                        '&vcli=null'+
                        '&vusu=null'+
                        '&vsuc=null'+
                        '&vfecha=1900-01-01'+
                        '&vestado='+
                        '&accion=3'+
                       '&pagina=recepcion_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
        Desea Borrar la recepcion'); 
            }
                    </script>
   


    </body>
</html>
