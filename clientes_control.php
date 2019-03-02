<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_clientes(".$_REQUEST['accion'].","
        .$_REQUEST['vcod'].",'".$_REQUEST['vci']."','".
        $_REQUEST['vnombre']."','".$_REQUEST['vapellido']."','".
        $_REQUEST['vfecnac']."',".$_REQUEST['vciu'].",".
        $_REQUEST['vdepar'].",".$_REQUEST['vpais'] .",'".$_REQUEST['vtel']."','".
        $_REQUEST['sexo']."','".$_REQUEST['vdirec']."') as clientes;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['clientes']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['clientes']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
        

