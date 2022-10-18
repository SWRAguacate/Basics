<?php

require_once ("Model/busqueda_avanzada_model.php");

session_start();
if(!isset($_SESSION["usuario_logueado"])){
    header('Location: index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

$id_curso = $_GET["id_curso"];

$curso = new busqueda_avanzada_model();
$cursos = $curso->detalle_curso_creado($id_curso);
$resul = $curso->total_recaudado_del_curso($id_curso);

foreach ($resul as $renglon) {    foreach ($renglon as $clave=>$valor){
        $total_recaudado_curso = $valor;
    }
}

if($total_recaudado_curso == null){
    $total_recaudado_curso = 0.00;
}

require_once ("View/ver_detalle_view.php");