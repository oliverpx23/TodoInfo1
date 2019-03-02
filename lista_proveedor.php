<?php
session_start();
require './clases/conexion.php';
$ordencompras = consultas::get_datos("select * from v_ordencompra "
        . " where id_orden_compra = " . $_REQUEST['vorden']);
?>
<select class="form-control" name="vprov"
        id="prov" onchange="obtenerprecio()"
        onkeyup="obtenerprecio()"
        required="">
            <?php
            if (!empty($ordencompras)){
                foreach ($ordencompras as $ordencompra){
                  ?>
    <option value="<?php echo $ordencompra['id_proveedor'];?>">
    <?php echo $ordencompra['proveedor']?></option>
    <?php 
                }
            }else{
                ?>
    <option>
        Debe insertar al menos un proveedor </option>
           <?php };?>
            
</select>


