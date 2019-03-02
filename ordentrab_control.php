<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_ordentrab(".$_REQUEST['accion'].","
        .$_REQUEST['vordtrab'].",".$_REQUEST['vpres'].",".
        $_REQUEST['varticulo'].",".$_REQUEST['vusu'].",'".
        $_REQUEST['vfini']."','".$_REQUEST['vffin']."','".
        $_REQUEST['vestado']."',".$_REQUEST['vsuc'].",".
        $_REQUEST['vtecnico'].") as ordentrabajo;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['ordentrabajo']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['ordentrabajo']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
        

