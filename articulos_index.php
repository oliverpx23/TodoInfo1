<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/inf.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> - Articulos</title>

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
                        <h3 class="page-header">Listado de Articulos 
                            <a href="imprimir_articulos.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Imprimir" target="_blank">
                                <i class="fa fa-print"></i>
                            </a> 
                            <a href="articulos_agregar.php" 
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
                            $articulos = consultas::get_datos("select * from v_articulos
                                         order by id_articulo asc ");
                            if (!empty($articulos)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">marca</th>                                        
                                                    <th class="text-center">descripcion</th>
                                                    <th class="text-center">precio</th>
                                                    
                                                    
                                                    <th class="text-center">acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($articulos as $articulo) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $articulo['id_articulo']; ?></td>
                                                        <td class="text-center"><?php echo $articulo['descri_marca']; ?></td>
                                                        <td class="text-center"><?php echo $articulo['descri_art']; ?></td>
                                                        <td class="text-center"><?php echo $articulo['precio_art']; ?></td>
                                                         <td class="text-center">
                                                             
                                                        
                                                            <a  
                                                                href="articulos_editar.php?vcodart=<?php echo $articulo['id_articulo']; ?>"
                                                                class="btn btn-xs btn-primary" rel='tooltip' data-title="Editar" >
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                            <a 
                                                                onclick="borrar(<?php echo "'" . $articulo['id_articulo'] . "_" . $articulo['id_articulo'] . "'"; ?>)"
                                                                data-toggle="modal" data-target="#delete"
                                                                class="btn btn-xs btn-primary" rel='tooltip' 
                                                                data-title="Borrar">
                                                                <span class="glyphicon glyphicon-trash"></span>
                                                            </a>
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
                    'articulos_control.php?vcodart=' + dat[0] +
                    '&vartdescri=null' + 
                    '&vprecio=0' + 
                    '&vartimg=null' +
                    '&vcodmar=null' +
                    '&vtipoart=null' +
                    '&vcosto=null' +
                    
                    '&accion=3' +
                    '&pagina=articulos_index.php');
                    $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar el Articulo de codigo <i><strong>' + dat[0] + '</strong></i> ?');
                }
            </script>
    </body>
</html>
