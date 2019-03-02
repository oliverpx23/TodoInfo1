
<?php
require 'clases/conexion.php';///llamar la conexion

$sql="select * from v_usuarios where nick_usu= '".
        $_REQUEST['nick_usu']."'"
            . " and pass_usu=md5('".$_REQUEST['pass']."')";
                ///realiza el recorrido de consulta
                $resultado = consultas::get_datos($sql);
                //ranura una session o pregunta si existe una session activa
                session_start();
                ///compara el resultado de la consulta
                //
                //verifica si la consulta esta o no vacia
                if($resultado[0]['usu_cod']==NULL){
                    //si esta vacio imprime error y es asignada a una variable
                    //$_Session['error']
                    $_SESSION['error']='Usuario o contraseña incorrectos';
                    header('location:index.php');     
                }else{
                    //recupera la variables en variables de session al
                    //momento de ingresar
                    $_SESSION['usu_cod'] =$resultado[0]['usu_cod'];
                    $_SESSION['nick_usu'] =$resultado[0]['nick_usu'];
                    $_SESSION['nombres'] =$resultado[0]['usu_nombre'];
                    $_SESSION['usu_foto']='';
                    $_SESSION['gru_cod']=$resultado[0]['gru_cod'];
                     $_SESSION['grupo']=$resultado[0]['gru_nombre'];
                     $_SESSION['cod_suc'] = $resultado[0]['cod_suc'];
                     header('location:menu.php');//direccionar al menu principal
                    
                }
                
