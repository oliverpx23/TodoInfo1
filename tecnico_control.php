<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_orden_compra(".$_REQUEST['accion'].","
        .$_REQUEST['vcod'].","
        .$_REQUEST['vusu'].","
        .$_REQUEST['vprov'].",'"
        .$_REQUEST['vfecha']."',"
        .$_REQUEST['vtotal'].",'"
        .$_REQUEST['estado']."') as orden_compra;";
        
$resultado = consultas::get_datos($sql);

if ($resultado[0]['orden_compra']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['orden_compra']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>

