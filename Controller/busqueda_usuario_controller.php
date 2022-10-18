<?php

require_once ("Model/categoria_model.php");
require_once ("Model/usuario_model.php");
require_once ("Model/busqueda_avanzada_model.php");

if(!isset($_POST["filtro_fech_ini"])){
        $fecha_ini = "*";
} else {
    if($_POST["filtro_fech_ini"] == true){
        $fecha_ini = $_POST["fech_ini"];
    } else {
        $fecha_ini = "*";
    }
}

if(!isset($_POST["filtro_fech_fin"])){
        $fecha_fin = "*";
} else {
    if($_POST["filtro_fech_fin"] == true){
        $fecha_fin = $_POST["fech_fin"];
    } else {
        $fecha_fin = "*";
    }
}

if(!isset($_POST["filtro_categorias"])){
        $categoria_peticion = "*";
} else {
    if($_POST["filtro_categorias"] == true){
        $categoria_peticion = $_POST["categorias"];
    } else {
        $categoria_peticion = "*";
    }
}

if(!isset($_POST["filtro_nom_usu"])){
        $nom_usu = "*";
} else {
    if($_POST["filtro_nom_usu"] == true){
        $nom_usu = $_POST["nom_usu"];
    } else {
        $nom_usu = "*";
    }
}

if(!isset($_POST["filtro_nom_cur"])){
        $nom_cur = "*";
} else {
    if($_POST["filtro_nom_cur"] == true){
        $nom_cur = $_POST["nom_cur"];
    } else {
        $nom_cur = "*";
    }
}

if( !isset($_POST["pagina"]) ) {
        $pag = "*";
} else {
        $pag = $_POST["pagina"];
}

$valid1; $valid2; $valid3; $valid4; $valid5; $valid6;

if($fecha_ini == "*"){
    $valid1 = null;
} else {
    $valid1 = $fecha_ini;
}

if($fecha_fin == "*"){
    $valid2 = null;
} else {
    $valid2 = $fecha_fin;
}

if($categoria_peticion == "*"){
    $valid3 = null;
} else {
    $valid3 = $categoria_peticion;
}

if($nom_cur == "*"){
    $valid4 = null;
} else {
    $valid4 = $nom_cur;
}

if($nom_usu == "*"){
    $valid5 = null;
} else {
    $valid5 = $nom_usu;
}

if($pag == "*"){
    $valid6 = 1;
} else {
    $valid6 = $pag;
}

$busqueda_avanzada = new busqueda_avanzada_model();
$categoria = new categoria_model();

$resultados_busqueda = $busqueda_avanzada->busqueda_avanzada($valid1, $valid2, $valid3, $valid4, $valid5);
$total_paginas = ceil(count($resultados_busqueda)/8);
$resultados_paginados = $busqueda_avanzada->busqueda_avanzada_paginada($valid1, $valid2, $valid3, $valid4, $valid5, $valid6);
$categorias = $categoria->ver_categorias();

$id_cat; $nombre_cat;
$foto; $img; $titulo; $descripcion; $categorias_respuesta; $total_likes; $precio; $cursos_vendidos; $i = 1; $p = 1;

require_once ("View/busqueda_view.php");