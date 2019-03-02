<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_articulos(".$_REQUEST['accion'].","
        .$_REQUEST['vcodart'].",'"
        .$_REQUEST['vartdescri']."',"
        .$_REQUEST['vtipoart'].","
        .$_REQUEST['vcodmar'].","
        .$_REQUEST['vprecio'].",'"
        .$_REQUEST['vartimg']."',"
        .$_REQUEST['vcosto']
        
        .") as articulos;";
        
 echo $sql;       

$resultado = consultas::get_datos($sql);

if ($resultado[0]['articulos']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['articulos']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
        
