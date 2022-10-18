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
$mensaje_mandar = $_POST['mensaje'];

$mensaje = new mensaje_model();
$mensaje->insertar_mensaje($id_emisor, $id_receptor, $mensaje_mandar);

echo "<script> alert('Mensaje enviado'); window.location.href='../ver_mensajes_usuarios.php?id_receptor=".$id_receptor."'; </script>";
 die();