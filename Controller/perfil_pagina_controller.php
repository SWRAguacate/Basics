<?php

require_once ("Model/categoria_model.php");
require_once ("Model/usuario_model.php");
require_once ("Model/busqueda_avanzada_model.php");

session_start();
if(!isset($_SESSION["usuario_logueado"])){
    header('Location: index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

if(!isset($_GET["param1"])){
    $pagina = 1;
} else {
    $pagina = $_GET["param1"];
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
        $total_cursos = $curso->adquiridos_usuario($id);
        $total_paginas = ceil(count($total_cursos)/4);
        
        $cursos_paginados = $curso->adquiridos_paginado_usuario($id, $pagina);
        
if($tipo == "Alumno"){
        require_once ("View/perfil_view.php");
        } else {
        require_once ("View/perfil_maestro_view.php");
        }