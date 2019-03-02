<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_presupuesto_compras(".$_REQUEST['accion'].","
        .$_REQUEST['vpresu'].","
        .$_REQUEST['vtotal'].",'"
        .$_REQUEST['vfecha']."',"
        .$_REQUEST['vprov'].","
        .$_REQUEST['vusu'].",'"
        .$_REQUEST['vestado']."',"
        .$_REQUEST['vped']. ") as presupuesto_compras;";
        
$resultado = consultas::get_datos($sql);

if ($resultado[0]['presupuesto_compras']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['presupuesto_compras']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
        

