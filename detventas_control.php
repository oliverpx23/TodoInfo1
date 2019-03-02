<?php
require './clases/conexion.php';
session_start();
$articulo = explode("_", $_REQUEST['varti']);

$sql = "SELECT sp_detventas(".$_REQUEST['accion'].","
        .$_REQUEST['vcod'].","
        .$articulo[0].","
        .$_REQUEST['vdep'].","
        .$_REQUEST['vsubtotal'].","
        .$_REQUEST['vprecio'].","
        .$_REQUEST['vcant']
        .") as det_ventas;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['det_ventas']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['det_ventas']."_".
            $_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']."?vcod=".
            $_REQUEST['vcod']);
}
?>
        

