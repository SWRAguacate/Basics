<?php

require_once ("Model/usuario_model.php");

session_start();
if(!isset($_SESSION["usuario_logueado"])){
    header('Location: index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

    $id; $nombre; $email; $foto; $contra; $img; $genero; $fech_nac;
    foreach ($usuario_logueado as $renglon) { foreach ($renglon as $columna => $valor) { 
        if ($columna == "id_usuario" && $valor != null) {  $id = $valor; }
        if ($columna == "nombre" && $valor != null) {  $nombre = $valor; }
        if ($columna == "email" && $valor != null) {  $email = $valor; }
        if ($columna == "genero" && $valor != null) {  $genero = $valor; }
        if ($columna == "fech_nac" && $valor != null) {  $fech_nac = $valor; }
        if ($columna == "foto" && $valor != null) {  $foto = $valor; 
        $img = "<img src='data:image/*; base64," . base64_encode($foto) . "' class='foto-avatar2' id='imgSalida' name='imgSalida'>"; }
        if ($columna == "contra" && $valor != null) {  $contra = $valor;  }
        } }
        

        require_once ("View/editar_view.php");