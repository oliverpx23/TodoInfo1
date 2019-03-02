<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_diagnostico(".$_REQUEST['accion'].","
        .$_REQUEST['vcod'].",'".$_REQUEST['vfecha']."',".
        $_REQUEST['vrecep'].",".$_REQUEST['vtecnico'].",".
        $_REQUEST['vsuc'].",'".$_REQUEST['vestado']."',".
        $_REQUEST['vtotal'].") as diagnostico;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['diagnostico']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['diagnostico']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
        

