<?php

require_once ("Model/categoria_model.php");
require_once ("Model/usuario_model.php");
require_once ("Model/busqueda_avanzada_model.php");

if(!isset($_GET["param1"])){
    $fecha_ini = null;
} else {
    $fecha_ini = $_GET["param1"];
}

if(!isset($_GET["param2"])){
    $fecha_fin = null;
} else {
    $fecha_fin = $_GET["param2"];
}

if(!isset($_GET["param3"])){
    $categoria_peticion = null;
} else {
    $categoria_peticion = $_GET["param3"];
}

if(!isset($_GET["param4"])){
    $nom_usu = null;
} else {
    $nom_usu = $_GET["param4"];
}

if(!isset($_GET["param5"])){
    $nom_cur = null;
} else {
    $nom_cur = $_GET["param5"];
}

if( !isset($_GET["param6"]) ) {
        $pag = 1;
} else {
        $pag = $_GET["param6"];
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
require_once ("View/busqueda2_view.php");