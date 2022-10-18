<?php

require_once ("../Model/comentario_model.php");

session_start();
if(!isset($_SESSION["usuario_logueado"])){
    header('Location: ../index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

foreach ($usuario_logueado as $renglon) { foreach ($renglon as $columna => $valor) { 
        if ($columna == "id_usuario" && $valor != null) {  $id = $valor; } } }

$coment = new comentario_model();
$id_curso = $_GET['id_curso'];
$fecha_salida = $_GET['fech_salida'];

$coment->eliminar_comentario($id_curso, $id, $fecha_salida);

echo "<script> alert('Comentario eliminado'); window.location.href='../info_curso.php?id_curso=".$id_curso."'; </script>";
die();