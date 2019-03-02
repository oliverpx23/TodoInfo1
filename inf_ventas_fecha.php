<?php require './clases/conexion.php'; 
        require './ver_sesion.php';
        require 'menu/css.ctp';
?>

<form accept-charset="utf8" class="form-horizontal">
    <input name="opcion" value="1" id="op" type="hidden"/>
    <div class="col-md-9 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                Informes de Ventas
            </a>              
        </div>   
        <div class="form-group col-md-12">
            <label class="col-sm-2 control-label">Desde:</label>
            <div class="col-md-4">
                 <input type="date" required="" placeholder="Especifique fecha" id="desde"  
                  class="form-control" value="<?php echo date("Y-m-d") ?>" 
                   name="vdesde">
            </div>
            <label class="col-sm-1 control-label">Hasta:</label>
            <div class="col-md-4">
                 <input type="date" required="" placeholder="Especifique fecha"  id="hasta"   
                 class="form-control" value="<?php echo date("Y-m-d") ?>" 
                  name="vhasta">
            </div>
            <div class="form-group col-md-1">
                <div class="col-md-1  pull-right">
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
        window.open("/bulls/imprimir_ventas.php?vdesde=" + $('#desde').val() 
                + '&vhasta='+$('#hasta').val()+
                '&vop=' + $('#op').val(), '_blank');
    }
</script>




