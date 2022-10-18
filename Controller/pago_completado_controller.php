<?php

require_once ("../Model/curso_deseado_model.php");
require_once ("../Model/busqueda_avanzada_model.php");

session_start();
if (!isset($_SESSION["usuario_logueado"])) {
    header('Location: index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

$cursos_ids = $_POST["ids_curso"];
$fases_ids = $_POST["ids_fases"];
$id_fp = $_POST["metodo"];

$id; $j = 1;
foreach ($usuario_logueado as $renglon) {
    foreach ($renglon as $columna => $valor) {
        if ($columna == "id_usuario" && $valor != null) {
            $id = $valor;
        }
    }
}

$fields = [
    'cmd' => '_cart',
    'upload' => '1',
    'business' => 'sb-sppi18275636@business.example.com',
    'currency_code' => 'MXN',
    'lc' => 'MX',
    'rm' => '2',
    'return' => 'https://basicscursos.000webhostapp.com/Basics/MVC/Controller/pagado_paypal_controller.php?ids_curso='.$cursos_ids.'&ids_fases='.$fases_ids.'&metodo='.$id_fp.'&id_usuario='.$id,
    'cancel_return' => 'https://basicscursos.000webhostapp.com/Basics/MVC/carrito.php',
    'notify_url' => 'https://basicscursos.000webhostapp.com/Basics/MVC/carrito.php',
    'succes' => 'https://basicscursos.000webhostapp.com/Basics/MVC/Controller/pagado_paypal_controller.php?ids_curso='.$cursos_ids.'&ids_fases='.$fases_ids.'&metodo='.$id_fp.'&id_usuario='.$id
];

$curso_deseado = new curso_deseado_model();
$carrito = new busqueda_avanzada_model();
$cursos_fases_paga = $carrito->contenido_carrito_0($id);
$fases_gratis = $carrito->contenido_carrito_1($id);
$cursos_gratis = $carrito->contenido_carrito_2($id);

foreach ($cursos_fases_paga as $renglon) { foreach ($renglon as $columna => $valor) {
    if ($columna == "id_fases" && $valor != null) {  $id_fases = $valor; }
    if ($columna == "titulo" && $valor != null) {  $titulo = $valor;  }
    if ($columna == "fases" && $valor != null) {  $nombre_fases = $valor; }
if ($columna == "monto" && $valor != null) {  $costo = $valor; } }
    $fields["item_name_" . $j] = $nombre_fases;
    $fields["item_number_" . $j] = $j;
    $fields["amount_" . $j] = $costo;
    $fields["quantity_" . $j] = 1;
    $j++; }
    
foreach ($cursos_gratis as $renglon) { foreach ($renglon as $columna => $valor) {
    if ($columna == "id_curso" && $valor != null) {  $id_curso = $valor; }
    if ($columna == "id_fases" && $valor != null) {  $id_fases = $valor; }
    if ($columna == "tipo" && $valor != null) {  $tipo_curso = $valor; }
    if ($columna == "titulo" && $valor != null) {  $titulo = $valor;  }
    if ($columna == "fases" && $valor != null) {  $nombre_fases = $valor; }
    if ($columna == "monto" && $valor != null) {  $costo = $valor; } }
    $fields["item_name_" . $j] = $nombre_fases;
    $fields["item_number_" . $j] = $j;
    $fields["amount_" . $j] = '0.01';
    $fields["quantity_" . $j] = 1;
    $j++; }

$arreglo_ids_curso = explode(',', $cursos_ids);
$arreglo_ids_fase = explode(',', $fases_ids);
$arreglo_ids_curso = array_unique($arreglo_ids_curso);
$arreglo_ids_fase = array_unique($arreglo_ids_fase);

if ($id_fp == 2) {
    $query_string = http_build_query($fields);
            header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?' . $query_string);
            exit();
} else {
    foreach ($arreglo_ids_curso as $idCurso) {
        foreach ($arreglo_ids_fase as $idFase) {
            $curso_deseado->adquiere_fase((int) $idCurso, (int) $id, (int) $idFase, (int) $id_fp);
        }
    }
}

echo "<script> alert('Compra realizada con éxito'); window.location.href='../carrito.php'; </script>";
die();