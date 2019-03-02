<?php
require './clases/conexion.php';
session_start();

$sql = "select sp_detpresu(".$_REQUEST['accion'].","
        .$_REQUEST['vpresu'].","
        .$_REQUEST['varti'].","
        .$_REQUEST['vprecio'].","
        .$_REQUEST['vcant'].","
        .$_REQUEST['vsubtotal'].",'"
        .$_REQUEST['vestado']."') as detpresu;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['detpresu']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['detpresu']."_".
            $_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']."?vpresu=".
            $_REQUEST['vpresu']);
}
?>
        

