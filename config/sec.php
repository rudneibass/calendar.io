<?php

session_start(); 

if(!isset($_SESSION['USUARIO'])){ 
    if(basename($_SERVER['REQUEST_URI']) === 'votacao'){
        header("Location: ../votacao-login");
    } 
    header("Location: ../login");
}

if(isset($_GET['out'])){
    session_destroy();
    header("Location: ../../");
}

if(isset($_GET['sair-votacao'])){
    session_destroy();
    header("Location: ../votacao-login");
}

/*$_SESSION['USUARIO'];
$usuario = $_SESSION['USUARIO'];*/

/*if(!empty($_SESSION['USUARIO'])){ 
    $usuario = $_SESSION['USUARIO'];
}*/