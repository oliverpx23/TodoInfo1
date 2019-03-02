<?php require './clases/conexion.php'; 
        require './ver_sesion.php';
        require 'menu/css.ctp';
?>

<form accept-charset="utf8" class="form-horizontal">
    <input name="opcion" value="3" id="op" type="hidden"/>
    <div class="col-md-6 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                Informes de Proveedores
            </a>              
        </div>   
        <div class="form-group col-md-12">
            <label class="col-sm-4 control-label">Condición:</label>
            <div class="col-sm-6">
                <?php $compras = consultas::get_datos("select * from v_compras order by comp_condicion"); ?>                                                                 
                <select name="vpag" class="form-control select2" id="vcondicion">
                    <option value="CONTADO">CONTADO</option>
                    <option value="CREDITO">CREDITO</option> 
                </select>
            </div>
            <div class="form-group col-md-1">
                <div class="col-sm-1  pull-right">
                    <a onclick="enviar()" rel="tooltip" data-title="Imprimir"
                       class="btn btn-primary" role="button">
                        <span class="fa fa-print"> </span></a>  
                </div>
            </div>
        </div> 

    </div> 
</form>
<?php require 'menu/js.ctp'; ?>

<script>
    function enviar() {
        window.open("/bulls/imprimir_compras.php?vcondicion=" + $('#vcondicion').val() + 
                '&vop=' + $('#op').val(), '_blank');
    }
</script>




