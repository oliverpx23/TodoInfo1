<?php
require './clases/conexion.php';
session_start();
$articulo = explode("_", $_REQUEST['varti']);

$sql = "SELECT sp_detpedidos(".$_REQUEST['accion'].","
        .$_REQUEST['vcod'].","
        .$_REQUEST['vdep'].","
        .$_REQUEST['vcant'].","
        .$_REQUEST['vsubtotal'].","
        .$articulo[0].","
        .$_REQUEST['vprecio'].
        ") as det_pedido_compras;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['det_pedido_compras']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['det_pedido_compras']."_".
            $_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']."?vcod=".
            $_REQUEST['vcod']);
}
?>
        

