<?php

require_once ("../Model/curso_model.php");

session_start();
if(!isset($_SESSION["usuario_logueado"])){
    header('Location: ../index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

$id_curso = $_GET['id_curso'];
$curso = new curso_model();
$curso->eliminar_curso($id_curso);

echo "<script> alert('Curso eliminado'); window.location.href='../ver_cursos_creados.php'; </script>";
 die();