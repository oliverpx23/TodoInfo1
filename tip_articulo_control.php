<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_tarticulo(".$_REQUEST['accion'].","
        .$_REQUEST['vtart_cod'].",'".$_REQUEST['vtart_nom']."') as tipo_art;";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['tipo_art']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['tipo_art']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
        

