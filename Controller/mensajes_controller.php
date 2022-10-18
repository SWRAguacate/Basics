<?php

require_once ("Model/mensaje_model.php");
require_once ("Model/usuario_model.php");
require_once ("Model/busqueda_avanzada_model.php");

$mensaje = new mensaje_model();
$usuario = new usuario_model();
$busqueda_avanzada = new busqueda_avanzada_model();

session_start();
if(!isset($_SESSION["usuario_logueado"])){
    header('Location: index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

foreach ($usuario_logueado as $renglon) { foreach ($renglon as $columna => $valor) { 
if ($columna == "id_usuario" && $valor != null) {  $id_emisor = $valor; } } }

$usuarios = $usuario->ver_usuarios_activos();
$mensajes = $busqueda_avanzada->ver_mensajes_usuarios(0,0);

$id_receptor = "";
        
require_once ("View/mensaje_view.php");