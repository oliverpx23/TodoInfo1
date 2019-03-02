<?php

require './clases/conexion.php';

session_start();


$sql = "SELECT sp_ventas(".$_REQUEST['accion'].",".
        $_REQUEST['vcod'].",".
        $_REQUEST['vusu'].",".
        $_REQUEST['vcli'].",'".
        $_REQUEST['vfecha']."','".
        $_REQUEST['vcondicion']."',".
        $_REQUEST['vtotal'].",'".
        $_REQUEST['vestado']."',".
        $_REQUEST['vcancuo']. ",".
        $_REQUEST['vtim']. ",".
        $_REQUEST['pedido']. ",".
        $_REQUEST['vape']. ",'".
        $_REQUEST['vfactura']."')"
        . " as ventas;";
       
$resultado = consultas::get_datos($sql);

if ($resultado[0]['ventas'] == null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['ventas']."_".
            $_REQUEST['accion'];

    header('location:./'.$_REQUEST['pagina']);
}
?>


 