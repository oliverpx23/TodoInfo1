<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_timpuesto(".$_REQUEST['accion'].","
        .$_REQUEST['vtimp_cod'].",'"
        .$_REQUEST['vtimp_por']."','"
        .$_REQUEST['vtimp_nom']."') as tipo_impuesto;";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['tipo_impuesto']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['tipo_impuesto']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
        



