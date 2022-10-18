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
    <link rel="stylesheet" href="CSS/perfil-maestro.css">
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
                        <p class="desde">Desde: <?php echo $fech_cre ?></p>
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
                    <div class="profile-cursos">
                        <h1>Mis cursos creados</h1>
                        <button class="chatbtn" style=" width: 40%;"><a href="agrega_curso.php">
                         Agregar curso</a>
                    </button>
                        <div class="profile-miscursos">
                            <table>
                                <tr>
                                  <th>Cursos</th>
                                  <th>Ventas</th>
                                  <th>Alumnos</th>  
                                  <th>Total de Likes</th>
                                  <th>Total de Dislikes</th>
                                  <th>Nivel promedio que se cursa</th>
                                  <th>Estado</th>
                                  <th>Acciones</th>
                                </tr>
                                <?php 
                                foreach ($cursos_paginados as $renglon) { foreach ($renglon as $columna => $valor) { 
                                if ($columna == "id_curso" && $valor != null) {  $id_curso = $valor; }
                                if ($columna == "titulo" && $valor != null) {  $titulo = $valor; }
                                if ($columna == "total_recaudado" && $valor != null) {  $total_recaudado = $valor; }
                                if ($columna == "total_alumnos" && $valor != null) {  $total_alumnos = $valor; }
                                if ($columna == "total_likes" && $valor != null) {  $total_likes = $valor; }
                                if ($columna == "total_dislikes" && $valor != null) {  $total_dislikes = $valor; }
                                if ($columna == "nivel_promedio" && $valor != null) {  $nivel_prom = $valor; }
                                if ($columna == "estatus" && $valor != null) { if($valor == 1){ $estatus = "fas fa-check-circle"; } 
                                else { $estatus = "fas fa-times-circle"; } } } ?>
                                <tr>
                                  <td><?php echo $titulo; ?></td>
                                  <td>$<?php echo $total_recaudado; ?></td>
                                  <td><?php echo $total_alumnos; ?> <br><a class="progress" href="detalle_curso.php?id_curso=<?php echo $id_curso; ?>">Ver Progreso</a></td>
                                  <td><?php echo $total_likes; ?></td>
                                  <td><?php echo $total_dislikes; ?></td>
                                  <td><?php echo $nivel_prom; ?></td>
                                  <td><i class="<?php echo $estatus; ?>"></i></td>
                                  <?php if($estatus == "fas fa-check-circle") { ?>
                                  <td>
                                      <button class="btn-edit"><a href="edita_curso.php?id_curso=<?php echo $id_curso; ?>" class="btn-edit" style="color: black;">Editar</a></button>
                                      <button class="btn-delete"><a href="Controller/btn_elimina_curso.php?id_curso=<?php echo $id_curso; ?>" class="btn-delete" style="color: black;">Eliminar</a></button>
                                  </td>
                                  <?php } ?>
                                </tr>
                                 <?php } ?>
                              </table>
                        </div>
                            <section class="paginacion">
            <ul>
        <?php for ($p = 1; $p<=$total_paginas;$p++)  { ?>
                <li><a href="cursos_creados_busqueda.php?param1=<?php echo $p; ?>"><?php echo $p; ?></a></li>
            <?php } ?>
        </ul>
   </section>
                        <div class="profile-miscursos">
                            <table>
                                <tr>
                                  <th>Formas de pago</th>
                                  <th>Lo que recaudaron sus cursos</th>
                                </tr>
                                <?php 
                                foreach ($formas_pago_total as $renglon) { foreach ($renglon as $columna => $valor) { 
                                if ($columna == "nombre" && $valor != null) {  $nombre = $valor; }
                                if ($columna == "total_fp" && $valor != null) {  $total_fp = $valor; } } ?>
                                <tr>
                                  <td><?php echo $nombre; ?></td>
                                  <td>$ <?php echo $total_fp; ?></td>
                                </tr>
                                 <?php } ?>
                              </table>
                        </div>
<a class="regresar" href="usuario.php">Regresar a los adquiridos</a><br><br>
                    </div>
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