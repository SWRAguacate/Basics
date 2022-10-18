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
    <script src="JS/jquery.js"></script>
    <link rel="stylesheet" href="CSS/estilos.css">
    <script src="https://kit.fontawesome.com/9d0e50ae14.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="main-header">
        <div class="container container--flex">
            <div class="logo-container column column--50">
                <h1 class="logo"> < BASICS > </h1>
            </div>
        </div>
    </header>


    <nav class="main-nav">
        <div class="container container--flex">
            <i class="fas fa-bars" id="btnmenu"></i>
            <ul class="menu" id="menu">
                <li class="menu__item"><a href="index_usuario.php" class="menu__link menu__link--select">Inicio</a></li>
                <li class="menu__item"><a href="busqueda_usuario.php" class="menu__link">Busqueda</a></li>
                <li class="menu__item"><a href="carrito.php" class="menu__link  ">Carrito</a></li>
                <li class="menu__item"><a href="usuario.php" class="menu__link">Perfil</a></li>
                <li class="menu__item"><a href="Controller/cerrar_sesion_controller.php" class="menu__link">Cerrar Sesion</a></li>
            </ul>
        </div>
    </nav>

    <section class="banner">
        <img src="IMGUSUARIOS/banner.jpg" alt="" class="banner__img">
        <div class="banner__content">Aprende a programar con nuestros cursos</div>
    </section>


    <section id="lista-catalogo" class="group mas-vendidos">
        <h2 class="group__title">Los más adquiridos: </h2>
        <div class="container container--flex">
            <?php
               foreach ($mas_vendidos as $renglon) { foreach ($renglon as $columna => $valor) { 
               if ($columna == "titulo" && $valor != null) {  $titulo = $valor; }
               if ($columna == "id_curso" && $valor != null) {  $id_cur = $valor; }
               if ($columna == "descripcion" && $valor != null) {  $descripcion = $valor; }
               if ($columna == "Categorias" && $valor != null) {  $categorias = $valor; }
               if ($columna == "imagen" && $valor == null) { 
                   $img = 'IMGUSUARIOS/curso.jpg';  }
              else if ($columna == "imagen") { $foto = $valor; 
              $img = 'data:image/*; base64,' . base64_encode($foto);  }
              if ($columna == "total_likes" && $valor != null) {  $total_likes = $valor;  }
              if ($columna == "precio" && $valor != null) {  $precio = $valor; }
              if ($columna == "cursos_vendidos" && $valor != null) {  $cursos_vendidos = $valor; }
              } ?>
                    <div class="column column--50-25">
                    <img src="<?php echo $img; ?>" alt="" class="mas-vendidos__img" onclick="redireccionar(<?php echo $id_cur; ?>);">
                    <div class="mas-vendidos__title" onclick="redireccionar(<?php echo $id_cur; ?>);"><?php echo $titulo; ?></div>
                    <p class="mas-vendidos__descripcion"><?php echo $descripcion; ?></p>
                    <div class="mas-vendidos__calif"><i class="fas fa-thumbs-up"></i><?php echo $total_likes; ?></div>
                    <div class="mas-vendidos__price">$<?php echo $precio; ?></div>
                    <form action="Controller/btn_agregar_curso_carrito.php" method="post">
                        <input type="text" name="id_curso" id="id_curso" value="<?php echo $id_cur ?>" hidden="true">
                        <input type="text" name="origen" id="origen" value="i" hidden="true">
                        <input class="mas-vendidos__boton" type="submit" data-id="<?php echo $i ?>" value="Agregar al Carrito">
                    </form>
                </div> <?php $i++;} ?>
        </div>
    </section>

    <section class="group mas-recientes">
        <h2 class="group__title">Los más recientes:</h2>
        <div class="container container--flex">
            <?php
               foreach ($mas_recientes as $renglon) { foreach ($renglon as $columna => $valor) { 
               if ($columna == "titulo" && $valor != null) {  $titulo = $valor; }
               if ($columna == "id_curso" && $valor != null) {  $id_cur = $valor; }
               if ($columna == "descripcion" && $valor != null) {  $descripcion = $valor; }
               if ($columna == "Categorias" && $valor != null) {  $categorias = $valor; }
               if ($columna == "imagen" && $valor == null) { 
                   $img = 'IMGUSUARIOS/curso.jpg';  }
              else if ($columna == "imagen") { $foto = $valor; 
              $img = 'data:image/*; base64,' . base64_encode($foto);  }
              if ($columna == "total_likes" && $valor != null) {  $total_likes = $valor;  }
              if ($columna == "precio" && $valor != null) {  $precio = $valor; }
              if ($columna == "cursos_vendidos" && $valor != null) {  $cursos_vendidos = $valor; }
              } ?>
                    <div class="column column--50-25">
                    <img src="<?php echo $img; ?>" alt="" class="mas-recientes__img" onclick="redireccionar(<?php echo $id_cur; ?>);">
                    <div class="mas-recientes__title" onclick="redireccionar(<?php echo $id_cur; ?>);"><?php echo $titulo; ?></div>
                    <p class="mas-recientes__descripcion"><?php echo $descripcion; ?></p>
                    <div class="mas-recientes__calif"><i class="fas fa-thumbs-up"></i><?php echo $total_likes; ?></div>
                    <div class="mas-recientes__price">$<?php echo $precio; ?></div>
                    <form action="Controller/btn_agregar_curso_carrito.php" method="post">
                        <input type="text" name="id_curso" id="id_curso" value="<?php echo $id_cur ?>" hidden="true">
                        <input type="text" name="origen" id="origen" value="i" hidden="true">
                        <input class="mas-recientes__boton" type="submit" data-id="<?php echo $i ?>" value="Agregar al Carrito">
                    </form>
                </div><?php $i++;} ?>
        </div>
    </section>

    <section class="group mejor-calificados">
        <h2 class="group__title">Mejor calificados:</h2>
        <div class="container container--flex">
            <?php
               foreach ($mejor_calificados as $renglon) { foreach ($renglon as $columna => $valor) { 
               if ($columna == "titulo" && $valor != null) {  $titulo = $valor; }
               if ($columna == "id_curso" && $valor != null) {  $id_cur = $valor; }
               if ($columna == "descripcion" && $valor != null) {  $descripcion = $valor; }
               if ($columna == "Categorias" && $valor != null) {  $categorias = $valor; }
               if ($columna == "imagen" && $valor == null) { 
                   $img = 'IMGUSUARIOS/curso.jpg';  }
              else if ($columna == "imagen") { $foto = $valor; 
              $img = 'data:image/*; base64,' . base64_encode($foto);  }
              if ($columna == "total_likes" && $valor != null) {  $total_likes = $valor;  }
              if ($columna == "precio" && $valor != null) {  $precio = $valor; }
              if ($columna == "cursos_vendidos" && $valor != null) {  $cursos_vendidos = $valor; }
              } ?>
                    <div class="column column--50-25">
                    <img src="<?php echo $img; ?>" alt="" class="mejor-calificados__img" onclick="redireccionar(<?php echo $id_cur; ?>);">
                    <div class="mejor-calificados__title" onclick="redireccionar(<?php echo $id_cur; ?>);"><?php echo $titulo; ?></div>
                    <p class="mejor-calificados__descripcion"><?php echo $descripcion; ?></p>
                    <div class="mejor-calificados__calif"><i class="fas fa-thumbs-up"></i> <?php echo $total_likes; ?></div>
                    <div class="mejor-calificados__price">$<?php echo $precio; ?></div>
                    <form action="Controller/btn_agregar_curso_carrito.php" method="post">
                        <input type="text" name="id_curso" id="id_curso" value="<?php echo $id_cur ?>" hidden="true">
                        <input type="text" name="origen" id="origen" value="i" hidden="true">
                        <input class="mejor-calificado__boton" type="submit" data-id="<?php echo $i ?>" value="Agregar al Carrito">
                    </form>
                </div><?php $i++;} ?>
        </div>
    </section>

    <footer class="main-footer">
        <div class="container--flex">
            <div class="column column-332">
                <h2 class="column__title"> < BASICS > </h2><br>
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
    <script text="text/javascript" src="JS/carrito.js"></script>
</body>
<script type="text/javascript">
    function redireccionar(id){
      window.location.href='info_curso.php?id_curso='.concat(id);
    }
    </script>
</html>