<?php

require_once ("../Model/usuario_model.php");

    $correo = $_POST["correo2"];
    $contra = $_POST["contraseña2"];

    if ($_POST["tipo_usuario"] == "Alumno") {
        $tipo = 1;
    } else {
        $tipo = 0;
    }

    $usuario = new usuario_model();

    $user = $usuario->buscar_usuario($correo, $contra, $tipo);

    if (Count($user) != 0) {
        session_start();
        $_SESSION["usuario_logueado"] = $user;
        echo "<script> alert('Usuario iniciado con éxito'); window.location.href='../index_usuario.php'; </script>";
        die();
    } else {
        echo "<script> alert('Usuario no existente, verifique los datos e intente de nuevo'); window.location.href='../sesion.php'; </script>";
        die();
    }