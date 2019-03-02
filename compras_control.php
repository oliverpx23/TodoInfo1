<?php

require './clases/conexion.php';

session_start();


$sql = "SELECT sp_compras(".$_REQUEST['accion'].",".
        $_REQUEST['vcod'].",".
        $_REQUEST['vprov'].",".
        $_REQUEST['vusu'].",'".
        $_REQUEST['vfecha']."',".
        $_REQUEST['vtotal'].",'".
        $_REQUEST['vestado']."','".
        $_REQUEST['vcondicion']."','".
        $_REQUEST['vfactura']. "',".
        $_REQUEST['vcancuo']. ",".
        $_REQUEST['vorden'].")"
        . " as compras;";
       
$resultado = consultas::get_datos($sql);

if ($resultado[0]['compras'] == null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['compras']."_".
            $_REQUEST['accion'];

    header('location:./'.$_REQUEST['pagina']);
}
?>


 