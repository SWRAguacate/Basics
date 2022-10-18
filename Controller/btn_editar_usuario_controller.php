<?php

require_once ("Model/usuario_model.php");

session_start();
if (!isset($_SESSION["usuario_logueado"])) {
    header('Location: index.php');
    die();
}

$mail = $_POST["correo"];
$pass = $_POST["contraseña"];
$nom = $_POST["nombre"];
$idd = $_POST["idd"];
$fech_nac = $_POST["fech_nac"];
    
    if ($_POST["genero"] == "Masculino") {
        $genero = 1;
    } else {
        $genero = 0;
    }
$nombre_ruta = $_FILES['ruta']['name'];
$tipo_ruta = $_FILES['ruta']['type'];
$tamanio_ruta = $_FILES['ruta']['size'];

if ($tamanio_ruta <= 10000000) {
    if ($tipo_ruta == "image/jpeg" || $tipo_ruta == "image/jpg" || $tipo_ruta == "image/png" ||
            $tipo_ruta == "image/gif" || $tipo_ruta == "image/svg" && $nombre_ruta != "null") {
        
        $archivo_objetivo = fopen($_FILES['ruta']['tmp_name'], "r");
        $contenido_img = fread($archivo_objetivo, $tamanio_ruta);
        fclose($archivo_objetivo);

        $usu = new usuario_model();
        $usu->editar_usuario($idd, $nom, $mail, $pass, $contenido_img, $fech_nac, $genero, null);
        $_SESSION["usuario_logueado"] = $usu->seleccionar_usuario($idd);
    } else {
        $usu = new usuario_model();
        $usu->editar_usuario($idd, $nom, $mail, $pass, null, $fech_nac, $genero, null);
        $_SESSION["usuario_logueado"] = $usu->seleccionar_usuario($idd);
    }
}

echo "<script> alert('Usuario editado con éxito'); window.location.href='usuario.php'; </script>";
die();
