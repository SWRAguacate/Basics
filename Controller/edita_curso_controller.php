<?php

require_once ("Model/curso_model.php");
require_once ("Model/fase_model.php");
require_once ("Model/contenido_model.php");
require_once ("Model/categoria_curso_model.php");
require_once ("Model/categoria_model.php");

session_start();
if(!isset($_SESSION["usuario_logueado"])){
    header('Location: index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

foreach ($usuario_logueado as $renglon) { foreach ($renglon as $columna => $valor) { 
        if ($columna == "id_usuario" && $valor != null) {  $id = $valor; } } }

$curso = new curso_model();
$fase = new fase_model();
$contenido = new contenido_model();
$categoria_curso = new categoria_curso_model();
$categoria = new categoria_model();

$id_curso = $_GET['id_curso'];

$curso_mostrar = $curso->seleccionar_curso($id_curso);
$categorias_curso_mostrar = $curso->seleccionar_categorias_curso($id_curso);
$fases_mostrar = $curso->seleccionar_fases_curso($id_curso);
$contenidos_mostrar = $curso->seleccionar_contenidos_curso($id_curso);
$categorias = $categoria->ver_categorias();

foreach ($curso_mostrar as $renglon) { foreach ($renglon as $columna => $valor) { 
        if ($columna == "id_usuario" && $valor != null) {  $id_autor = $valor; }
        if ($columna == "titulo" && $valor != null) {  $titulo_curso = $valor; }
        if ($columna == "descripcion" && $valor != null) {  $descripcion_curso = $valor; }
        if ($columna == "imagen" && $valor == null) { 
                   $img = '';  }
              else if ($columna == "imagen") { $foto = $valor; 
              $img = 'data:image/*; base64,' . base64_encode($foto);  }
        if ($columna == "precio" && $valor != null) {  $precio_curso = $valor; }
        if ($columna == "tipo" && $valor != null) {  $tipo_curso = $valor; }
        } }

$x = 0;

require_once ("View/edita_curso_view.php");