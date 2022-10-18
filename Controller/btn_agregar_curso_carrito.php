<?php

require_once ("../Model/curso_deseado_model.php");

session_start();
if(!isset($_SESSION["usuario_logueado"])){
    header('Location: ../index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

foreach ($usuario_logueado as $renglon) { foreach ($renglon as $columna => $valor) {
if ($columna == "id_usuario" && $valor != null) {  $id = $valor; } } }

$id_curso = $_POST["id_curso"];
if (!isset($_POST["origen"])){ $origen = 'c'; } else { $origen = $_POST["origen"]; }

$curso_deseado = new curso_deseado_model();
$curso_deseado->agrega_curso_carrito($id_curso, $id);

if($origen == 'i'){
    echo "<script> alert('Curso agregado al carrito'); window.location.href='../index_usuario.php'; </script>";
    die();
} else if ($origen == 'b') {
    echo "<script> alert('Curso agregado al carrito'); window.location.href='../busqueda_usuario.php'; </script>";
    die();
} else {
    echo "<script> alert('Curso agregado al carrito'); window.location.href='../info_curso.php?id_curso=".$id_curso."'; </script>";
    die();
}