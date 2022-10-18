<?php

require_once ("Model/usuario_model.php");
require_once ("Model/busqueda_avanzada_model.php");

$curso = new busqueda_avanzada_model();
$mas_vendidos = $curso->mas_vendidos();
$mas_recientes = $curso->mas_recientes();
$mejor_calificados = $curso->mejor_calificados();
$foto; $img; $titulo; $descripcion; $categorias; $total_likes; $precio; $cursos_vendidos; $i = 1;

require_once ("View/inicio2_view.php");