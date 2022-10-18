<?php

require_once ("../Model/curso_model.php");
require_once ("../Model/categoria_curso_model.php");
require_once ("../Model/fase_model.php");
require_once ("../Model/contenido_model.php");

session_start();
if(!isset($_SESSION["usuario_logueado"])){
    header('Location: ../index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

foreach ($usuario_logueado as $renglon) { foreach ($renglon as $columna => $valor) {
if ($columna == "id_usuario" && $valor != null) {  $id_autor = $valor; } } }
        
$curso = new curso_model();
$categoria_curso = new categoria_curso_model();
$fase = new fase_model();
$contenido = new contenido_model();

$curso_agregar = json_decode($_POST['curso'],true);   
$categorias = json_decode($_POST['categorias'],true);
$fases = json_decode($_POST['fases'],true);
$contenidos = json_decode($_POST['contenidos'],true);

$id_cur; $tituloCur; $descripcionCur; $imagenCur; $precioCur; $tipoCur;
foreach($curso_agregar as $renglon){
    foreach($renglon as $columna => $valor){
        if($columna == 'id_curso'){ $id_cur = $valor; }
        if($columna == 'titulo'){ $tituloCur = $valor; }
        if($columna == 'descripcion'){ $descripcionCur = $valor; }
        if($columna == 'imagen'){ $imagenCur = $valor; }
        if($columna == 'precio'){ $precioCur = $valor; }
        if($columna == 'tipo'){ $tipoCur = $valor; }
        if($columna == 'name'){ $nombre_ruta = $valor; }
        if($columna == 'type'){ $tipoImg = $valor; }
        if($columna == 'size'){ $tamanio_ruta = $valor; }
    }
    
    //$archivo_objetivo = fopen($carpeta_destino . $nombre_ruta, "r");
    //$contenido_img = fread($archivo_objetivo, $tamanio_ruta);
    
    //$curso->insertar_curso($id_autor, $tituloCur, $descripcionCur, $contenido_img, $precioCur, $tipoCur);
    //fclose($archivo_objetivo);
}

foreach($categorias as $columna => $valor){
    $categoria_curso->insertar_categoria_curso($valor, $id_cur);
}

$nombreFas; $descripcionFas; $montoFas; $tipoFas;
foreach($fases as $renglon){
    foreach($renglon as $columna => $valor){
        if($columna == 'nombre'){ $nombreFas = $valor; }
        if($columna == 'descripcion'){ $descripcionFas = $valor; }
        if($columna == 'monto'){ $montoFas = $valor; }
        if($columna == 'tipo'){ $tipoFas = $valor; }
    }
    $fase->insertar_fase($id_cur, $nombreFas, $descripcionFas, $montoFas, $tipoFas);
}

$nombreCont; $instruccionesCont; $archivoCont; $faseCont; $tipoCont;
foreach($contenidos as $renglon){
    foreach($renglon as $columna => $valor){
        if($columna == 'nombre'){ $nombreCont = $valor; }
        if($columna == 'instrucciones'){ $instruccionesCont = $valor; }
        if($columna == 'archivo'){ $archivoCont = $valor; }
        if($columna == 'fase'){ $faseCont = $valor; }
        if($columna == 'tipo'){ $tipoCont = $valor; } // si es 0 es un archivo que se tiene que subir, si es 1 es un link
        if($columna == 'name'){ $nombre_ruta = $valor; }
        if($columna == 'type'){ $tipo_ruta = $valor; }
        if($columna == 'size'){ $tamanio_ruta = $valor; }
        if($columna == 'iteracion'){ $l = $valor; }
    }
    if($tipoCont == 1){
        $contenido->insertar_contenido($id_cur, $faseCont, $nombreCont, $instruccionesCont, $archivoCont);
        
    } else {
        
        $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/Basics/MVC/Contenidos/';
        $nom_nuevo = uniqid() . $nombre_ruta;
        
        rename($carpeta_destino . $nombre_ruta, $carpeta_destino . $nom_nuevo);
        //rename('../Contenidos/' . $nombre_ruta, '../Contenidos/' . $nom_nuevo);
            
        $ruta_internet = 'Contenidos/' . $nom_nuevo;
        $contenido->insertar_contenido((int)$id_cur, (int)$faseCont, $nombreCont, $instruccionesCont, $ruta_internet);
        
    }
}