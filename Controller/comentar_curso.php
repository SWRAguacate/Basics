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
$id_curso = $_POST['id_curso'];
$text_area = $_POST['comentario'];

$array = explode(chr(32), $text_area);
$comentario = '';

foreach($array as $valor){
    $comentario = $comentario.$valor.' ';
}

$coment->insertar_comentario($id_curso, $id, $comentario);

echo "<script> alert('Comentario enviado'); window.location.href='../info_curso.php?id_curso=".$id_curso."'; </script>";
die();