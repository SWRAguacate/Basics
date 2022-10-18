<?php

require_once '../Archivos/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

//if (!isset($_GET['pdf'])) {
//    $content = '<html>';
//    $content .= '<head>';
//    $content .= '<style>';
//    $content .= 'body { font-family: DejaVu Sans; }';
//    $content .= '</style>';
//    $content .= '</head><body>';
//    $content .= '<h1>Ejemplo generaci&oacute;n PDF</h1>';
//    $content .= '<a href="../Controller/ver_pdf_controller.php?pdf=1">Generar documento PDF</a>';
//    $content .= '</body></html>';
//    echo $content;
//    exit;
//}

session_start();
if(!isset($_SESSION["usuario_logueado"])){
    header('Location: ../index.php');
    die();
} else {
    $usuario_logueado = $_SESSION["usuario_logueado"];
}

$nombre_maestro = $_GET['nom_autor'];
$nombre_curso = $_GET['nom_curso'];

$id; $nombre_alumno;
    foreach ($usuario_logueado as $renglon) { foreach ($renglon as $columna => $valor) { 
        if ($columna == "id_usuario" && $valor != null) {  $id = $valor; }
        if ($columna == "nombre" && $valor != null) {  $nombre_alumno = $valor; } } }

$content = '<html>';
$content .= '<head>';
    $content .= '<title>certificado</title>';
$content .= '</head>';

$content .= '<body>';
    $content .= '<div class="container">';
        $content .= '<h1>';
            $content .= '< BASICS >';
        $content .= '</h1>';
        $content .= '<h3 style="padding-top = 20px;">Certificado de Reconocimiento</h3>';
        $content .= '<div>Este certificado se concede a:</div>';
        $content .= '<h2>'.$nombre_alumno.'</h2>';
        $content .= '<div>por haber finalizado el curso de:</div>';
        $content .= '<div class="nombre-curso">'.$nombre_curso.'</div>';
        $content .= '<h4>'.$nombre_maestro.'</h4>';
        $content .= '<div>Titular</div>';
//        $content .= '<img src="../IMGUSUARIOS/oscar.jpg" alt="">';
    $content .= '</div>';
$content .= '</body>';

$content .= '<style>';
    $content .= "@import url('https://fonts.googleapis.com/css2?family=Aleo:wght@300&family=Clicker+Script&family=Klee+One:wght@600&display=swap');";

    $content .= '* {';
        $content .= 'background-color: #ccd1d9;';
        $content .= 'color: #141414;';
        $content .= "font-family: 'Aleo', serif;";
    $content .= '}';

    $content .= '.certificado {';
        $content .= 'position: absolute;';
        $content .= 'border: 1px solid #5CE1E6;';
        $content .= 'left: 50%;';
        $content .= 'top: 100%;';
        $content .= 'cursor: pointer;';
        $content .= 'height: 40px;';
        $content .= 'width: 100px;';
    $content .= '}';

    $content .= 'h1 {';
        $content .= 'color: #fff;';
        $content .= "font-family: 'Klee One', cursive;";
        $content .= 'font-size: 3.5em;';
//        $content .= 'margin-top: 20px;';
    $content .= '}';

    $content .= '.container {';
        $content .= 'height: 650px;';
        $content .= 'width: 1000px;';
        $content .= 'text-align: center;';
        $content .= 'align-items: center;';
//        $content .= 'border: 3px solid #61CF31;';
//        $content .= 'position: absolute;';
        $content .= 'left: 0%;';
        $content .= 'padding-top: 50px;';
    $content .= '}';

    $content .= 'img {';
        $content .= 'width: 300px;';
        $content .= 'height: 300px;';
        $content .= 'background: none;';
        $content .= 'position: relative;';
        $content .= 'top: -139px;';
        $content .= 'left: -450px;';
    $content .= '}';

    $content .= 'h3 {';
        $content .= 'color: #5CE1E6;';
        $content .= 'font-size: 2.0em;';
//        $content .= 'margin-top: 40px;';
    $content .= '}';

    $content .= 'h2 {';
        $content .= 'color: #5CE1E6;';
        $content .= 'font-size: 4.0em;';
        $content .= 'font-weight: bold;';
        $content .= 'margin-left: 10%;';
        $content .= 'margin: 5px;';
        $content .= 'margin-top: 30px;';
        $content .= 'letter-spacing: 0.2em;';
    $content .= '}';

    $content .= 'div {';
        $content .= 'font-size: 1.2em;';
    $content .= '}';

    $content .= '.nombre-curso {';
        $content .= 'font-size: 1.4em;';
        $content .= 'margin-top: 10px;';
        $content .= 'color: #32662f;';
        $content .= 'font-weight: bold;';
    $content .= '}';

    $content .= 'h4 {';
        $content .= "font-family: 'Clicker Script', cursive;";
        $content .= 'font-size: 2.0em;';
        $content .= 'border-bottom: 2px solid #32662f;';
        $content .= 'width: 400px;';
        $content .= 'position: relative;';
        $content .= 'left: 30%;';
        $content .= 'margin: 5px;';
        $content .= 'margin-top: 50px;';
    $content .= '}';
$content .= '</style>';

$content .= '</html>';

//echo $content;
//    exit;

$dompdf = new Dompdf();
$dompdf->loadHtml($content);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$pdf = $dompdf->output();
$dompdf->stream();

header('Location: ../usuario.php');