<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_marca(".$_REQUEST['accion'].","
        .$_REQUEST['vmar_cod'].",'".$_REQUEST['vmar_nom']."') as marcas;";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['marcas']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['marcas']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
        

