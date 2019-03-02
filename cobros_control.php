<?php
require './clases/conexion.php';
session_start();

if($_REQUEST['accion'] == "1"){
    $cod = "select coalesce(max(cod_cob),0)+ 1 as codigo from cobros";
    $res = consultas::get_datos($cod);
    
    $efectivo = ($_REQUEST['importe']) ? $_REQUEST['importe'] : 0;
    $sql = "insert into cobros values(".$res[0]['codigo'].","
        .$_REQUEST['vape'].",'".$_REQUEST['fecha']."',"
        .$efectivo.",'". $_REQUEST['estado']."')";
    $resultado = consultas::ejecutar_sql($sql);
    
    foreach ($_REQUEST['detalle'] as $key => $detCob){
        $punto = $detCob[3][3];
        $det = "insert into detalle_cobros values(".$res[0]['codigo'].",".$detCob[0][0].",".(str_replace(".","", $punto)).",'".$detCob[1][1]."')";
        $resuldet = consultas::ejecutar_sql($det);
    }
     
    
     if ($_REQUEST['importech'] != 0) {
    $sql1 = "insert into cobro_cheques values(".$res[0]['codigo'].","
        .$_REQUEST['nrocheque'].",".$_REQUEST['banco'].",'"
            .$_REQUEST['fecha']."','".$_REQUEST['fechacobro']."',"
        .$_REQUEST['importech'].",'". $_REQUEST['titular']."')";
    $resultado1 = consultas::ejecutar_sql($sql1);
     }
    
      if ($_REQUEST['nrotarjeta'] != 0) {
    $sql2 = "insert into cobro_tarjetas values(".$res[0]['codigo'].","
       .$_REQUEST['tipotarjeta'].",'".$_REQUEST['nrotarjeta']."',"
        .$_REQUEST['importarj'].",". $_REQUEST['entidademisora'].")";
    $resultado2 = consultas::ejecutar_sql($sql2);
      }
    
    
}

if ($resultado == FALSE) {
    $json['mensaje'] = "Ocurrio un error";
    $json['success'] = FALSE;
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
    $json['mensaje'] = "Grabado con exito";
    $json['success'] = TRUE;
}
echo json_encode($json);
?>


 