<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_servicio(".$_REQUEST['accion'].","
        .$_REQUEST['vserv'].",".$_REQUEST['vtipserv'].",".
        $_REQUEST['vordtrab'].",'".$_REQUEST['vestado']."','".
        $_REQUEST['vfecha']."') as servicio;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['servicio']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['servicio']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
        

