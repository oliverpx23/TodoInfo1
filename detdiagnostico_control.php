<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_detdiag(".$_REQUEST['accion'].","
        .$_REQUEST['vcod'].",".
        $_REQUEST['varticulo'].",".
        $_REQUEST['vprecio'].",".
        $_REQUEST['vcantidad'].",'".
        $_REQUEST['vobserv']."') as detdiag;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['detdiag']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['detdiag']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']."?vcod=".
            $_REQUEST['vcod']);
}
?>
        

