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
        <link rel="stylesheet" href="CSS/perfil.css">
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
<!--                <div class="buscar">
                    <input type="text" placeholder="Buscar..." required>
                    <div class="btn">
                        <i class="fas fa-search"></i>
                    </div>
                </div>-->
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
                <div class="profile-header">
                    <div class="profile-img">
                        <?php if(!isset($foto)){?>
                        <img src="IMGUSUARIOS/avatardefault.webp" alt="" width="200">
                        <?php } else { echo $img; }?>
                    </div>
                    
                    <div class="profile-nav-info">
                        <h3 class="user-name"><?php echo $nombre ?></h3>
                        
                        <div class="fechainicio">
                            <p class="desde"> Desde: <?php echo $fech_cre ?></p>
                        </div>
                    </div>
                </div>
                <div class="main-bd">
                    <div class="left-side">
                        <div class="profile-side">
                            <p class="mail"><i class="fas fa-at"></i><?php echo $email ?></p>
                            <div class="user-rol"><i class="fas fa-user-graduate"></i><?php echo $tipo ?></div>
                            <div class="profile-btn">
                                <button class="chatbtn"><a href="mensajes.php">
                                        <i class="far fa-comment"></i> Chat </a>
                                </button>
                                <button class="editbtn"><a href="editar_perfil.php">
                                        <i class="fas fa-user-edit"></i> Editar </a>
                                </button>
                            </div>
                            <div class="fechaedit">
                                <h5 class="modificar-title">
                                    Ultima Modificacion: <?php echo $fech_mod ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="right-side">
                        <div class="nav">
                            <ul>
                                <li class="user-miscursos"></li>
                            </ul>
                        </div>
                        <div class="profile-cursos">
                            <h1>Mis cursos</h1>
                                <?php 
                                foreach ($cursos_paginados as $renglon) { foreach ($renglon as $columna => $valor) { 
                                if ($columna == "id_curso" && $valor != null) {  $id_curso = $valor; }
                                if ($columna == "titulo" && $valor != null) {  $titulo = $valor; }
                                if ($columna == "nombre_usuario" && $valor != null) {  $nombre_usuario = $valor; }
                                if ($columna == "progreso" && $valor != null) {  $progreso_curso = $valor; }
                                if ($columna == "categorias" && $valor != null) {  $categorias = $valor; }
                                if ($columna == "imagen" && $valor == null) { 
                                    $img = 'IMGUSUARIOS/curso.jpg';  }
                                else if ($columna == "imagen") { $foto = $valor; 
                                    $img = 'data:image/*; base64,' . base64_encode($foto);  }
                                if ($columna == "total_likes" && $valor != null) {  $total_likes = $valor; }
                                if ($columna == "precio" && $valor != null) {  $precio = $valor; } } ?>
                                <div class="profile-miscursos">
                                    <img src="<?php echo $img; ?>" alt="">
                                    <ul class="datoscurso">
                                    <li class="curso-title"><?php echo $titulo; ?></li><br>
                                    <li class="nombre-maestro">Autor: <?php echo $nombre_usuario; ?></li>
                                    <li class="categoria">Categorias: <?php echo $categorias; ?></li>
                                    <li class="categoria">Progreso: <progress style="margin-left: 5px; margin-top: 2px; font-size: 1rem;" 
                                                                                                                            id="file" value="<?php echo $progreso_curso; ?>" max="100"></progress></li>
                                    <form action="ver_curso.php" method="post">
                                        <input type="text" name="id_curso" id="id_curso" value="<?php echo $id_curso ?>" hidden="true">
                                        <button class="vercurso" > Ver curso </button>
                                    </form>
                                    </ul>
                                </div>
                                 <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="paginacion">
            <ul>
        <?php for ($p = 1; $p<=$total_paginas;$p++)  { ?>
                <li><a href="perfil_busqueda.php?param1=<?php echo $p; ?>"><?php echo $p; ?></a></li>
            <?php } ?>
        </ul>
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

</html>