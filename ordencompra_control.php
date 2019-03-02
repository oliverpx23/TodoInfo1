<?php
require './clases/conexion.php';
session_start();
$presupuesto = ($_REQUEST['vpresu']) ? $_REQUEST['vpresu'] : NULL;
$sql = "SELECT sp_orden_compras(".$_REQUEST['accion'].","
        .$_REQUEST['vorden'].",'"
        .$_REQUEST['vfecha']."','"
        .$_REQUEST['estado']."',"
        .$_REQUEST['vusu'].","
        .$_REQUEST['vprov'].","
        .$_REQUEST['vtotal'].","
        .$_REQUEST['vpresu'].") as orden_compra;";
        
$resultado = consultas::get_datos($sql);

if ($resultado[0]['orden_compra']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['orden_compra']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>

