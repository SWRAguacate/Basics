<?php

require_once ("../Model/mensaje_model.php");

session_start();
if(!isset($_SESSION["usuario_logueado"])){
    header('Location: ../index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

$id_emisor = $_POST['id_emisor'];
$id_receptor = $_POST['id_receptor'];
$fech_salida = $_POST['fech_salida'];

$mensaje = new mensaje_model();
$mensaje->eliminar_mensaje($id_emisor, $id_receptor, $fech_salida);

echo "<script> alert('Mensaje borrado'); window.location.href='../ver_mensajes_usuarios.php?id_receptor=".$id_receptor."'; </script>";
 die();