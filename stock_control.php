<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_stock(".$_REQUEST['accion'].","
        .$_REQUEST['vdep'].","
        .$_REQUEST['vartdescri'].",'"
        .$_REQUEST['vcant']."') as stock;";
        
 echo $sql;       

$resultado = consultas::get_datos($sql);

if ($resultado[0]['stock']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['stock']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
        
