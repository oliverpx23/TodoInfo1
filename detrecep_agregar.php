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
                        <h3 class="page-header">Datos de Recepcion 
                            <a href="recepcion_index.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel='tooltip' title="Atras">
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a> 

                        </h3>
                    </div>     
                    <!--Buscador-->

                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Datos Cabecera
                            </div>
                            <?php
                            $recepciones = consultas::get_datos("select * from v_recepcion where id_recep=" .
                                            $_REQUEST ['vcod'] . " order by id_recep asc ");
                            ?>                         
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table width="100%"
                                           class="table table-bordered">
                                        <thead>
                                            <tr class="success">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Descripción</th>                                        
                                                <th class="text-center">Cliente</th>
                                                <th class="text-center">Usuario</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($recepciones as $recepcione) { ?> 
                                                <tr>
                                                    <td class="text-center">
                                                        <?php echo $recepcione['id_recep']; ?></td>
                                                    <td class="text-center">
                                                        <?php echo $recepcione['recep_descri']; ?></td>
                                                    <td class="text-center">
                                                        <?php echo $recepcione['cliente']; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $recepcione['usu_nombre']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>                         
                                </div>
                            </div>
                        </div>
                        <!-- comienzo para el detalle-->
                        <?php
                        $detreceps = consultas::get_datos
                                        ("select * from  v_det_recep"
                                        . " where id_recep=" . $_REQUEST['vcod'] .
                                        "order by id_recep asc");
                        ?>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Detalle de Ventas
                            </div>
                            <?php if (!empty($detreceps)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th># Recepción</th>
                                                <th>Descripción</th>
                                                <th>Equipo</th>
                                                <th> Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($detreceps as $detrecep) { ?>
                                                <tr>
                                                    <td><?php echo $detrecep['id_recep']; ?></td>
                                                    <td><?php echo $detrecep['det_recep_descri']; ?></td>
                                                    <td><?php echo $detrecep['equi_descri']; ?></td>
                                          
                                                    <td class="text-center">
                                                            
                                                             <a onclick="borrar(<?php echo"'".$_REQUEST['vcod']."_".  $detrecep['det_recep_descri']."_".
                                                                     $detrecep['id_equi']."'";?>)"
                                                                    data-toggle="modal" data-target="#delete"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Borrar"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-trash"></span></a>
                                                            </tr>
                                                            
                                                            
                                    <?php } ?>
                                        </tbody>
                                    </table>
<?php } else { ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-info
                                             alert-dismissable">
                                            <button type="button" class="close"
                                                    data-dismiss="alert" aria-hideden="true">&times;
                                            </button>
                                            <strong>No se encontraron detalles para la venta....!</strong>
                                        </div>
                                    </div>
<?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="panel-body">
                            <form action="detrecep_control.php" method="get"
                                  role="form" class="form-horizontal">
                                <input type="hidden" name="accion" value="1">
                                <input type="hidden" name="vcod"
                                       value="<?php echo $_REQUEST['vcod'] ?>">
                                <input type="hidden" name="pagina"
                                       value="detrecep_agregar.php">
                                
                                
                                <div class="form-group">
                                    <label class="col-md-4  control-label">Equipo:</label>
                                    <div class="col-md-4">
                                        <?php $equipos = consultas::get_datos("select * from equipo order by id_equi asc"); ?>
                                        <select name="vequi" class="form-control select2">
                                            <?php 
                                            if (!empty($equipos)) {
                                                foreach ($equipos as $equipo) {
                                                    ?>
                                            <option value="<?php echo $equipo['id_equi']; ?>">
                                                    <?php echo $equipo['equi_descri']." - ". $equipo['equi_tipo']; ?></option>
                                            <?php
                                                }
                                            }else {
                                                ?>
                                            <option value="0">Debe ingresar un Equipo</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                               
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">DESCRIPCION:</label>
                                    <div class=" col-md-4">
                                        <textarea type="text" required="" 
                                               placeholder="Ingrese una descripcion" 
                                               class="form-control" name="vdescri" rows="3"></textarea>
                                    </div>
                                </div>
                                
                                <br>
                                
                                <div class="form-group">
                                <div class="col-md-offset-4 col-md-10">
                                    <button class="btn btn-success"
                                            type="submit">
                                        <i class="fa fa-floppy-o">

                                        </i> Grabar</button>
                                </div>
                            </div>
                            
                            
                        </form>
                    </div>

                </div>
                

                
            </div>
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
</div>
</div>

            
        <!--archivos js-->  
<?php require 'menu/js.ctp'; ?>
        <script>
            function articulos() {
                if (parseInt($('#depo').val()) > 0) {
                    $.ajax({
                        type: 'GET',
                        url: "/bulls/lista_articulos.php?vdep="
                                + $('#depo').val(),
                        cache: false,
                        beforeSend: function () {
                            $('#detalles').
                                    html('<img src="/bulls/img/cargando.GIF">\n\
                                            <strong><i>Cargando...</i></strong>');
                        },
                        success: function (msg) {
                            $('#detalles').html(msg);
                            obtenerprecio();
                        }
                    });
                }
            }
            function obtenerprecio() {
                var dat = $('#artic').val().split("_");
                if (parseInt($('#artic').val()) > 0) {
                    $.ajax({
                        type: 'GET',
                        url: "/bulls/lista_precios.php?vart="
                               +dat[0] +'&vdep=' + $('#depo').val(),
                        cache: false,
                        beforeSend: function () {
                            $('#precio').
                                    html('<img src="/bulls/img/cargando.GIF">\n\
                                    <strong><i>Cargando...</i></strong>');
                                    },
                            success: function (msg) {
                                calsubtotal();
                            $('#precio').html(msg);
                                            }
                    });
                }
            }
                        

        </script>      
        <script>
            function calsubtotal() {
                var dat = $('#artic').val().split("_");
                $('#subtotal').val(parseInt(dat[1]) * parseInt($('#cant').val()));
            }
            </script>   
            <script>
                function stock() {
                    var cant = parseInt($('#cantstock').val());
                    if(cant > 0) {
                        if (parseInt($('#cant').val()) > cant) {
                            alert('SOLO HAY '+ cant +
                                    'EN STOCK ESTE PRODUCTO');
                            $('#cant').val(cant);
                        }
                    } else{
                        $('#cant').val('0');
                    }
                }
</script>  

<script>
    function borrar(datos) {
        var dat = datos.split("_");
        $('#si').attr('href',
        'detrecep_control.php?vcod=' + dat[0] +
                
                '&vdescri=' + dat[1] +
                '&vequi=' + dat[2]+
                '&accion=2' +
                '&pagina=detrecep_agregar.php');
        $('#confirmacion').html
        ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
        Desea borrar el detalle?');
    }
</script>
    
    
    </body>
</html>
