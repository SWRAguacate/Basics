<?php

require_once ("../Model/categoria_model.php");

session_start();
if(!isset($_SESSION["usuario_logueado"])){
    header('Location: ../index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

foreach ($usuario_logueado as $renglon) { foreach ($renglon as $columna => $valor) {
if ($columna == "id_usuario" && $valor != null) {  $id = $valor; } } }

$nomCat = $_POST["nomAltaCat"];
$descCat = $_POST["descAltaCat"];

$categoria = new categoria_model();

$categoria->insertar_categoria($id, $nomCat, $descCat);

echo "<script> alert('Categoria agregada'); window.location.href='../agrega_curso.php'; </script>";
die();