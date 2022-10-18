<?php

require_once ("../Model/calificacion_model.php");

session_start();
if(!isset($_SESSION["usuario_logueado"])){
    header('Location: ../index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

foreach ($usuario_logueado as $renglon) { foreach ($renglon as $columna => $valor) { 
        if ($columna == "id_usuario" && $valor != null) {  $id = $valor; } } }

$calif = new calificacion_model();

$id_curso = $_GET['id_curso'];
$calificacion = $_GET['calificacion'];

if($calificacion == 1) {
    $calif_bool = 1;
} else {
    $calif_bool = 0;
}

$valid = $calif->seleccionar_calificacion($id_curso, $id, $calif_bool);

if(count($valid) == 0){
    $calif->insertar_calificacion($id_curso, $id, $calif_bool);
} else {
    $calif->eliminar_calificacion($id_curso, $id);
}

echo "<script> alert('Recomendación guardada'); window.location.href='../info_curso.php?id_curso=".$id_curso."'; </script>";
die();