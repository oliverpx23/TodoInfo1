<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_usuarios(".$_REQUEST['accion'].","
        .$_REQUEST['vcod'].",'"
        .$_REQUEST['vnick']."','"
        .$_REQUEST['vclave']."','"
        .$_REQUEST['vnombre']."','"
        .$_REQUEST['vestado']."',"
        .$_REQUEST['vgrup'].",'"
        .$_REQUEST['vcodsuc']."') as usuarios;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['usuarios']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['usuarios']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
        
