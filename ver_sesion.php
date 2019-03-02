<?php

//reanudamos la sesion
//validamos si esque realmente el usuario tiene una pagina activa
session_start();

if($_SESSION['usu_cod']==null){
    $_SESSION['error']='Inicie Sesion';
    header('location:http;//localhost/TodoInfo');
    exit();
    
}
?>