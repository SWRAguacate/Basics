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
    <link rel="stylesheet" href="CSS/vercurso.css">
<!--    <script src="html2pdf.bundle.min.js"></script>-->
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
    
    <?php if($total_progresos != $total_fases) { $fases_faltantes = $total_fases - $total_progresos;?>
            <div class="title-fase"> <?php if ($fases_faltantes == 1) { ?> A usted le falta:  1 fase
                <?php } else { ?> A usted le faltan: <?php echo $fases_faltantes; ?> fases <?php } ?> </div><br>
           <form method="POST">
                    <input type="text" name="id_curso_carrito" id="id_curso_carrito" value="<?php echo $id_curso ?>" hidden="true">
                    <input type="text" name="id_curso" id="id_curso" value="<?php echo $id_curso ?>" hidden="true">
                    <button class="terminar">✓ Agregar al carrito fases faltantes</button>
                </form>
    <?php } ?>

    <section class="container-izq">
        <div class="container-video">
            <h2 class="title-curso"><?php echo $titulo; ?></h2>
            <div class="title-maestro">Por: <?php echo $nom_autor; ?></div><br>
            <hr><br>
            <div class="title-fase">Contenido actual: <?php echo $nombre_contenido_actual; ?></div><br>

            <iframe width="1000" 
                    height="500" 
                    src="<?php echo $url_contenido; ?>" 
                    title="<?php echo $nombre_contenido_actual; ?>" frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen style="background-color: graytext;" >
            </iframe>

            <div class="btn-finish">
                <form action="ver_curso.php" method="post">
                    <input type="text" name="id_curso" id="id_curso" value="<?php echo $id_curso ?>" hidden="true">
                    <input type="text" name="fin_fase" id="fin_fase" value="<?php echo $fase_actual ?>" hidden="true">
                    <button class="terminar">✓ Marcar fase como terminada</button>
                </form>
            </div>
            
            <?php if ($total_progresos_finalizados == $total_fases){ ?>
            <div class="btn-finish">
               <a href="Controller/ver_pdf_controller.php?nom_autor=<?php echo $nom_autor; ?>&nom_curso=<?php echo $titulo; ?>"> <button class="terminar">✓ Descargar certificado</button></a>
            </div><br>
            <?php } ?>

        </div>
    </section><br>

    <section class="container-right">
        <?php foreach ($fases as $renglon) { foreach ($renglon as $columna => $valor) {
        if ($columna == "nombre" && $valor != null) { $nom_fas = $valor; }
        if ($columna == "id_fase" && $valor != null) { $contenidos = $contenido->ver_contenidos_fase($valor); } } ?>
        <div class="info-curso">
            <?php $var = false; foreach ($resul9 as $renglon){ foreach ($renglon as $columna => $valor){
            if ($valor == $nom_fas) { $var = true; } } } if ($var) { ?>
            <div class="nombre-curso2"><?php echo $nom_fas; ?> - Finalizada</div><br>
            <?php } else { ?>
            <div class="nombre-curso"><?php echo $nom_fas; ?></div><br>
            <?php } ?>
            <?php foreach ($contenidos as $renglon) { foreach ($renglon as $columna => $valor) {
            if ($columna == "nombre" && $valor != null) { $nom_cont = $valor; }
            if ($columna == "id_contenido" && $valor != null) { $id_cont = $valor; }
            if ($columna == "id_fase" && $valor != null) { $id_fas = $valor; }
            if ($columna == "descripcion" && $valor != null) { $descripcion = $valor; }
            if ($columna == "precio" && $valor != null) { $precio = $valor; }
            if ($columna == "tipo" && $valor != null) { $tipo = $valor; }
            if ($columna == "fecha" && $valor != null) { $fecha = $valor; } } ?>
            <div class="fases">
                <input type="text" name="id_fas" id="id_fas" value="<?php echo $id_fas ?>" hidden="true">
                <input type="text" name="id_cont" id="id_cont" value="<?php echo $id_cont ?>" hidden="true">
                <div class="circle circle--gray circle--lg"><?php echo $it; $it++;?></div>
                <?php if ($var) { ?>
                <a href="ver_contenido.php?id_fase=<?php echo $id_fas ?>&id_contenido=<?php echo $id_cont ?>&id_cur=<?php echo $id_curso ?>" class="nombre-fase2"><?php echo $nom_cont; ?> - Finalizado</a>
                <?php } else {  ?>
                <a href="ver_contenido.php?id_fase=<?php echo $id_fas ?>&id_contenido=<?php echo $id_cont ?>&id_cur=<?php echo $id_curso ?>" class="nombre-fase"><?php echo $nom_cont; ?></a>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
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