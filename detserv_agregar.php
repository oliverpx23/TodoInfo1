<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/blackbulls.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>BBG - SERVICIOS</title>

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
                        <h3 class="page-header">Datos de Servicios 
                            <a href="servicio_index.php" 
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
                            $servicioss = consultas::get_datos("select * from v_servicio where id_servicio=" .
                                            $_REQUEST ['vserv'] . " order by id_servicio asc ");
                            ?>                         
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table width="100%"
                                           class="table table-bordered">
                                        <thead>
                                            <tr class="success">
                                                <th class="text-center">#</th>
                                                <th class="text-center">SERVICIO</th>                                        
                                                <th class="text-center">ESTADO</th>
                                                <th class="text-center">FECHA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($servicioss as $servicios) { ?> 
                                                <tr>
                                                    <td class="text-center">
                                                        <?php echo $servicios['id_servicio']; ?></td>
                                                    <td class="text-center">
                                                        <?php echo $servicios['servicio']; ?></td>
                                                    <td class="text-center">
                                                        <?php echo $servicios['estado']; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $servicios['fecha']; ?></td>
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
                                Detalle de Recepcion
                            </div>
                            <?php if (!empty($detreceps)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th># Recepcion</th>
                                                <th># Remera</th>
                                                <th>Descri. Remera</th>
                                                <th>Caracteristicas. Recepcion</th>
                                                <th>Imagen</th>
                                                <th>Cantidad</th>
                                                <th> Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($detreceps as $detrecep) { ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $detrecep['id_recep']; ?></td>
                                                    <td class="text-center"><?php echo $detrecep['id_remera']; ?></td>
                                                    <td><?php echo $detrecep['remera']; ?></td>
                                                    <td class="text-center"><?php echo $detrecep['det_recep_descrip']; ?></td>
                                                <td ><img height="45px" src="uploads/<?php echo $detrecep['det_recep_img']; ?>"/></td>
                                                    <td class="text-center"><?php echo $detrecep['det_rec_cant']; ?></td> <td>
                                                        <a onclick="borrar(<?php
                                                        echo "'" . $detrecep['id_remera'] . "_" .
                                                        $_REQUEST['vcod'] . "_" .
                                                        $detrecep['det_rec_cant'] . "_" .
                                                        $detrecep['det_recep_descrip'] . "_" .
                                                        $detrecep['det_recep_img'] . "'";
                                                        ?>)"

                                                           class="btn btn-xs btn-danger"
                                                           ret='tooltip' data-title="Borrar"
                                                           data-toggle='modal'
                                                           data-target='#delete'>
                                                            <span class="glyphicon glyphicon-trash">
                                                            </span>
                                                    </td>
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
                                    <label class="col-md-2 control-label">Remera:
                                    </label>
                                    <div class="col-md-4">
<?php $remeras = consultas::get_datos("select * from v_remera");
?>
                                        <select name="vreme"
                                                class="form-control" id="remera" required="">
                                            <option value="">Seleccione una remera</option>
                                            <?php
                                            if (!empty($remeras)) {
                                                foreach ($remeras as $remera) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $remera['id_remera']; ?>">
                                                    <?php echo $remera['remera']; ?>
                                                    </option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar una remera</option>
<?php } ?>
                                        </select>
                                    </div>
                                    
                                     <div class="form-group">
                                    <label class="col-md-2 control-label">Cantidad:</label>
                                    <div class="col-md-3">
                                        <input type="number" required=""
                                               placeholder="Especifique Cantidad"
                                               class="form-control"
                                               required min="1"  name="vcant"
                                               id="cant" value="0"
                                               onchange="solonumeros()"
                                               onkeyup="solonumeros()"
                                               autofocus="">
                                                
                                    </div>
                                </div>
                                    
                                </div>
                                
                               
                                
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Descripcion:</label>
                                    <div class="col-md-9">
                                        <input type="text" required=""
                                               placeholder="Ingrese descripcion"
                                               class="form-control" id="descri"
                                               name="vdescri"
                                            onchange="sololetras()"
                                              onkeyup="sololetras()"
                                              >
                                        
                                    </div>
                                  
                                </div>
                                <br>
                                
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Imagen:</label>
                                    <div class="col-md-4">
                                        <input class="form-control" type="file" name="vimagen" >
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="col-md-offset-5 col-md-10">
                                        <button class="btn btn-success"
                                                type="submi"><i class=" fa fa-floppy-o">
                                            </i>Grabar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

             borrar
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
                fin
            </div> 
        <!--archivos js-->  
<?php require 'menu/js.ctp'; ?>
         
       
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
   
      
             function sololetras() {
                var numero = document.getElementById("descri").value;
                if (numero.match(/^[a-z A-Z]+$/))
                {

                } else {
                    alert("Solo letras");
                    document.getElementById("descri").value ="";
                }
            }
                   
        </script>
        <script>
        function solonumeros() {
                var numero = document.getElementById("cant").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    alert("Solo numeros");
                    document.getElementById("cant").value = "";
                }
            }
            
                    </script>
<script>
    function borrar(datos) {
        var dat = datos.split("_");
        $('#si').attr('href',
        'detrecep_control.php?vcod=' + dat[1] +
                '&vreme=' + dat[0] +
                '&vcant=' + dat[2] +
                '&vdescri=' + dat[3]+
                '&vimagen=' + dat[4]
                +'&accion=3' +
                '&pagina=detrecep_agregar.php');
        $('#confirmacion').html
        ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
        Desea borrar el detalle?');
    }
</script>
    
    
    </body>
</html>
