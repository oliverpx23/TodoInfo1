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
                        <h3 class="page-header">Listado de Proveedores 
                            <a href="proveedor_index.php" 
                             class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Atras" >
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a>                    
                        </h3>
                    </div>     
                    <!--Buscador-->
                    <div class="col-lg-12">
                        <div class="panel-body">
                            <?php $proveedor= consultas::get_datos
                                    ("select * from proveedor where id_proveedor=".$_REQUEST['vcod']) ?>
                            <form action="proveedor_control.php" method="post" role="form"class="form-horizontal">
                                <input type="hidden" name="accion" value="2">
                                <input type="hidden" name="vcod"
                                       value="<?php echo $proveedor[0]['id_proveedor']; ?>">
                                <input type="hidden" name="pagina" value="proveedor_index.php">
                                <div class="form-group">
                                    <label class="col-md-2 control-label"> Nro de RUC:</label>
                                    <div class="col-md-5">
                                        <input type="text" required="" placeholder="Ingrese Numero de RUC"
                                               class="form-control"
                                               name="vruc" value="<?php echo $proveedor[0]['prov_ruc'];?>" autofocus="">
                                               </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Nombre:</label>
                                    <div class="col-md-5">
                                   <input type="text" required="" placeholder="Ingrese nombre"  
                                           class="form-control" name="vnombre"
                                   value="<?php echo $proveedor[0]['prov_descri'];?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Telefono:</label>
                                    <div class="col-md-5">
                                        <input type="text" required="" 
                                               placeholder="Ingrese telefono" 
                                               class="form-control" name="vtel"
                                               value="<?php echo $proveedor[0]['prov_tel'];?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Dirección:</label>
                                    <div class="col-md-8">
                                        <input type="text" required="" 
                                               placeholder="Ingrese dirección" 
                                               class="form-control" name="vdirec"
                                               value="<?php echo $proveedor[0]['prov_direc'];?>">
                                    </div>
                                </div>
                                
                                
                                <br>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> Grabar</button>
                                    </div>
                                </div>
                            </form>     
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>

        </div> 
        <!--fin-->
        <!--archivos js-->   
        <?php require 'menu/js.ctp'; ?>

    </body>
</html>

                                               