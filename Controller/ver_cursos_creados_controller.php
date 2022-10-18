<?php

require_once ("Model/usuario_model.php");
require_once ("Model/busqueda_avanzada_model.php");

session_start();
if(!isset($_SESSION["usuario_logueado"])){
    header('Location: index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

    $id; $nombre; $email; $fech_mod; $tipo; $foto; $fech_cre;
    foreach ($usuario_logueado as $renglon) { foreach ($renglon as $columna => $valor) { 
        if ($columna == "id_usuario" && $valor != null) {  $id = $valor; }
        if ($columna == "nombre" && $valor != null) {  $nombre = $valor; }
        if ($columna == "email" && $valor != null) {  $email = $valor; }
        if ($columna == "fech_mod" && $valor != null) {  $fech_mod = $valor; }
        if ($columna == "foto" && $valor != null) {  $foto = $valor; 
        $img = "<img src='data:image/*; base64," . base64_encode($foto) . "' alt='' width='200'>"; }
        if ($columna == "fech_cre" && $valor != null) {  $fech_cre = $valor; }
        if ($columna == "tipo" && $valor != null) {  if ($valor == 1) {  $tipo = "Alumno"; } else {  $tipo = "Maestro"; }  }
        } }
        
        $curso = new busqueda_avanzada_model();
        $total_cursos = $curso->cursos_creados($id);
        $total_paginas = ceil(count($total_cursos)/4);
        
        $cursos_paginados = $curso->cursos_creados_pagina($id, 1);
        $formas_pago_total = $curso->desglose_formas_pago($id);
        
        require_once ("View/cursos_maestro_view.php");