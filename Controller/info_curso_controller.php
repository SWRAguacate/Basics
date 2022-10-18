<?php

require_once ("Model/busqueda_avanzada_model.php");

session_start();
if(!isset($_SESSION["usuario_logueado"])){
    $usuario_logueado = null;
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

$id_curso = $_GET['id_curso']; $foto; $fas = "";
$curso = new busqueda_avanzada_model();
$info_curso = $curso->info_curso($id_curso);
$comentarios = $curso->comentarios_curso($id_curso);
$contenido_curso = $curso->contenido_info_curso($id_curso);
$valida = false;

foreach ($info_curso as $renglon) { foreach ($renglon as $columna => $valor) {
    if ($columna == "nombre" && $valor != null) { $nombre_autor = $valor; }
    if ($columna == "titulo" && $valor != null) { $titulo_curso = $valor; }
    if ($columna == "descripcion" && $valor != null) { $descripcion_curso = $valor; }
    if ($columna == "likes" && $valor != null) { $likes_curso = $valor; }
    if ($columna == "dislikes" && $valor != null) { $dislikes_curso = $valor; }
    if ($columna == "porcentaje_likes" && $valor != null) { $porcentaje_likes_curso = $valor; }
    if ($columna == "alumnos" && $valor != null) { $alumnos_curso = $valor; }
    if ($columna == "imagen" && $valor != null) {  $foto = $valor; 
        $img = "<img src='data:image/*; base64," . base64_encode($foto) . "' class='img-curso' alt=''>"; }
    if ($columna == "precio" && $valor != null) { $precio_curso = $valor; } } }

if($usuario_logueado == null){
    $j = 0;
    require_once ("View/info_curso_view.php");
} else {
    $j = 0;
    foreach ($usuario_logueado as $renglon) { foreach ($renglon as $columna => $valor) {
    if ($columna == "id_usuario" && $valor != null) { $id = $valor; } } }
    
    $total_cursos = $curso->adquiridos_usuario($id); 
    
    foreach ($total_cursos as $renglon) { foreach ($renglon as $columna => $valor) {
    if ($columna == "id_curso" && $valor == $id_curso) { $valida = true; } } }
    
    if($valida == true){
        $mio = false;
        require_once ("View/info_curso_usuario2_view.php");
    } else {
        require_once ("View/info_curso_usuario_view.php");
    }
}