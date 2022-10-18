<?php

require_once ("../Model/curso_deseado_model.php");
require_once ("../Model/busqueda_avanzada_model.php");
require_once ("../Model/usuario_model.php");

$id = $_GET["id_usuario"];
$cursos_ids = $_GET["ids_curso"];
$fases_ids = $_GET["ids_fases"];
$id_fp = $_GET["metodo"];

$usuario = new usuario_model();
$user = $usuario->seleccionar_usuario($id);
session_start();
$_SESSION["usuario_logueado"] = $user;

$curso_deseado = new curso_deseado_model();
$arreglo_ids_curso = explode(',', $cursos_ids);
$arreglo_ids_fase = explode(',', $fases_ids);
$arreglo_ids_curso = array_unique($arreglo_ids_curso);
$arreglo_ids_fase = array_unique($arreglo_ids_fase);

if ($id_fp == 2) {
    foreach ($arreglo_ids_curso as $idCurso) {
        foreach ($arreglo_ids_fase as $idFase) {
            $curso_deseado->adquiere_fase((int) $idCurso, (int) $id, (int) $idFase, (int) $id_fp);
        }
    }
} else {
    foreach ($arreglo_ids_curso as $idCurso) {
        foreach ($arreglo_ids_fase as $idFase) {
            $curso_deseado->adquiere_fase((int) $idCurso, (int) $id, (int) $idFase, (int) $id_fp);
        }
    }
}

echo "<script> window.location.href='../carrito.php'; </script>";
die();