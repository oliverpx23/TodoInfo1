<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_deserv(".$_REQUEST['accion'].","
        .$_REQUEST['vser'].",'".$_REQUEST['vfini']."','".
        $_REQUEST['vffin']."',".$_REQUEST['vmonto'].",".
        $_REQUEST['vsuc'].",".$_REQUEST['vtecnico'].") as detservi;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['detservi']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['detservi']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']."?vserv=".
            $_REQUEST['vserv']);
}
?>
        

