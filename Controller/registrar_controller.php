<?php

require_once ("../Model/usuario_model.php");

    $nom = $_POST["nombre"];
    $correo = $_POST["correo"];
    $contra = $_POST["contraseña"];
    $fech_nac = $_POST["fech_nac"];
    
    if ($_POST["genero"] == "Masculino") {
        $genero = 1;
    } else {
        $genero = 0;
    }

    if ($_POST["tipo_usu"] == "Alumno") {
        $tipo = 1;
    } else {
        $tipo = 0;
    }
    
    $usuario = new usuario_model();
    $usuario->insertar_usuario($nom, $correo, $contra, null, $fech_nac, $tipo, $genero);
    $user = $usuario->buscar_usuario($correo, $contra, $tipo);
    
    if (Count($user) != 0) {
        session_start();
        $_SESSION["usuario_logueado"] = $user;
        header('Location: ../index_usuario.php');
        die();
    } else {
        echo "<script> alert('Cuenta ya existente, intente de nuevo'); window.location.href='../sesion.php'; </script>";
        die();
    }