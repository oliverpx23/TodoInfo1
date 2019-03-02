<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/inf.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> TodoInfo</title>

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
                    <div class="col-lg-12">
                        <h3 class="page-header">Registar Cliente  
                            <a href="clientes_index.php" 
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
                        <div class="panel-body">
                            <form action="clientes_control.php" method="post" 
                                  role="form" class="form-horizontal">
                                <input type="hidden" name="accion" value="1">
                                <input type="hidden" name="vcod" value="0">
                                <input type="hidden" name="pagina" value="clientes_index.php">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Nro de CI:</label>
                                    <div class="col-md-5">
                                        <input type="text" required="" 
                                               placeholder="Ingrese nro de ci"  
                                               class="form-control" id="ci" name="vci" autofocus=""
                                               onchange="nronegativo()"
                                               onkeyup="nronegativo()"
                                               
                                               >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Nombre:</label>
                                    <div class="col-md-5">
                                        <input type="text" required="" placeholder="Ingrese nombre"  
                                               class="form-control" id="nom" name="vnombre"
                                                 onchange="reemplazar()"
                                                 onkeyup="reemplazar()">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Apellido:</label>
                                    <div class="col-md-5">
                                        <input type="text" required="" 
                                               placeholder="Ingrese apellido"
                                               class="form-control" name="vapellido"
                                               onchange="reemplazar()"
                                               onkeyup="reemplazar()">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Fecha Nac.:</label>
                                    <div class="col-md-5">
                                        <input type="date" required="" id="fec"
                                               placeholder="Ingrese fecha nacimiento"  
                                               class="form-control"
                                               name="vfecnac"
                                               onchange="validar()"
                                               onkeyup="validar()"
                                               onmouseup="validar()"
                                               onclick="validar()"
                                               onkeypress="validar()">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Sexo:</label>
                                    <div class="row">
                                        <div class="radio col-md-8">
                                            <label>
                                                <input type="radio" name="sexo" value="M"> Masculino
                                            </label>
                                            <label>
                                                <input type="radio" name="sexo" value="F"> Femenino
                                            </label>                                       
                                        </div>
                                    </div>                                  
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Dirección:</label>
                                    <div class="col-md-8">
                                        <input type="text" required="" 
                                               placeholder="Ingrese dirección" 
                                               class="form-control" name="vdirec">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Telefono:</label>
                                    <div class="col-md-5">
                                        <input type="text" required="" 
                                               placeholder="Ingrese telefono" 
                                               class="form-control" name="vtel">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Departamento:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $departamentos = consultas::get_datos("select * from departamentos "
                                                        . " order by id_departamento");
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
                                                <option value="0">Debe insertar un departamento</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Pais:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $paises = consultas::get_datos("select * from pais "
                                                        . " order by cod_pais");
                                        ?>                                 
                                        <select name="vpais" class="form-control select2">
                                            <?php
                                            if (!empty($paises)) {
                                                foreach ($paises as $pais) {
                                                    ?>
                                                    <option value="<?php echo $pais['cod_pais']; ?>">
                                                        <?php echo $pais['descri_pais']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un pais</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Ciudad:</label>
                                    <?php $ciudades = consultas::get_datos("select * from ciudad order by id_ciudad"); ?>
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
      <script>
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
            function nronegativo() {

                var numero = document.getElementById("ci").value;
                if (numero.match(/^-?[0-9]+(\.[0-9]{1,2})?$/))
                {
                   
                }
                else
                {
                    alert("No se permite caracteres negativos");
                    document.getElementById("ci").value="";
                }
            }
        </script>
        <script>
            function reemplazar(){
            var res = document.getElementById("nom").value.replace("'","");
            document.getElementById("nom").value = res;
//            alert(res);
            }
        </script>
    </body>
</html>
