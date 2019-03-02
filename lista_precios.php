<?php
session_start();

require './clases/conexion.php';

$stocks = consultas::get_datos("select * from v_stock where id_articulo = " . $_REQUEST['varti']." and cod_depo = " . $_REQUEST['vdep']);
?>
    <?php if (!empty($stocks)) { ?>
    <input type="number" required="" placeholder="Precio del articulo"
           class="form-control" name="vprecio" id="precio"
           value="<?php echo $stocks[0]['precio_art'] ?>"
           readonly="" onchange="calsubtotal">
    <input type="hidden" name="cantidad" value="<?php echo $stocks[0]['cantidad'] ?>"
           id="cantstock">
    
    <?php }else {?>
    
    <?php } ?>         