<?php

require './clases/conexion.php';

session_start();


$sql = "SELECT sp_pedido_compras(".$_REQUEST['accion'].",".
        $_REQUEST['vcod'].",'".
        $_REQUEST['vfecha']."',".
        $_REQUEST['vusu'].",'".
        $_REQUEST['vestado']."',".
        $_REQUEST['vprov'].",".
        $_REQUEST['vtotal'].")"
        . " as pedido_compras;";
       
$resultado = consultas::get_datos($sql);

if ($resultado[0]['pedido_compras'] == null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['pedido_compras']."_".
            $_REQUEST['accion'];

    header('location:./'.$_REQUEST['pagina']);
}
?>


 