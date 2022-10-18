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
    <link rel="stylesheet" href="CSS/mensaje_1.css">
    <script src="https://kit.fontawesome.com/9d0e50ae14.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
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
        <div id="form-enviar">
            <form action="Controller/btn_manda_mensaje.php" method="post">
                <input type="text" name="id_emisor" id="id_emisor" value="<?php echo $id_emisor ?>" hidden="true">
                <input type="text" name="mensaje" id="mensaje_emisor" value="" hidden="true">
                <input type="text" name="id_receptor" id="id_form_receptor" value="<?php echo $id_receptor ?>" hidden="true">
                <button id="btn_enviar_formulario" type="submit" hidden="true"></button>
            </form>
        </div>
            
        <div class="search-bar">
            <input type="text" class="ip-search" placeholder="Buscar Usuario..">
        </div>

        <div class="body">
            <div class="friend-list">
                <ul class="chat-people"> 
                    
                    <?php 
                        foreach ($usuarios as $renglon) { foreach ($renglon as $columna => $valor) { 
                        if ($columna == "id_usuario" && $valor != null) {  $id_receptor = $valor; } 
                        if ($columna == "nombre" && $valor != null) {  $nom_receptor = $valor; } 
                        if ($columna == "foto" && $valor == null) {  
                            $img_receptor = 'IMGUSUARIOS/avatardefault.webp';
                        } else if ($columna == "foto") { $foto_receptor = $valor; 
                            $img_receptor = 'data:image/*; base64,' . base64_encode($foto_receptor); } }
                            if($id_receptor != $id_emisor) {
                    ?>
                    <li class="receptor"> 
                        <span class="messages">
                            <span class="count"></span>
                        </span>
                        <img src="<?php echo $img_receptor; ?>" alt="">
                        <span class="name">
                            <?php echo $nom_receptor; ?>
                        </span>
                        <input type="text" class="id_receptor" value="<?php echo $id_receptor; ?>" hidden>
                    </li>
                        <?php } } ?>
                </ul>
            </div>
        </div>

        <div class="chat-messages">
            <div class="chat">
                <div class="chat-content">
                <?php 
                    foreach ($mensajes as $renglon) { foreach ($renglon as $columna => $valor) { 
                        if ($columna == "id_emisor" && $valor != null) {  $id_emisor_mensaje = $valor; } 
                        if ($columna == "id_receptor" && $valor != null) {  $id_receptor_mensaje = $valor; } 
                        if ($columna == "mensaje" && $valor != null) {  $mensaje = $valor; } 
                        if ($columna == "nombre" && $valor != null) {  $nombre_emisor_mensaje = $valor; } 
                        if ($columna == "fech_salida" && $valor != null) {  $fech_salida_mensaje = $valor; } }
                            if($id_emisor_mensaje == $id_emisor) {
                ?>
                    <form action="Controller/editar_mensaje_controller.php" method="post">
                        <span id="mens" name="mensajeSpan"  class="you first" contentEditable="true" onkeyup="$(this).parent().find('#mensaj').attr('value', $(this).text());"><?php echo $mensaje; ?> </span>
                        <input type="text" id="mensaj" name="mensaje" value="<?php echo $mensaje; ?>" hidden>
                        <input type="text" name="id_emisor" value="<?php echo $id_emisor; ?>" hidden>
                        <input type="text" name="id_receptor" value="<?php echo $id_receptor_mensaje; ?>" hidden>
                        <input type="text" name="fech_salida" value="<?php echo $fech_salida_mensaje; ?>" hidden>
                        <input type="submit" value="editar" class="edit">
                    </form>
                    <form action="Controller/borrar_mensaje_controller.php" method="post" >
                        <input type="text" name="id_emisor" value="<?php echo $id_emisor; ?>" hidden>
                        <input type="text" name="id_receptor" value="<?php echo $id_receptor_mensaje; ?>" hidden>
                        <input type="text" name="fech_salida" value="<?php echo $fech_salida_mensaje; ?>" hidden>
                        <input type="submit" value="borrar" class="delate">
                    </form> <br>
                            <?php } else { ?> 
                    <span class="friend last">
                        <?php echo $mensaje; ?>
                    </span>
                           <?php } } ?>
                </div>
            </div>
            <div class="msg-box">
                <input style="size: 150px;" type="text" class="ip-msg" id="mensaje_para_enviar" placeholder="Escribe algo.." >
                <span class="btn-group">
                    <i id="boton_enviar_mensaje" class="fas fa-paper-plane" style="color: #4BB6BB;"></i>
                </span>
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
    <script src="JS/mensajes-script.js"></script>

</html>