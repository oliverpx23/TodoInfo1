<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_proveedor(".$_REQUEST['accion'].","
        .$_REQUEST['vcod'].",'"
        .$_REQUEST['vruc']."','"
        .$_REQUEST['vnombre']."','"
        .$_REQUEST['vtel']."','"
        .$_REQUEST['vdirec']."') as proveedor;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['proveedor']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['proveedor']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
        

