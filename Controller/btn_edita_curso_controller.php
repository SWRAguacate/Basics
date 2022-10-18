<?php

require_once ("../Model/curso_model.php");
require_once ("../Model/categoria_curso_model.php");
require_once ("../Model/fase_model.php");

session_start();
if(!isset($_SESSION["usuario_logueado"])){
    header('Location: ../index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

foreach ($usuario_logueado as $renglon) { foreach ($renglon as $columna => $valor) {
if ($columna == "id_usuario" && $valor != null) {  $id_autor = $valor; } } }
        
$curso = new curso_model();
$categoria_curso = new categoria_curso_model();
$fase = new fase_model();

$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/Basics/MVC/Contenidos/';
        
$curso_agregar = json_decode($_POST['curso'],true);   
$categorias = json_decode($_POST['categorias'],true);
$fases = json_decode($_POST['fases'],true);

$id_cur; $tituloCur; $descripcionCur; $imagenCur; $precioCur; $tipoCur;
foreach($curso_agregar as $renglon){
    foreach($renglon as $columna => $valor){
        if($columna == 'id_curso'){ $id_cur = $valor; }
        if($columna == 'titulo'){ $tituloCur = $valor; }
        if($columna == 'descripcion'){ $descripcionCur = $valor; }
        if($columna == 'imagen'){ $imagenCur = $valor; }
        if($columna == 'precio'){ $precioCur = $valor; }
        if($columna == 'tipo'){ $tipoCur = $valor; }
        if($columna == 'name'){ $nombre_ruta = $valor; }
        if($columna == 'type'){ $tipoImg = $valor; }
        if($columna == 'size'){ $tamanio_ruta = $valor; }
    } 
    if($imagenCur != ""){
        
        $archivo_objetivo = fopen($carpeta_destino . $nombre_ruta, "r");
        $contenido_img = fread($archivo_objetivo, $tamanio_ruta);
        fclose($archivo_objetivo);
        $curso->editar_curso($id_cur, $id_autor, $tituloCur, $descripcionCur, $contenido_img, $precioCur, $tipoCur, null);
    } else {
        $curso->editar_curso($id_cur, $id_autor, $tituloCur, $descripcionCur, null, $precioCur, $tipoCur, null);
    }
}

foreach($categorias as $columna => $valor){
    $categoria_curso->insertar_categoria_curso($valor, $id_cur);
}

$id_fas; $nombreFas; $descripcionFas; $montoFas; $tipoFas;
foreach($fases as $renglon){
    foreach($renglon as $columna => $valor){
        if($columna == 'id_fase'){ $id_fas = $valor; }
        if($columna == 'nombre'){ $nombreFas = $valor; }
        if($columna == 'descripcion'){ $descripcionFas = $valor; }
        if($columna == 'monto'){ $montoFas = $valor; }
        if($columna == 'tipo'){ $tipoFas = $valor; }
    }
    $fase->editar_fase($id_fas, $id_cur, $nombreFas, $descripcionFas, $montoFas, $tipoFas);
}