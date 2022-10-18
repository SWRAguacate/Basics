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
    <link rel="stylesheet" href="CSS/categorias.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://kit.fontawesome.com/9d0e50ae14.js" crossorigin="anonymous"></script>
    <script src="JS/categoriasScript.js"></script>
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
                <li class="menu__item"><a href="busqueda_usuario.php" class="menu__link menu__link--select">Busqueda</a></li>
                <li class="menu__item"><a href="carrito.php" class="menu__link  ">Carrito</a></li>
                <li class="menu__item"><a href="usuario.php" class="menu__link">Perfil</a></li>
                <li class="menu__item"><a href="Controller/cerrar_sesion_controller.php" class="menu__link">Cerrar Sesion</a></li>
            </ul>
        </div>
    </nav>

        <section>
            <h1 class="categorias">BUSQUEDA AVANZADA</h1>
        </section>

        <form action="busqueda_usuario.php" method="post" class="filtros">
            <div>
                <p class="title-filtrar">Filtrar por:</p>
                <input class="filtro-check" id="filtro_fech_ini" name="filtro_fech_ini" type="checkbox" class="check">
                <label for="filtro">Fecha Inicial</label>

                <input class="filtro-check" id="filtro_fech_fin" name="filtro_fech_fin" type="checkbox" class="check">
                <label for="filtro">Fecha Final</label>

                <input class="filtro-check" id="filtro_categorias" name="filtro_categorias" type="checkbox" class="check">
                <label for="filtro">Categorías</label>

                <input class="filtro-check2" id="filtro_nom_usu" name="filtro_nom_usu" type="checkbox" class="check">
                <label for="filtro">Usuario</label>

                <input class="filtro-check2" id="filtro_nom_cur" name="filtro_nom_cur" type="checkbox" class="check">
                <label for="filtro">Curso</label>
            </div>

            <div class="filtro-fecha">
                <p class="fecha-title">Rango de Fecha</p>
                <input class="fecha-inicial" id="fech_ini" name="fech_ini" type="date">
                <input class="fecha-final" id="fech_fin" name="fech_fin" type="date">
            </div>

            <div class="filtro-categoria">
                <p>Categorías</p>
                <select class="categorias-combo" name="categorias" id="categorias">
                    <?php foreach ($categorias as $renglon) { foreach ($renglon as $columna => $valor) {
                            if ($columna == "id_categoria" && $valor != null) { $id_cat = $valor; }
                            if ($columna == "nombre" && $valor != null) { $nombre_cat = $valor; } }
                        echo "<option value='".$nombre_cat."'>".$nombre_cat."</option>"; } ?>
                </select>
            </div>

            <div class="filtro-titulo-usuario">
                <p class="usuario-text">Usuario</p>
                <input class="buscar-input" id="nom_usu" name="nom_usu" type="text" placeholder="Buscar.." >
            </div>

            <div class="filtro-titulo-usuario">
                <p class="usuario-text">Curso</p>
                <input class="buscar-input" id="nom_cur" name="nom_cur" type="text" placeholder="Buscar.." >
            </div><br>

            <button class="btn-filtrar">Filtrar</button>
        </form><br>
            
        <section class="group mas-vendidos">
            <div class="container container--flex">
                <?php
               foreach ($resultados_busqueda as $renglon) { foreach ($renglon as $columna => $valor) {
               if ($columna == "id_curso" && $valor != null) {  $id_cur = $valor; }
               if ($columna == "titulo" && $valor != null) {  $titulo = $valor; }
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
                    <div class="mas-vendidos__title" onclick="redireccionar(<?php echo $id_cur; ?>);" ><?php echo $titulo; ?></div>
                    <p class="mas-vendidos__descripcion"><?php echo $descripcion; ?></p>
                    <div class="mas-vendidos__calif"><i class="fas fa-thumbs-up"></i><?php echo $total_likes; ?></div>
                    <div class="mas-vendidos__price">$<?php echo $precio; ?></div>
                    <form action="Controller/btn_agregar_curso_carrito.php" method="post">
                        <input type="text" name="id_curso" id="id_curso" value="<?php echo $id_cur ?>" hidden="true">
                        <input type="text" name="origen" id="origen" value="b" hidden="true">
                        <input class="mas-vendidos__boton" type="submit" data-id="<?php echo $i ?>" value="Agregar al Carrito">
                    </form>
                </div> <?php $i++;} ?>
            <br>
            </div>
        </section>
        <section class="paginacion">
            <ul>
        <?php for ($p = 1; $p<=$total_paginas;$p++)  { ?>
                <li><a href="pagina_busqueda_usuario.php?param1=<?php echo $fecha_ini; ?>&param2=<?php echo $fecha_fin; ?>&param3=<?php echo $categoria_peticion; ?>&param4=<?php echo $nom_usu; ?>&param5=<?php echo $nom_cur; ?>&param6=<?php echo $p; ?>"><?php echo $p; ?></a></li>
            <?php } ?>
        </ul>
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
    </body>
    <script type="text/javascript">
    function redireccionar(id){
      window.location.href='info_curso.php?id_curso='.concat(id);
    } 
    </script>
</html>