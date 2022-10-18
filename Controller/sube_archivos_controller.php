<?php

session_start();
if (!isset($_SESSION["usuario_logueado"])) {
    header('Location: ../index.php');
    die();
}
$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/Basics/MVC/Contenidos/';
$file_names = $_FILES["archivoFile"]["name"];

for ($i = 0; $i < count($file_names); $i++) {
      $file_name=$file_names[$i];
      move_uploaded_file($_FILES["archivoFile"]["tmp_name"][$i], $carpeta_destino . $file_name);
}