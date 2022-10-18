<?php

require_once ("Model/usuario_model.php");
require_once ("Model/busqueda_avanzada_model.php");
require_once ("Model/curso_deseado_model.php");

session_start();
if(!isset($_SESSION["usuario_logueado"])){
    header('Location: index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

//$usuario = new usuario_model();
//$usuario_logueado = $usuario->seleccionar_usuario($id);

$curso = new busqueda_avanzada_model();
$mas_vendidos = $curso->mas_vendidos();
$mas_recientes = $curso->mas_recientes();
$mejor_calificados = $curso->mejor_calificados();
$foto; $img; $titulo; $descripcion; $categorias; $total_likes; $precio; $cursos_vendidos; $i = 1;

require_once ("View/inicio_view.php");