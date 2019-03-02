<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_reclamos(".$_REQUEST['accion'].","
        .$_REQUEST['vrecla'].",".$_REQUEST['vserv'].",".
        $_REQUEST['vusu'].",".$_REQUEST['vclient'].",'".
        $_REQUEST['vfecarecl']."','".$_REQUEST['vobs']."') as reclamos;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['reclamos']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['reclamos']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
        

