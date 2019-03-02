<?php
session_start();

require './clases/conexion.php';

$stocks = consultas::get_datos("select * from v_stock where cod_depo = " . $_REQUEST['vdep']);
?>

<select class="form-control" name="varti" id="artic" onchange="obtenerprecio1()" onkeyup="obtenerprecio1()" required="">
    <?php
    if (!empty($stocks)) {
        foreach ($stocks as $stock) {
            ?>
            <option value="<?php echo $stock['id_articulo'] . "_" . $stock['art_precio']; ?>">
            <?php echo $stock['art_descri'] ?></option>
            <?php
        }
    } else {
        ?>
        <option>Debe insertar al menos un articulo</option>
<?php }; ?>
</select>
