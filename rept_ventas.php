<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="shortcut icon" href="img/blackbulls.ico"/>
        <meta charset="utf-8">
        <title>SYS-VENTAS</title>
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="favicon_16.ico"/>
        <link rel="bookmark" href="favicon_16.ico"/>

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
                        <h3 class="page-header">Listado de Ventas</h3>
                    </div>     
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-10">                                             
                                <div class="box box-primary">                                                          
                                    <div class="box-body no-padding">                                   
                                        <div class="row">                                        
                                            <div class="col-md-3 col-md-offset-0">
                                                <div class="list-group">
                                                    <a href="#" class="list-group-item active">
                                                        Reportes
                                                    </a>
                                                    <a  href="#" onclick="obtener_fecha()" class="list-group-item">Por Rango de Fecha</a>
                                                    <a href="#" onclick="obtener_cliente()" class="list-group-item">Por Cliente</a>
                                                    <a href="#" onclick="obtener_condicion()" class="list-group-item">Por Condición</a>
                                                    <a href="#" onclick="obtener_estado()" class="list-group-item">Por Estado</a>
<!--                                                    <a href="#" class="list-group-item">Cursos</a>                                                                          -->
                                                </div>                                                
                                            </div>
                                            <div id="cargando"></div>
                                        </div>
                                    </div>
                                </div>                      
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>

        <?php require 'menu/js.ctp'; ?>
        <script>
            function obtener_fecha() {
                $.ajax({
                    type: "POST",
                    url: "/bulls/inf_ventas_fecha.php/",
                    cache: false,
                    beforeSend: function () {
                        $('#cargando').html('<img src="/bulls/img/ajax-loader.gif">  <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#cargando').html(msg);
                    }
                });
            }   
            function obtener_cliente() {
                $.ajax({
                    type: "POST",
                    url: "/bulls/inf_ventas_cliente.php/",
                    cache: false,
                    beforeSend: function () {
                        $('#cargando').html('<img src="/bulls/img/ajax-loader.gif">  <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#cargando').html(msg);
                    }
                });
            } 
              function obtener_condicion() {
                $.ajax({
                    type: "POST",
                    url: "/bulls/inf_ventas_condicion.php/",
                    cache: false,
                    beforeSend: function () {
                        $('#cargando').html('<img src="/bulls/img/ajax-loader.gif">  <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#cargando').html(msg);
                    }
                });
            } 
             function obtener_estado() {
                $.ajax({
                    type: "POST",
                    url: "/bulls/inf_ventas_estado.php/",
                    cache: false,
                    beforeSend: function () {
                        $('#cargando').html('<img src="/bulls/img/ajax-loader.gif">  <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#cargando').html(msg);
                    }
                });
                }
        </script>
    </body>
</html>



