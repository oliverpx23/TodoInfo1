<?php
session_start();

require './clases/conexion.php';

$stocks = consultas::get_datos("select * from v_stock where id_articulo = " . $_REQUEST['vart']." and cod_depo = " . $_REQUEST['vdep']);
?>
    <?php if (!empty($stocks)) { ?>
    <input type="number" required="" placeholder="Precio del articulo"
           class="form-control" name="vprecio" id="precio"
           value="<?php echo $stocks[0]['art_precio'] ?>"
           readonly="" onchange="calsubtotal">
    <input type="hidden" name="cantidad" value="<?php echo $stocks[0]['stock_cantidad'] ?>"
           id="cantstock">
    
    <?php }else {?>
    
    <?php } ?>         