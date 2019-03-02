<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>TIENDA INFORMATICA</title>

        <?php
        require './ver_sesion.php';
        require 'menu/css.php';
        ?>

    </head>
    <body>
        <div id="wrapper">
            <?php require 'menu/navbar.php'; ?><!--BARRA DE HERRAMIENTAS-->
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Registar Detalle Nota de credito  
                            <a href="nota_credito_index.php" 
                                class="btn btn-primary btn-circle pull-right" 
                                rel='tooltip' title="Atras">
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a> 
                        </h3>
                    </div>                       
                </div>
                
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Datos cabecera
                            </div>
                            <?php
                            $notacreditos = consultas::get_datos
                                    ("select * from v_notacredito where notacredi_cod=".$_REQUEST['vnota']
                                    ." order by notacredi_cod");
                            ?>
                            <div class="panel-body">
                                <div class="table-responsive">                          
                                    <table width="100%" 
                                           class="table table-bordered">
                                        <thead>
                                            <tr class="success">                        
                                                <th class="text-center"># Venta</th>
                                                <th class="text-center">Cliente</th>
                                                <th class="text-center">TOTAL Nota</th>                                                     
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($notacreditos as $notacredito) { ?> 
                                                <tr>
                                                    <td class="text-center">
                                                        <?php echo $notacredito['ven_cod']; ?></td>
                                                    <td class="text-center">
                                                        <?php echo $notacredito['cliente']; ?></td>
                                                    <td class="text-center">
                                                        <?php echo $notacredito['notacredi_monto']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Datos Venta
                            </div>
                            <?php
                            $ventas = consultas::get_datos
                                    ("select * from v_detventa where ven_cod=".$_REQUEST['vven']
                                    ." order by ven_cod");
                            ?>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <?php if(!empty($ventas)) { ?>
                                    <table width="100%" 
                                           class="table table-bordered">
                                        <thead>
                                            <tr class="success">                        
                                                <th class="text-center">Insumo</th>
                                                <th class="text-center">Cantidad</th>
                                                <th class="text-center">Precio unitario</th>
                                                <th class="text-center">Total</th>                                                     
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ventas as $venta) { ?> 
                                                <tr>
                                                    <td class="text-center">
                                                        <?php echo $venta['insu_descr']; ?></td>
                                                    <td class="text-center">
                                                        <?php echo $venta['cantidad']; ?></td>
                                                    <td class="text-center">
                                                        <?php echo $venta['precio_unitario']; ?></td>
                                                    <td class="text-center">
                                                        <?php echo $venta['total']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php } else { ?>
                                            <br>
                                            <div class="col-md-12">
                                                <div class="alert alert-info 
                                                     alert-dismissable">
                                                    <button type="button" class="close" 
                                                            data-dismiss="alert" aria-hidden="true">&times;
                                                    </button>
                                                    <strong>No se encontraron datos del detalle de la venta....!</strong>
                                                </div>
                                            </div>
                                        <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                        <?php
                        $detnotas=  consultas::get_datos("select * from v_detnotacredito "
                                . "where notacredi_cod=".$_REQUEST['vnota']." order by notacredi_cod");
                        ?>
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        Detalle de la nota
                                    </div>
                                    <div class="table-responsive">   
                                        <?php if (!empty($detnotas)) { ?>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Insumo</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio unitario</th>
                                                        <th>Total</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($detnotas as $detnota) { ?> 
                                                        <tr>                                               
                                                            <td><?php echo $detnota['insu_descr']; ?></td>
                                                            <td><?php echo $detnota['detacredi_cant']; ?></td>
                                                            <td><?php echo $detnota['insu_precio']; ?></td>
                                                            <td><?php echo $detnota['detacredi_total']; ?></td>
                                                            <td>
                                                                <a onclick="borrar(<?php
                                                                    echo "'" . $detnota['insu_cod'] . "_" . 
                                                                    $_REQUEST['vnota'] . "_" .
                                                                    $detnota['detacredi_precio']."_".
                                                                    $detnota['detacredi_cant']."_".
                                                                    $detnota['detacredi_motivo']."_".$_REQUEST['vven']."'";?>)" 
                                                        
                                                                    class="btn btn-xs btn-danger" 
                                                                    rel='tooltip' data-title="Borrar"
                                                                    data-toggle="modal"
                                                                    data-target="#delete">
                                                                   <span class="glyphicon glyphicon-trash">                                                              
                                                                   </span>
                                                                </a>                                                                                                                         
                                                            </td>                                                    
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table> 
                                        <?php } else { ?>
                                            <br>
                                            <div class="col-md-12">
                                                <div class="alert alert-info 
                                                     alert-dismissable">
                                                    <button type="button" class="close" 
                                                            data-dismiss="alert" aria-hidden="true">&times;
                                                    </button>
                                                    <strong>No se encontraron detalles para la venta....!</strong>
                                                </div>
                                            </div>
                                        <?php } ?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel-body">
                            
                            <form action="notacredito_detalle_control.php" method="get"
                                  role="form" class="form-horizontal">
                                <input type="hidden" name="accion" value="1">
                                <input type="hidden" name="vtotal" value="0">
                                <input type="hidden" name="vnota" value="<?php echo $_REQUEST['vnota'] ?>">
                                <input type="hidden" name="vven" value="<?php echo $_REQUEST['vven'] ?>">
                                <input type="hidden" name="pagina" value="notacredito_detalle.php">
                                
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Insumo</label>
                                    <div class="col-md-4">
                                        <?php
                                        $equipos = consultas::get_datos("select * from insumo "
                                                        . " order by insu_cod");
                                        ?>                                 
                                        <select name="vinsu" class="form-control" id="insu" onchange="equipos()" onkeyup="equipos()">
                                            <option  value="">Seleccione un Insumo</option>
                                            <?php
                                            if (!empty($equipos)) {
                                                foreach ($equipos as $equipo) {
                                                    ?>
                                                    <option value="<?php echo $equipo['insu_cod']; ?>">
                                                        <?php echo $equipo['insu_descr']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un insumo</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                        <label class="col-md-2 control-label">Precio</label>
                                        <div class="col-md-4" id="detalles">
                                            <select class="form-control" required  name="vprecio">
                                                <option>Seleccione un precio</option>        
                                            </select>
                                        </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Cantidad</label>
                                    <div class="col-md-3">
                                        <input type="number" required="" id="cant" min="0"
                                               placeholder="Ingrese Cantidad"
                                               class="form-control" name="vcant"
                                               onchange="nronegativocant()" onkeyup="nronegativocant()">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                        <label class="col-md-2 control-label">Motivo</label>
                                        <div class="col-md-4">
                                            <textarea type="text" required="" 
                                              placeholder="Ingrese motivo"
                                              class="form-control" name="vmotivo" rows="3"> </textarea>
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

        </div> 
        <!--fin-->
        <!--archivos js-->   
        <?php require 'menu/js.php'; ?>

        <script>
            function equipos() {
            if (parseInt($('#insu').val()) > 0) {
                $.ajax({
                    type: "GET",
                    url: "/servicios/lista_insumo_nota.php?vinsu=" + $('#insu').val(),
                    cache: false,
                    beforeSend: function () {
                        $('#detalles').html('<img src="/servicios/img/ajax-loader.GIF">  \n\
                          <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#detalles').html(msg);
                    }
                });
            }
        }
            
            function nronegativo() {
                //ID numero puede ser un input text.
                var numero = document.getElementById("precio").value;
                //numero ahora es string
                if (numero.match(/^-?[0-9]+(\.[0-9]{1,2})?$/))
                {
                }
                else
                {
                    notificacion("Atención","No se permite numeros negativos ni letras", "error");
                    document.getElementById("precio").value = "";
                }
            }
            
            function nronegativocant() {
                //ID numero puede ser un input text.
                var numero = document.getElementById("cant").value;
                //numero ahora es string
                if (numero.match(/^-?[0-9]+(\.[0-9]{1,2})?$/))
                {
                }
                else
                {
                    notificacion("Atención","No se permite numeros negativos ni letras", "error");
                    document.getElementById("cant").value = "";
                }
            }
            
            function validar() {
                var hoy = new Date();
                var fechaFormulario = new Date($('#fec').val());
                if (fechaFormulario > hoy) {
                    alert('Fecha superior al actual!!!');
                    $('#fecha').val(hoy);
                    $('#fec').val(hoy);
                }
                else {

                }
            }
        </script>
        
        <script>
        function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href','notacredito_detalle_control.php?vnota=' + dat[1] +
                        '&vinsu=' + dat[0] +
                        '&vprecio=null' +
                        '&vcant=null' +
                        '&vmotivo=null' +
                        '&vtotal=null' +
                        '&accion=3' +
                        '&vven=' +dat[5]+
                        '&pagina=notacredito_detalle.php');
                $('#confirmacion').html
                        ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
           Desea Borrar el equipo?');
            }</script>
        
    </body>
</html>

