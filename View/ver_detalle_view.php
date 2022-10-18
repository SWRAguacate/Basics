<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, user-scalable=yes,initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
    <title>
        <BASICS>
    </title>
    <link rel="stylesheet" href="CSS/estilos.css">
    <link rel="stylesheet" href="CSS/verdetalle.css">
    <script src="https://kit.fontawesome.com/9d0e50ae14.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="main-header">
        <div class="container container--flex">
            <div class="logo-container column column--50">
                <h1 class="logo">
                    < BASICS >
                </h1>
            </div>
        </div>
    </header>

    <nav class="main-nav">
        <div class="container container--flex">
            <i class="fas fa-bars" id="btnmenu"></i>
            <ul class="menu" id="menu">
                <li class="menu__item"><a href="index_usuario.php" class="menu__link">Inicio</a></li>
                <li class="menu__item"><a href="busqueda_usuario.php" class="menu__link">Busqueda</a></li>
                <li class="menu__item"><a href="carrito.php" class="menu__link">Carrito</a></li>
                <li class="menu__item"><a href="usuario.php" class="menu__link menu__link--select">Perfil</a></li>
                <li class="menu__item"><a href="Controller/cerrar_sesion_controller.php" class="menu__link">Cerrar Sesion</a></li>
            </ul>
        </div>
    </nav>

    <section>
        <div class="container3">
            <div class="profile-cursos">
                <h1 class="detalle-title">Detalle del Curso</h1>
                <h2 class="detalle-title">Total recaudado del curso: <?php echo $total_recaudado_curso; ?></h2>
                <div class="profile-miscursos">
                    <table>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Fecha de inscripción</th>
                            <th>Progreso</th>
                            <th>Precio pagado</th>
                            <th>Forma de pago</th>
                            <th>Curso Finalizado</th>
                         </tr>
                            <?php
                                foreach ($cursos as $renglon) { foreach ($renglon as $columna => $valor) { 
                                if ($columna == "id_usuario" && $valor != null) {  $id_usuario = $valor; }
                                if ($columna == "nombre" && $valor != null) {  $nombre = $valor; }
                                if ($columna == "pagado" && $valor != null) {  $pagado = $valor; }
                                if ($columna == "forma_pago" && $valor != null) {  $forma_pago2 = $valor; }
                                if ($columna == "fecha_inscripcion" && $valor != null) {  $fecha_inscripcion = $valor; }
                                if ($columna == "email" && $valor != null) {  $email = $valor; }
                                if ($columna == "fase_actual" && $valor != null) {  $fase_actual = $valor; }
                                if ($columna == "progreso" && $valor != null) {  $progreso = $valor; }
                                if ($columna == "curso_acabado" && $valor != null) { if($valor == 1){ $estatus = "fas fa-check-circle"; } 
                                else { $estatus = "fas fa-times-circle"; } } } ?>
                            <tr>
                                 <td><?php echo $nombre; ?></td>
                                 <td><?php echo $email; ?></td>
                                 <td><?php echo $fecha_inscripcion; ?></td>
                                 <td><?php echo $progreso; ?>%</td>
                                 <td><?php echo $pagado; ?></td>
                                 <td><?php echo $forma_pago2; ?></td>
                                 <td><i class="<?php echo $estatus; ?>"></i></td>
                             </tr>
                                 <?php } ?>
                    </table><br><br>
                    <a class="regresar" href="ver_cursos_creados.php">Regresar a mis cursos creados</a><br><br>
                </div>
            </div>
        </div>
    </section>



    <footer class="main-footer">
        <div class="container--flex">
            <div class="column column-332">
                <h2 class="column__title">
                    < BASICS >
                </h2><br>
            </div>
            <div class="column column-33">
                <h2 class="column__title">Siguenos en nuestras redes</h2>
                <p class="column__txt"><i class="fab fa-facebook-square">Facebook</i></p>
                <p class="column__txt"></p><i class="fab fa-twitter-square">Siguenos en Twitter</i></p>
                <p class="column__txt"></p><i class="fab fa-instagram-square">Siguenos en Instagram</i></p>
                <p class="column__txt"></p><i class="fab fa-youtube-square">Visita nuestro canal</i></p>
            </div>
        </div>
        <p class="copy"> &copy; < BASICS > | Todos los Derechos Reservados</p>
    </footer>

    <script src="JS/menu.js"></script>

</html>