<?php

require_once ("Model/busqueda_avanzada_model.php");
require_once ("Model/curso_deseado_model.php");
require_once ("Model/forma_pago_model.php");

session_start();
if (!isset($_SESSION["usuario_logueado"])) {
    header('Location: index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

$id;
foreach ($usuario_logueado as $renglon) { foreach ($renglon as $columna => $valor) {
if ($columna == "id_usuario" && $valor != null) { $id = $valor; } } }

$carrito = new busqueda_avanzada_model();
$cursos_fases_paga = $carrito->contenido_carrito_0($id);
$fases_gratis = $carrito->contenido_carrito_1($id);
$cursos_gratis = $carrito->contenido_carrito_2($id);
$total_carrito = 0.00; $toda_fase = ""; $todo_curso = ""; $i = 0; $length = count($cursos_gratis);

foreach ($cursos_fases_paga as $renglon) { foreach ($renglon as $columna => $valor) {
  if ($columna == "id_curso" && $valor != null) { $todo_curso = $todo_curso . $valor . ','; }
  if ($i == 0) { if ($columna == "id_fases" && $valor != null) { $toda_fase = $valor; $i++; } } 
  else { if ($columna == "id_fases" && $valor != null) { $toda_fase = $toda_fase . ',' . $valor; } }
  if ($columna == "monto" && $valor != null) { $total_carrito = $total_carrito + $valor; } } }

foreach ($fases_gratis as $renglon) { foreach ($renglon as $columna => $valor) {
  if ($columna == "id_curso" && $valor != null) { $todo_curso = $todo_curso . $valor . ','; }
  if ($columna == "id_fases" && $valor != null) { $toda_fase = $toda_fase . ',' . $valor; }
  if ($columna == "monto" && $valor != null) { $total_carrito = $total_carrito + $valor; } } }

foreach ($cursos_gratis as $renglon) { foreach ($renglon as $columna => $valor) {
  if ($i == $length) { if ($columna == "id_curso" && $valor != null) { $todo_curso = $todo_curso . $valor; } } 
  else { if ($columna == "id_curso" && $valor != null) { $todo_curso = $todo_curso . ',' . $valor . ','; } }
  if ($columna == "id_fases" && $valor != null) { $toda_fase = $toda_fase . ',' . $valor; }
  if ($columna == "monto" && $valor != null) { $total_carrito = $total_carrito + $valor; } } $i++; }

$forma_pago = new forma_pago_model();
$formas_pago = $forma_pago->ver_formas_pago();
$id_fp; $nombre_fp;

require_once ("View/pagar_view.php");