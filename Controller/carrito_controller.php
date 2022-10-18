<?php

require_once ("Model/busqueda_avanzada_model.php");

session_start();
if(!isset($_SESSION["usuario_logueado"])){
    header('Location: index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

    foreach ($usuario_logueado as $renglon) { foreach ($renglon as $columna => $valor) { 
        if ($columna == "id_usuario" && $valor != null) {  $id = $valor; } } }

$carrito = new busqueda_avanzada_model();
$cursos_fases_paga = $carrito->contenido_carrito_0($id);
$fases_gratis = $carrito->contenido_carrito_1($id);
$cursos_gratis = $carrito->contenido_carrito_2($id);
$total_carrito = 0.00; $toda_fase = ""; $todo_curso = ""; $i = 0; $length = count($cursos_gratis);

require_once ("View/carrito_view.php");