<!DOCTYPE html>
<html>
    <head>
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
        <style>
            #imagenFlotante {

                right: 1%;
                bottom: 1%;
                position: fixed;
                _position:absolute;
                clip:inherit;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <?php require 'menu/navbar.php'; ?><!--BARRA DE HERRAMIENTAS-->
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Registar Cobros  
                            <a href="cobros.php" 
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
                        <div class="panel-body" style="border-top-style: hidden;border-right-style: double;border-bottom-style: double;border-left-style: double; border-color: buttonface; border-radius: 15px;width:1200px">
                            <form action="cobros_control.php" method="post" id='formLevantar' role="form" class="form-horizontal">
                                <input type="hidden" name="accion" id="accion" value="1">
                                <input type="hidden" name="vcod" id="vcod" value="0">
                                <input type="hidden" name="vape" id="vape" value="<?= $_SESSION['idapertura'] ?>">
                                <input type="hidden" name="pagina" id="pagina" value="cobros.php">
                                <input type="hidden" name="estado" id="estado" value="ACTIVO">
                                <fieldset>
                                    <div class="form-group">
                                        <div class="col-md-3">
                                            <label for="nrofactura" class="control-label">Fecha de Cobro</label>
                                            <input type="date" class="form-control" name="fecha" value="<?php echo date("Y-m-d"); ?>" id="fecha" disabled="">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="sed" class="control-label">Sucursal</label>
                                            <select class="form-control chosen-select2" name="sede" required="" id="sucursal">
                                                <?php $sucursales = consultas::get_datos("select * from sucursal"); ?> 
                                                <?php foreach ($sucursales as $sucursal) { ?>
                                                    <option value="<?php echo $sucursal['cod_suc']; ?>"><?php echo $sucursal['nombre_suc']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="sed" class="control-label">Cliente</label>
                                            <select class="form-control chosen-select2" name="idcliente" required="" id="idcliente" onchange="getCuentas();">
                                                <?php $clientes = consultas::get_datos("select * from v_clientes"); ?> 
                                                <?php foreach ($clientes as $cliente) { ?>
                                                    <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['cliente']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" name="detallecobro" id="detallecobro">
                                    <input type="hidden" class="form-control" name="totalcobrar" id="totalcobrar" value="0">                        
                                    <input type="hidden" class="form-control" name="detallecheque" id="detallecheque">
                                    <input type="hidden" class="form-control" name="detalletarjeta" id="detalletarjeta">
                                    <input type="hidden" class="form-control" name="totalcheques" id="totalcheques" value="0"> 
                                    <input type="hidden" class="form-control" name="totaltarjetas" id="totaltarjetas" value="0"> 
                                    <br><br>
                                    <div class="panel panel-primary">
                                        <div class="panel-heading"><strong>Detalles</strong></div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="col-sm-1">
                                                    <label for="cuentas" class="control-label">Cuentas</label>
                                                </div>
                                                <div class="col-sm-5">
                                                    <select class="form-control chosen-select2" name="cuentas" id="cuentas" onchange="cuentaselect();" onblur="cuentaselect();" required="">

                                                    </select>
                                                    <div id="prog"></div>
                                                </div>

                                                <div class="col-sm-1">
                                                    <label for="saldo" class="control-label">Saldo</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="number" class="form-control" min="1" name="saldo" id="saldo" required="" autofocus="">
                                                </div>
                                            </div>
                                        </div>
                                        <table class="table" id="grilladetalle">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;">#Cuota</th>
                                                    <th style="text-align: center;">Descripcion</th>
                                                    <th style="text-align: center;">Vencimiento</th>
                                                    <th style="text-align: right;">Monto</th>
                                                    <th style="text-align: right;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>

                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="panel panel-info">
                                        <div class="panel-heading"><strong>Formas de Cobros</strong> <span class="label label-primary right-block" id="lbtotalcobrado" style="padding-left: 5px; padding-right: 5px; font-size: large;">0</span></div>
                                        <div class="panel-body">
                                            <div class="panel-group" id="acordeon">
                                                <div class="panel panel-warning">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#acordeon" href="#cobroefectivo">Cobro en Efectivo <span class="label label-success right-block" id="lbmontoefe" style="background-color: green; color: white; padding-left: 5px; padding-right: 5px; font-size: medium;">0</span></a>
                                                        </h4>
                                                    </div>
                                                    <div id="cobroefectivo" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <div class="form-group">
                                                                <div class="col-sm-2">
                                                                    <label for="efectivo" class="control-label">Efectivo</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <input min="1" type="number" class="form-control" name="efectivo" id="efectivo" value="0" onkeyup="calcularVuelto();validar();">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-warning">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#acordeon" href="#cobrocheque">Cobro con Cheques <span class="label label-success right-block" id="lbmontocheque" style="background-color: green; color: white; padding-left: 5px; padding-right: 5px; font-size: medium;">0</span></a>
                                                        </h4>
                                                    </div>
                                                    <div id="cobrocheque" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <div class="form-group">
                                                                <div class="col-sm-2">
                                                                    <label class="control-label">Cheque</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <input min="1" type="number" class="form-control" name="importech" id="importech" value="0" onkeyup="calcularVuelto();validar();">
                                                                </div>
                                                            </div> 
                                                            
                                                            <div class="form-group">
                                                                <div class="col-sm-2">
                                                                    <label class="control-label">Banco</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <select class="form-control chosen-select2" name="banco" required="" id="banco">
                                                <?php $bancos = consultas::get_datos("select * from banco"); ?> 
                                                <?php foreach ($bancos as $banco) { ?>
                                                    <option value="<?php echo $banco['cod_banco']; ?>"><?php echo $banco['nombre_banco']; ?></option>
                                                <?php } ?>
                                            </select>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <div class="col-sm-2">
                                                                    <label class="control-label">Nro Cheque</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <input min="1" type="number" class="form-control" name="nrocheque" id="nrocheque" value="0" onkeyup="calcularVuelto();">
                                                                </div>
                                                            </div> 
                                                             
                                                            <div class="form-group">
                                                                <div class="col-sm-2">
                                                                    <label class="control-label">Fecha Cobro</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <input type="date" class="form-control" name="fechacobro" value="<?php echo date("Y-m-d"); ?>" id="fechacobro">
                                                                </div>
                                                            </div> 
                                                            <div class="form-group">
                                                                <div class="col-sm-2">
                                                                    <label class="control-label">Titular</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <input min="1" type="text" class="form-control" name="titular" id="titular" value="" onkeyup="calcularVuelto();">
                                                                </div>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-warning">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#acordeon" href="#cobrotarjeta">Cobro con Tarjetas <span class="label label-success right-block" id="lbmontotarjeta" style="background-color: green; color: white; padding-left: 5px; padding-right: 5px; font-size: medium;">0</span></a>
                                                        </h4>
                                                    </div>
                                                    <div id="cobrotarjeta" class="panel-collapse collapse">
                                                        <div class="panel-body">

                                                            <div class="form-group">
                                                                <div class="col-sm-1">
                                                                    <label class="control-label">Tarjeta</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <input min="1" type="number" class="form-control" name="importarj" id="importarj" value="0" onkeyup="calcularVuelto();validar()">
                                                                </div>                                                                                                                                        
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-1">
                                                                    <label class="control-label">Nro Tarjeta</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <input min="1" type="number" class="form-control" name="nrotarjeta" id="nrotarjeta" value="0" onkeyup="calcularVuelto();">
                                                                </div>                                                                                                                                        
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <div class="col-sm-1">
                                                                    <label class="control-label">Tipo Tarjeta</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <select class="form-control chosen-select2" name="tipotarjeta" required="" id="tipotarjeta">
                                                <?php $tarjetas = consultas::get_datos("select * from tarjeta"); ?> 
                                                <?php foreach ($tarjetas as $tarjeta) { ?>
                                                    <option value="<?php echo $tarjeta['id_tarjeta']; ?>"><?php echo $tarjeta['tarj_tipo']; ?></option>
                                                <?php } ?>
                                            </select>
                                                                    
                                                                </div>                                                                                                                                        
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <div class="col-sm-1">
                                                                    <label class="control-label">Entidad Emisora</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <select class="form-control chosen-select2" name="entidademisora" required="" id="entidademisora">
                                                <?php $entidad_emisoras = consultas::get_datos("select * from entidad_emisoras"); ?> 
                                                <?php foreach ($entidad_emisoras as $entidad_emisora) { ?>
                                                    <option value="<?php echo $entidad_emisora['id_entidad']; ?>"><?php echo $entidad_emisora['ent_descripcion']; ?></option>
                                                <?php } ?>
                                            </select>
                                                                    
                                                                </div>                                                                                                                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div id='imagenFlotante'  style="text-align: right;">
                                    <div class="panel panel-danger" style="padding-top: 10px; font-size: x-large;">

                                        <p class="label label-success center-block" id="lbvuelto"><strong>Faltan</strong></p>
                                        <p class="label label-danger center-block" id="vuelto"><strong>0</strong></p>

                                    </div>
                                    <button  class="btn btn-lg btn-info" role="button" data-title="Grabar"  type="button" 
                                             id="grabar" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon glyphicon-floppy-disk"></span></button>
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
            $(document).ready(function () {
                $('#cuentas').keypress(function (e) {
                    if (e.which === 13) {
                        $('#saldo').select();
                    }
                });
                $('#saldo').keypress(function (e) {
                    if (e.which === 13) {
                        var cta = $('#cuentas').val();
                        var cuentas = cta.split('_');
                        var sal = parseInt($('#saldo').val());
                        var repetido = false;
                        var cov = 0;
                        var coc = 0;
                        var contador = 0;
                        if (parseInt(cuentas[1]) < sal) {
                            notificacion('Atención', 'EL MONTO INGRESADO SUPERA EL SALDO DE LA CUENTA', 'error');
                        } else if (sal < 0) {
                            notificacion('Atención', 'INGRESO NUMERO NEGATIVO', 'error');
                        } else {
                            $("#grilladetalle tbody tr").each(function (index) {
                                $(this).children("td").each(function (index2) {
                                    if (index2 === 0) {
                                        cov = $(this).text();
                                    }
                                    if (index2 === 1) {
                                        coc = $(this).text();
                                    }
                                    if (cov === cuentas[0] && coc === cuentas[3]) {
                                        repetido = true;
                                    }

                                });
                            });

                            if (!repetido) {
                                $('#grilladetalle > tbody:last').append('<tr class="ultimo"><td style="text-align: center;">' + cuentas[0] +
                                        '</td><td style="text-align: center;">' + cuentas[3] +
                                        '</td><td style="text-align: center;">' + cuentas[2] +
                                        '</td><td style="text-align: right;">' + sal.toLocaleString() +
                                        '</td><td style="text-align: right;" onclick="eliminarfila($(this).parent(), ' + cuentas[1] + ')">\n\
                                <button type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></button></td></tr>');
                                contador++;
                            } else {
                                notificacion("Atención", "ESTA CUENTA YA FUE SELECCIONADA", "error");
                            }
                            calcularTotales();
//                            calcularVuelto();
                        }
                    }
                });
                getCuentas();
            });
            function getCuentas() {
                var cli = $('#idcliente').val();
                var ajax_load = "<div class='progress'>" + "<div id='progress_id' class='progress-bar progress-bar-striped active' " +
                        "role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 45%'>" +
                        "Cargando...</div></div>";
                $("#prog").html(ajax_load);

                $.post("/TodoInfo/cuentas.php?vcli=" + cli).done(function (data) {
                    var ajax_load = "<div class='progress'>" + "<div id='progress_id' class='progress-bar progress-bar-striped active' " +
                            "role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>" +
                            "Completado</div></div>";
                    $("#prog").html(ajax_load);
                    setTimeout('$("#prog").html("")', 500);
                    $("#cuentas").html(data).trigger('chosen:updated');
                    cuentaselect();
                    $('#saldo').select();
                });
            }
            function cuentaselect() {
                var id = $("#cuentas").val();
                var dat = id.split("_");
                $("#saldo").val(dat[1]);
            }

            function calcularTotales() {
                var total = 0;
                $("#grilladetalle tbody tr").each(function (fila) {
                    $(this).children("td").each(function (col) {
                        if (col === 3) {
                            total += parseInt($(this).text().replace(/\./g, ''));
                        }
                    });
                });

                if (total <= 0) {
                    $("#idcliente").removeAttr("disabled").trigger("chosen:updated");
                } else {
                    $("#idcliente").attr("disabled", "true").trigger("chosen:updated");
                }

                var totales = "<tr>";

                totales += "<tr>";
                totales += "<th class='danger' colspan='3'><h4>TOTAL GENERAL</h4></th>";
                totales += "<th class='danger' style='text-align: right;'><h4>" + total.toLocaleString() + "</h4></th>";
                totales += "<th class='default'><h4></h4></th>";
                totales += "</tr>";
                $("#totalcobrar").val(total);
                $("#grilladetalle tfoot").html(totales);
                $("#vuelto").html(total.toLocaleString());
            }

            function calcularVuelto() {
                var acobrar = parseInt($("#totalcobrar").val());
                var efe = parseInt($("#efectivo").val());
                var totalch = parseInt($("#importech").val());
                var totaltar = parseInt($("#importarj").val());
                var totalcobrado = efe + totalch + totaltar;

                $("#lbmontoefe").html(efe.toLocaleString());
                $("#lbmontocheque").html(totalch.toLocaleString());
                $("#lbmontotarjeta").html(totaltar.toLocaleString());
                $("#lbtotalcobrado").html(totalcobrado.toLocaleString());
                

                var vuelto = acobrar - totalcobrado;

                if (vuelto <= 0) {
                    $("#vuelto").attr("class", "label label-success center-block");
                    $("#vuelto").html((vuelto * -1).toLocaleString());
                    $("#lbvuelto").html("Vuelto");
                } else {
                    $("#vuelto").attr("class", "label label-danger center-block");
                    $("#vuelto").html((vuelto).toLocaleString());
                    $("#lbvuelto").html("Faltan");
                }

            }
            function eliminarfila(parent, importe) {
                $(parent).remove();
//                calcularTotalCheque();
//                calcularTotalTarjeta();
                calcularVuelto();
                //cerar los montos
                var nuevoValor = parseInt($("#totalcobrar").val()) - parseInt(importe);
                console.log(nuevoValor);
                $("#lbmontocheque").html(0);
                $("#lbmontoefe").html(0);
                $("#lbmontotarjeta").html(0);
                $("#lbtotalcobrado").html(0);
                $("#vuelto").html(nuevoValor.toLocaleString());
                calcularTotales();
            }

            $('#grabar').click(function () {
                var faltante = $.trim($('#lbvuelto').text());
                if (faltante === 'Faltan') {
                    notificacion('Atención', 'DEBE COMPLETAR EL MONTO A PAGAR', 'error');
                } else {
                    grabar();
                }
            });

            function grabar() {
                var parametros = [];
                $('#grilladetalle  tbody tr').each(function (i, e) {
                    var tr = [];
                    $(this).find("td").each(function (index, element) {
                        var valor = $(element).text();
                        console.log(valor);
                        var td = {};
                        if (index !== 4) {
                            td[index] = valor,
                                    tr.push(td);
                        }
                    });
                    parametros.push(tr);
                });
                $.ajax({
                    url: "/TodoInfo/cobros_control.php",
                    data: {"detalle": parametros, "vcod": $("#vcod").val(), "fecha": $("#fecha").val(), "importe": $("#efectivo").val(),
                        "estado": $("#estado").val(), "accion": $("#accion").val(), "pagina": $("#pagina").val(), "vape": $("#vape").val(),
                    "banco": $("#banco").val(), "nrocheque": $("#nrocheque").val(), "fechacobro": $("#fechacobro").val(),
                    "importech": $("#importech").val(), "importarj": $("#importarj").val(), 
                    "tipotarjeta": $("#tipotarjeta").val(), "titular": $("#titular").val(), "nrotarjeta": $("#nrotarjeta").val(), "entidademisora": $("#entidademisora").val()
    },
                    type: "POST",
                    dataType: 'JSON',
                    beforeSend: function (xhr) {
                        $("#grabar").attr("disabled", "disabled");
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (data.success) {
                            setTimeout(function () {
                                window.location.href = "./cobros.php";
                            }, 3000);
                            notificacion("Atencion", data.mensaje, "success");
                        } else {
                            notificacion("Atencion", data.mensaje, "error");
                        }
                    },
                });
            }
            function ubicarCheque() {
                var impor = parseInt($('#importech').val());
                if (impor < 0) {
                    notificacion('Atención','EL MONTO DEBE SER POSITIVO', 'error');
                } else {
                    calcularTotalCheque();
                    //calcularVuelto();
                }
            }
            function ubicarTarj() {
                var impor = parseInt($('#importarj').val());
                if (impor < 0) {
                    notificacion('Atención','EL MONTO DEBE SER POSITIVO', 'error');
                } else {
                    calcularTotalTarjeta();
                    //calcularVuelto();
                }
            }
            function calcularTotalCheque() {
                var acobrar = parseInt($("#totalcobrar").val());
                var efe = parseInt($("#efectivo").val());
                var totalch = parseInt($("#importech").val());
                var totaltar = parseInt($("#importarj").val());
                var totalcobrado = efe + totalch + totaltar;
                $("#lbmontocheque").html(totalch.toLocaleString());
                $("#lbtotalcobrado").html(totalcobrado.toLocaleString());
                var vuelto = acobrar - efe - totalcobrado;
                if (vuelto <= 0) {
                    $("#vuelto").attr("class", "label label-success center-block");
                    $("#vuelto").html((vuelto * -1).toLocaleString());
                    $("#lbvuelto").html("Vuelto");
                } else {
                    $("#vuelto").attr("class", "label label-danger center-block");
                    $("#vuelto").html((vuelto).toLocaleString());
                    $("#lbvuelto").html("Faltan");
                }

            }
            function calcularTotalTarjeta() {
                var acobrar = parseInt($("#totalcobrar").val());
                var efe = parseInt($("#efectivo").val());
                var totalch = parseInt($("#importech").val());
                var totaltar = parseInt($("#importarj").val());
                var totalcobrado = efe + totalch + totaltar;
                $("#lbmontotarjeta").html(totaltar.toLocaleString());
                $("#lbtotalcobrado").html(totalcobrado.toLocaleString());
                var vuelto = acobrar - efe - totalcobrado;
                if (vuelto <= 0) {
                    $("#vuelto").attr("class", "label label-success center-block");
                    $("#vuelto").html((vuelto * -1).toLocaleString());
                    $("#lbvuelto").html("Vuelto");
                } else {
                    $("#vuelto").attr("class", "label label-danger center-block");
                    $("#vuelto").html((vuelto).toLocaleString());
                    $("#lbvuelto").html("Faltan");
                }
            }
            
            function validar(){
                
                var monto = ($("#efectivo").val());
                if(monto === ""){
                    $("#efectivo").val("0");    
                }
                
                 var monto = ($("#importech").val());
                if(monto === ""){
                    $("#importech").val("0");
                } 
                
                var monto = ($("#importarj").val());
                if(monto === ""){
                    $("#importarj").val("0");
                }     
            }
        </script>
    </body>
</html>
