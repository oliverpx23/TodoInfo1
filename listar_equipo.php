<?php
session_start();

require './clases/conexion.php';

$equipos = consultas::get_datos("select * from v_recepcion where id_recep = " . $_REQUEST['vrecep']);
?>

<select class="form-control" name="vequi" id="equi" onchange="obtenerprecio()" onkeyup="obtenerprecio()" required="">
    <?php
    if (!empty($equipos)) {
        foreach ($equipos as $equipo) {
            ?>
            <option value="<?php echo $equipo['id_equi']; ?>">
            <?php echo $stock['equi_descri'] ?></option>
            <?php
        }
    } else {
        ?>
        <option>Debe insertar al menos un articulo</option>
<?php }; ?>
</select>
