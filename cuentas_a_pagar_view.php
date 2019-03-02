<?php
session_start();

require './clases/conexion.php';
//
$ctaspagar = consultas::get_datos("select *from v_ctas_pagar where id_proveedor = " . $_REQUEST['vprov']);
if($ctaspagar){
foreach ($ctaspagar as $cuotap) {?>
    <option value="<?php echo $cuotap['cta_id'] . '_' . $cuotap['cta_importe'] . '_' . $cuotap['cta_vto'] . '_'. $cuotap['descripcion'] .'_'.$cuotap['nrocuota'] ; ?>"><?= $cuotap['descripcion']." | "." Monto: ".  $cuotap['cta_importe'] ?></option>
<?php } 
}else{?>
 <option value="0">No existen cuentas</option>
<?php }?>

