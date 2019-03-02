<?php
session_start();

require './clases/conexion.php';

$stocks = consultas::get_datos("select * from v_stock where cod_depo = " . $_REQUEST['vdep']);
?>

<select class="form-control" name="varti" id="arti" onchange="obtenerprecio()" onkeyup="obtenerprecio()" required="">
    <?php
    if (!empty($stocks)) {
        foreach ($stocks as $stock) {
            ?>
            <option value="<?php echo $stock['id_articulo'] . "_" . $stock['precio_art']; ?>">
            <?php echo $stock['descri_art'] ?></option>
            <?php
        }
    } else {
        ?>
        <option>Debe insertar al menos un articulo</option>
<?php }; ?>
</select>
