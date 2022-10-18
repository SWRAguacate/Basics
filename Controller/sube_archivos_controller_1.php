<?php

require_once ("../Model/curso_model.php");
require_once ("../Model/categoria_curso_model.php");
require_once ("../Model/fase_model.php");
require_once ("../Model/contenido_model.php");

$curso = new curso_model();
$categoria_curso = new categoria_curso_model();
$fase = new fase_model();
$contenido = new contenido_model();

session_start();
if (!isset($_SESSION["usuario_logueado"])) {
    header('Location: ../index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

foreach ($usuario_logueado as $renglon) { foreach ($renglon as $columna => $valor) { 
if ($columna == "id_usuario" && $valor != null) {  $id_usuario = $valor; } } }
        
$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/Basics/MVC/Contenidos/';
$file_names = $_FILES["file-input"]["name"];

$content_names = $_FILES["archivoFile"]["name"];

$titulo = $_POST["titulo"];
$id_curso = $_POST["id_curso"];
$descripcion = $_POST["descripcion"];
$tipo = $_POST["tipo"];
$precio = $_POST["precio"];
$categorias = json_decode($_POST['categorias'],true);
$fases = json_decode($_POST['fases'],true);
$contenidos = json_decode($_POST['contenidos'],true);
$tamanio = $_FILES['ruta']['size'][0];

for ($i = 0; $i < count($file_names); $i++) {
      $ima = file_get_contents($_FILES["file-input"]["tmp_name"][$i]);
      $curso->insertar_curso($id_usuario, $titulo, $descripcion, $ima, $precio, $tipo);
}

foreach($categorias as $columna => $valor){
    $categoria_curso->insertar_categoria_curso($valor, $id_curso);
}

$nombreFas; $descripcionFas; $montoFas; $tipoFas;
foreach($fases as $renglon){
    foreach($renglon as $columna => $valor){
        if($columna == 'nombre'){ $nombreFas = $valor; }
        if($columna == 'descripcion'){ $descripcionFas = $valor; }
        if($columna == 'monto'){ $montoFas = $valor; }
        if($columna == 'tipo'){ $tipoFas = $valor; }
    }
    $fase->insertar_fase($id_curso, $nombreFas, $descripcionFas, $montoFas, $tipoFas);
}

$nombreCont; $instruccionesCont; $archivoCont; $faseCont; $tipoCont; $nombre_ruta;
foreach($contenidos as $renglon){
    foreach($renglon as $columna => $valor){
        if($columna == 'nombre'){ $nombreCont = $valor; }
        if($columna == 'instrucciones'){ $instruccionesCont = $valor; }
        if($columna == 'archivo'){ $archivoCont = $valor; }
        if($columna == 'fase'){ $faseCont = $valor; }
        if($columna == 'tipo'){ $tipoCont = $valor; } // si es 0 es un archivo que se tiene que subir, si es 1 es un link
        if($columna == 'name'){ $nombre_ruta = $valor; }
        if($columna == 'type'){ $tipo_ruta = $valor; }
    }
    if($tipoCont == 1){
        $contenido->insertar_contenido($id_curso, $faseCont, $nombreCont, $instruccionesCont, $archivoCont);
        
    } else {
        
        $nom_nuevo = uniqid() . $nombre_ruta;
        for ($i = 0; $i < count($content_names); $i++) {
            $file_name=$content_names[$i];
            if ($file_name == $nombre_ruta) {
                echo "<script> alert(contenido subiendose)</script>";
                move_uploaded_file($_FILES["archivoFile"]["tmp_name"][$i], $carpeta_destino . $nom_nuevo);
            }
        }
            
        $ruta_internet = 'Contenidos/' . $nom_nuevo;
        $contenido->insertar_contenido((int)$id_curso, (int)$faseCont, $nombreCont, $instruccionesCont, $ruta_internet);
        
    }
}





