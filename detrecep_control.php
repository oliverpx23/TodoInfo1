<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_detrecep(".$_REQUEST['accion'].","
        .$_REQUEST['vcod'].",'".
        $_REQUEST['vdescri']."',".
        $_REQUEST['vequi'].") as detrecep;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['detrecep']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['detrecep']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']."?vcod=".
            $_REQUEST['vcod']);
}
?>
        

