<?php
session_start();

require './clases/conexion.php';

$costos = consultas::get_datos("select * from v_articulos where id_articulo =".$_REQUEST['varticulo']);
?>
<input type="number" required="" id="costo" readonly="" 
    placeholder="Ingrese Precio"
    class="form-control" name="vprecio" value="<?= $costos[0]['art_precio'] ?>">