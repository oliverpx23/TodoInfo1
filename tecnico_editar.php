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
                        <h3 class="page-header">Listado de Técnico 
                            <a href="clientes_index.php" 
                             class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Atras" >
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a>                    
                        </h3>
                    </div>     
                    <!--Buscador-->
                    <div class="col-lg-12">
                        <div class="panel-body">
                            <?php $cliente= consultas::get_datos
                                    ("select * from clientes where id_cliente=".$_REQUEST['vcod']) ?>
                            <form action="clientes_control.php" method="post" role="form"class="form-horizontal">
                                <input type="hidden" name="accion" value="2">
                                <input type="hidden" name="vcod"
                                       value="<?php echo $cliente[0]['id_cliente']; ?>">
                                <input type="hidden" name="pagina" value="clientes_index.php">
                                <div class="form-group">
                                    <label class="col-md-2 control-label"> Nro de Ci:</label>
                                    <div class="col-md-5">
                                        <input type="text" required="" placeholder="Ingrese Numero de Ci"
                                               class="form-control"
                                               name="vci" value="<?php echo $cliente[0]['cli_ci'];?>" autofocus="">
                                               </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Nombre:</label>
                                    <div class="col-md-5">
                                   <input type="text" required="" placeholder="Ingrese nombre"  
                                          pattern="[A-Za-z]{5,40}" title="Ingresa sólo letras. Tamaño mínimo: 5. Tamaño máximo: 40"
                                           class="form-control" name="vnombre"
                                   value="<?php echo $cliente[0]['cli_nombre'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Apellido:</label>
                                    <div class="col-md-5">
                                    <input type="text" required="" 
                                           placeholder="Ingrese apellido"
                                           pattern="[A-Za-z]{5,40}" title="Ingresa sólo letras. Tamaño mínimo: 5. Tamaño máximo: 40"
                                             class="form-control" name="vapellido"
                                             value="<?php echo $cliente[0]['cli_apellido'];?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Fecha Nac.:</label>
                                    <div class="col-md-5">
                                        <input type="date" required=""
                                          placeholder="Ingrese fecha nacimiento"  
                                          class="form-control"
                                          name="vfecnac"
                                          value="<?php echo $cliente[0]['cli_fnac'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Sexo:</label>
                                  <div class="row">
                                    <div class="radio col-md-8">
                                        <?php if ($cliente[0]['cli_sexo'] == 'M'){?>
                                        <label>
                                            <input type="radio" name="sexo" value="M" checked=""> Masculino
                                        </label>
                                        
                                        <label>
                                            <input type="radio" name="sexo" value="F"> Femenino
                                        </label> 
                                         <?php }else{ ?>
                                        <label>
                                            <input type="radio" name="sexo" value="F" checked="">Masculino
                                        <label>
                                            <input type="radio" name="sexo" value="F" checked=""> Femenino
                                        </label> 
                                         <?php }?>
                                    </div>
                                  </div>                                  
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Dirección:</label>
                                    <div class="col-md-8">
                                        <input type="text" required="" 
                                               placeholder="Ingrese dirección" 
                                               class="form-control" name="vdirec"
                                               value="<?php echo $cliente[0]['cli_direccion'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Telefono:</label>
                                    <div class="col-md-5">
                                        <input type="text" required="" 
                                               placeholder="Ingrese telefono" 
                                               class="form-control" name="vtel"
                                               value="<?php echo $cliente[0]['cli_telefono'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Departamento:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $departamentos = consultas::get_datos("select * from departamento "
                                                        . " order by id_departamento=".$cliente[0]['id_departamento']."desc");
                                        ?>                                 
                                        <select name="vdepar" class="form-control select2">
                                            <?php
                                            if (!empty($departamentos)) {
                                                foreach ($departamentos as $departamento) {
                                                    ?>
                                                    <option value="<?php echo $departamento['id_departamento']; ?>">
                                                        <?php echo $departamento['dep_descri']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un departamento:</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Ciudad:</label>
                                    <?php $ciudades = consultas::get_datos("select * from ciudad order by id_ciudad=".$cliente[0]['id_ciudad']."desc"); ?>
                                    <div class="col-md-3">
                                        <select name="vciu" class="form-control select2" >
                                            <?php
                                            if (!empty($ciudades)) {
                                                foreach ($ciudades as $ciudad) {
                                                    ?>
                                                    <option value="<?php echo $ciudad['id_ciudad']; ?>">
                                                        <?php echo $ciudad['ciu_descri']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar una ciudad</option>
                                            <?php } ?>    
                                        </select>
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

                                               