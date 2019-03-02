<?php

require './clases/conexion.php';

session_start();

$insumo = explode("_", $_REQUEST['vprecio']);

$sql = "SELECT abm_notacreditodetalle(".$_REQUEST['accion'].",".
        $_REQUEST['vnota'].",".$_REQUEST['vinsu'].",".
        $insumo[0].",".$_REQUEST['vcant'].",'".
        $_REQUEST['vmotivo']."',".$_REQUEST['vtotal'].") as detalle_nota;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['detalle_nota'] == null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['detalle_nota']."_".$_REQUEST['accion'];

    header('location:./'.$_REQUEST['pagina']."?vnota=".
            $_REQUEST['vnota']."&vven=".$_REQUEST['vven']);
}
?>

