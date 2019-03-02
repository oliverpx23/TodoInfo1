<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_recepcion(".$_REQUEST['accion'].","
        .$_REQUEST['vcod'].",'".$_REQUEST['vdescri']."',".
        $_REQUEST['vcli'].",".$_REQUEST['vusu'].",".
        $_REQUEST['vsuc'].",'".$_REQUEST['vfecha']."','".
        $_REQUEST['vestado']."') as recepcion;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['recepcion']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['recepcion']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
        

