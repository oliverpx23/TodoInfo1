<?php
require './clases/conexion.php';
session_start();
$sql = "SELECT sp_apercierre(".$_REQUEST['vcod'].","
        .$_REQUEST['vcaja'].",".$_SESSION['usu_cod'].","
        .$_REQUEST['vmonto'].",". $_REQUEST['vmoncierre'].","
        .$_REQUEST['accion'].") as apertura;";

$resultado = consultas::get_datos($sql);


if ($resultado[0]['apertura'] == null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['apertura']."_".$_REQUEST['accion'];

    header('location:./'.$_REQUEST['pagina']);
}
?>


 