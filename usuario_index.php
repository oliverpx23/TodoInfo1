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
                        <h3 class="page-header">Listado de Usuarios 
                            
                            <a href="imprimir_usuarios.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Imprimir" target="_blank">
                                <i class="fa fa-print"></i>
                            </a> 
                            <a href="usuario_agregar.php" 
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
                            $usuarios = consultas::get_datos("select * from v_usuarios
                                         order by usu_cod asc ");
                            if (!empty($usuarios)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">nick</th>                                        
                                                    <th class="text-center">grupo</th>
                                                    <th class="text-center">nombre</th>
                                                    <th class="text-center">estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($usuarios as $usuario) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $usuario['usu_cod']; ?></td>
                                                        <td class="text-center"><?php echo $usuario['usu_nick']; ?></td>
                                                        <td class="text-center"><?php echo $usuario['gru_nombre']; ?></td>
                                                        <td class="text-center"><?php echo $usuario['usu_nombre']; ?></td>
                                                        <td class="text-center"><?php echo $usuario['usu_estado']; ?></td>
                                                       <td class="text-center">
                                                           <a href="/bulls/paginas.php?vgrup=<?php echo $usuario['gru_cod'].
                                                                   '&vgrunombre=' . $usuario['gru_nombre'];?>"
                                                                   class="btn btn-xs btn-info" rel="tooltip" title="Permisos">
                                                               <span class="glyphicon glyphicon-plus"></span></a>
                                                            <a  
                                                                href="usuario_editar.php?vcod=<?php echo $usuario['usu_cod'];?>"
                                                               class="btn btn-xs btn-primary" rel='tooltip' data-title="Editar" >
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                                 <a onclick="borrar(<?php echo"'". $usuario['usu_cod']."_".
                                                                    $usuario['usu_cod']."'";?>)"
                                                                    data-toggle="modal" data-target="#delete"
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
                        
                    </ <!--borrar-->
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
                'usuario_control.php?vcod=' + dat[0] +
                        '&vnick=null'+
                        '&vclave=null'+
                        '&vgrup=null'+
                        '&vnombre=null'+
                        '&vestado=null'+
                        '&accion=3'+
                        '&pagina=usuario_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
        Desea Borrar el Usuario <i><strong>' + dat[1] + '</strong></i> ?'); 
            }
                    </script>
   


    </body>
</html>

                  
                

               