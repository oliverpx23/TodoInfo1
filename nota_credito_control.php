<?php

require './clases/conexion.php';

session_start();

$sql = "SELECT abm_notacredito(".$_REQUEST['accion'].","
        .$_REQUEST['vnota'].",".$_REQUEST['vventa'].",".$_REQUEST['vusuario'].","
        .$_REQUEST['vsucursal'].",'".$_REQUEST['vfecha']."',".$_REQUEST['vmonto'].",".
        $_REQUEST['vcliente'].",'".$_REQUEST['vestado']."') as notacredito;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['notacredito'] == null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['notacredito']."_".$_REQUEST['accion'];

    header('location:./'.$_REQUEST['pagina']);
}
?>

