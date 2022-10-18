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
    <link rel="stylesheet" href="CSS/infoCurso.css">
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
<!--            <div class="buscar">
                <input type="text" placeholder="Buscar..." required>
                <div class="btn">
                    <i class="fas fa-search"></i>
                </div>
            </div>-->
            <i class="fas fa-bars" id="btnmenu"></i>
            <ul class="menu" id="menu">
                <li class="menu__item"><a href="index.php" class="menu__link">Inicio</a></li>
                <li class="menu__item"><a href="busqueda.php" class="menu__link">Busqueda</a></li>
                <li class="menu__item"><a href="sesion.php" class="menu__link">Iniciar Sesion</a></li>

            </ul>
        </div>
    </nav>

    <section class="InfoCurso">
        <div class="container-info">
            <h2 class="Titulo-curso"><?php echo $titulo_curso; ?></h2>
            <h5 class="nombre-maestro">Por: <?php echo $nombre_autor; ?></h5>
            <h4 class="separacion">.....................................................................</h4>

            <div class="informacion-valoracion">
                <div class="precio">$<?php echo $precio_curso; ?></div>
                <?php if(!isset($foto)){?>
                <img class="img-curso" src="IMGUSUARIOS/curso.jpg" alt="">
                <?php } else { echo $img; }?>
            </div>

            <div class="descripcion-curso">
                <h2 class="title-descripcion">Descripcion del Curso</h2>
                <p class="descripcion"> <?php echo $descripcion_curso; ?> </p>
            </div>

            <div class="contenido-curso">
                <h2 class="title-contenido">Contenido del Curso</h2>
                <table class="Curso">
                    <tr>
                      <th>Fases:</th>
                      <th>Contenidos:</th>
                    </tr>
                    <?php 
                 foreach ($contenido_curso as $renglon) { foreach ($renglon as $columna => $valor) {
                     if ($columna == "fase" && $valor != null) {  $nombre_fase = $valor; }
                     if ($columna == "contenido" && $valor != null) {  $nombre_contenido = $valor; } } ?> 
                    <tr>
                        <?php if($fas != $nombre_fase) { ?>
                      <td> <?php echo $nombre_fase; $fas =$nombre_fase;  ?></td>
                        <?php } else { ?>
                      <td>  </td>
                        <?php } ?>
                      <td> <?php echo $nombre_contenido; ?></td>
                    </tr>
            <?php } ?>
                  </table>
            </div>

            <h2 class="title-comentarios">Comentarios del Curso</h2>
            <?php if (count($comentarios) > 0) {
                 foreach ($comentarios as $renglon) { foreach ($renglon as $columna => $valor) {
                     if ($columna == "nombre" && $valor != null) {  $autor_comentario = $valor; }
                     if ($columna == "comentario" && $valor != null) {  $contenido_comentario = $valor; }
                     if ($columna == "foto" && $valor != null) {  $foto2 = $valor;
                     $img2 = "<img src='data:image/*; base64," . base64_encode($foto2) . "' class='img-comentarios'>"; } } ?> 
                    <div>
                    <div class="Comentarios-curso">
                    <div class="datos-comentarios">
                    <?php if(!isset($foto2)){?>
                    <img class="img-comentarios" src="IMGUSUARIOS/avatardefault.webp">
                    <?php } else { echo $img2; }?>
                    <h4 class="nombre-usuario"><?php echo $autor_comentario; ?></h4>
                    <p class="comentario"><?php echo $contenido_comentario; ?></p>
                    </div> </div>
                    <h4 class="separacion">..........................................................................</h4> </div>
            <?php } } else { ?> 
                    <h2 class="title-comentarios">Aun no existen comentarios.</h2>
            <?php }  ?> 
        </div>

        <div class="container-info2">
            <?php if($likes_curso == 0 && $dislikes_curso == 0) { ?>
            <div class="cont"><i class="fas fa-thumbs-up"></i>Sin porcentaje de valoración.</div>
            <?php } else { ?>
            <div class="cont"><i class="fas fa-thumbs-up"></i><?php echo $porcentaje_likes_curso; ?>% de valoraciones positivas.</div>
            <?php } ?>
            <div class="cont"><i class="fas fa-users"></i><?php echo $alumnos_curso; ?> alumnos.</div>
            <div class="cont"><i class="fas fa-thumbs-up"></i><?php echo $likes_curso; ?> likes.</div>
            <div class="cont"><i class="fas fa-thumbs-down"></i><?php echo $dislikes_curso; ?> dislikes.</div>
            <div class="cont"><i class="fas fa-star"></i>Diploma al terminar el curso.</div>
            <form action="sesion.php" method="post">
            <button  class="btn-comprar">Inicia sesion</button>
            </form>
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

</body>
<script type="text/javascript">
    function aviso(){
      alert('Se necesita una sesion activa para completar esta acción')
    }
    </script>
</html>