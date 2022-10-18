<?php

require_once ("Model/curso_model.php");
require_once ("Model/fase_model.php");
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
$categoria = new categoria_model();

$categorias = $categoria->ver_categorias();
$resul1 = $curso->siguiente_id();
$resul2 = $fase->siguiente_id();

foreach ($resul1 as $renglon){
    foreach ($renglon as $columna => $valor){
        if(isset($valor)){
            $id_curso_nuevo = $valor;
        } else {
            $id_curso_nuevo = 1;
        }
    }
}

foreach ($resul2 as $renglon){
    foreach ($renglon as $columna => $valor){
        if(isset($valor)){
            $primer_fase = $valor;
        } else {
            $primer_fase = 1;
        }
    }
}

$x = 0;

require_once ("View/carga_curso_view.php");