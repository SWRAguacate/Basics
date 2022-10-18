<?php

require_once ("Model/usuario_model.php");
require_once ("Model/curso_model.php");
require_once ("Model/curso_deseado_model.php");
require_once ("Model/busqueda_avanzada_model.php");
require_once ("Model/contenido_model.php");
require_once ("Model/progreso_model.php");

session_start();
if(!isset($_SESSION["usuario_logueado"])){
    header('Location: index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

foreach ($usuario_logueado as $renglon) { foreach ($renglon as $columna => $valor) {
if ($columna == "id_usuario" && $valor != null) { $id = $valor; } } }

$id_curso = $_POST["id_curso"];
$progreso = new progreso_model();
$busqueda_avanzada = new busqueda_avanzada_model();
$cd = new curso_deseado_model();
$curso = new curso_model();
$cursos = $curso->seleccionar_curso($id_curso);

if(isset($_POST['fin_fase'])){
    $id_fin_fas = $_POST['fin_fase'];
    $progreso->finaliza_fase($id, $id_fin_fas);
}

if(isset($_POST['id_curso_carrito'])){
    $id_curso_carrito = $_POST['id_curso_carrito'];
    $cd->agrega_curso_carrito($id_curso_carrito, $id);
}

$id_autor; $titulo; $descripcion; $precio; $tipo; $fecha; $nom_autor; $it = 1;
foreach ($cursos as $renglon) { foreach ($renglon as $columna => $valor) {
if ($columna == "id_usuario" && $valor != null) { $id_autor = $valor; }
if ($columna == "titulo" && $valor != null) { $titulo = $valor; }
if ($columna == "descripcion" && $valor != null) { $descripcion = $valor; }
if ($columna == "precio" && $valor != null) { $precio = $valor; }
if ($columna == "tipo" && $valor != null) { $tipo = $valor; }
if ($columna == "fecha" && $valor != null) { $fecha = $valor; } } }

$usuario = new usuario_model();
$contenido = new contenido_model();
$fases = $cd->ver_curso_adquirido($id_curso, $id);

$resul = $usuario->nombre_autor($id_autor);
foreach ($resul as $renglon){
    foreach ($renglon as $columna => $valor){
        $nom_autor = $valor;
    }
}

$resul2 = $progreso->id_primer_fase($id_curso, $id);
foreach ($resul2 as $renglon){
    foreach ($renglon as $columna => $valor){
        $fase_actual = $valor;
    }
}

$resul3 = $contenido->id_primer_contenido($fase_actual);
foreach ($resul3 as $renglon){
    foreach ($renglon as $columna => $valor){
        $contenido_actual = $valor;
    }
}

$resul4 = $contenido->id_ultimo_contenido($id_curso);
foreach ($resul4 as $renglon){
    foreach ($renglon as $columna => $valor){
        $ultimo_contenido = $valor;
    }
}

$resul5 = $contenido->url_contenido($contenido_actual, null);
foreach ($resul5 as $renglon){
    foreach ($renglon as $columna => $valor){
        if ($columna == "nombre" && $valor != null) { 
            $nombre_contenido_actual = $valor;
        }
        if ($columna == "archivo" && $valor != null) { 
            $url_contenido = $valor;
        }
    }
}

$resul6 = $progreso->total_fases($id_curso);
foreach ($resul6 as $renglon){
    foreach ($renglon as $columna => $valor){
        $total_fases = $valor;
    }
}

$resul7 = $progreso->total_progresos_finalizados($id_curso, $id);
foreach ($resul7 as $renglon){
    foreach ($renglon as $columna => $valor){
        $total_progresos_finalizados = $valor;
    }
}

$resul8 = $progreso->total_progresos($id_curso, $id);
foreach ($resul8 as $renglon){
    foreach ($renglon as $columna => $valor){
        $total_progresos = $valor;
    }
}

$resul9 = $busqueda_avanzada->pinta_finalizados($id_curso, $id); $var;

require_once ("View/ver_curso_view.php");