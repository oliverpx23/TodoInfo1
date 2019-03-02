<?php
session_start();

require './clases/conexion.php';
//
$ctas = consultas::get_datos("select *from v_ctas where id_cliente = " . $_REQUEST['vcli']);
if($ctas){
foreach ($ctas as $cuota) {?>
    <option value="<?php echo $cuota['cta_id'] . '_' . $cuota['cta_importe'] . '_' . $cuota['cta_vto'] . '_'. $cuota['descripcion'] .'_'.$cuota['nrocuota'] ; ?>"><?= $cuota['descripcion']." | "." Monto: ".  $cuota['cta_importe'] ?></option>
<?php } 
}else{?>
 <option value="0">No existen cuentas</option>
<?php }?>

