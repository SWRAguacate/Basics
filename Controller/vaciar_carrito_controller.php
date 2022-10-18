<?php

require_once ("../Model/curso_deseado_model.php");

session_start();
if (!isset($_SESSION["usuario_logueado"])) {
    header('Location: ../index.php');
    die();
}

$cursos_ids = $_GET["ids_curso"];
$fases_ids = $_GET["ids_fases"];
$id = $_GET["id"];
$message = $_GET['bt'];

if($message == 1){
    $print = "<script> alert('Elemento borrado'); window.location.href='../carrito.php'; </script>";
} else {
    $print = "<script> alert('Carrito vaciado'); window.location.href='../carrito.php'; </script>";
}

$curso_deseado = new curso_deseado_model();
$arreglo_ids_curso = explode(',', $cursos_ids);
$arreglo_ids_fase = explode(',', $fases_ids);
$arreglo_ids_curso = array_unique($arreglo_ids_curso);
$arreglo_ids_fase = array_unique($arreglo_ids_fase);

foreach ($arreglo_ids_curso as $idCurso) {
    foreach ($arreglo_ids_fase as $idFase) {
        if($idCurso != '' && $idCurso != null && $idFase != '' && $idFase != null){
            $curso_deseado ->vacia_carrito($idCurso, $id, $idFase);
        }
    }
}

echo $print;
die();