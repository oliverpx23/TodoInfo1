<!DOCTYPE html>
<html lang="es">
    <head>
    <link rel="shortcut icon" href="img/inf.ico"/><!-- Imagen de la pestaña del navegador --> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Todo Info</title>
    <?php
    require './ver_sesion.php';
    ?>
<!-- Bootstrap Core CSS -->
    <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="./vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="./vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
</head>
<body>
    <div id="wrapper">
        <?php require 'menu/navbar.php';?><!--Barra de herramientas-->
        <div id="page-wrapper">
            
            <?php $fecha = consultas::get_datos("select * from v_fecha") ?>

                <div class="row">
                    <div class="col-lg-12">
                        <h1><i><?php echo $fecha[0]['fecdate'];  ?></i></h1>
                    </div>
                     <h3 class="page-header"><i>COMPRAS</i></h3>
                </div>

                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Listado de Compras</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/TodoInfo/compras_index.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Vista de los Detalles</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-truck fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Proveedores</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/TodoInfo/proveedor_agregar.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Registar Nuevo Proveedor</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-balance-scale fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Compras</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/TodoInfo/compras_agregar.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Registrar Compras</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-dollar fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Ctas a Pagar</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/TodoInfo/ctaspagar_index.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Listado de Cuentas a Pagar</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--        VENTAS-->

<!--            <div id="page-wrapper">-->
                <div class="row">
<!--                    <div class="col-lg-12">-->
                        <h3 class="page-header"><i>VENTAS</i></h3>
                    </div>

                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list-ul fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Listado de Ventas</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/TodoInfo/ventas_index.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Vista de los Detalles</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa  fa-group fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Clientes</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/TodoInfo/clientes_agregar.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Registar Nuevo Cliente</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Ventas</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/TodoInfo/ventas_agregar.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Registrar Ventas</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-money fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Ctas a Cobrar</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/TodoInfo/ctascobrar_index.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Listado de Cuentas a Cobrar</span>
                                    <span class="pull-right"><i class="	fa fa-arrow-circle-o-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
          <!--            </div>-->
            </div>
            
        </div>
    <!--</div>-->
    
    <!-- jQuery -->
    <script src="./vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="./vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="./dist/js/sb-admin-2.js"></script>
</body>
</html>



 
    
    