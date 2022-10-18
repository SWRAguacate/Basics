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
    <link rel="stylesheet" href="CSS/carrito.css">
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
                <li class="menu__item"><a href="carrito.php" class="menu__link  menu__link--select">Carrito</a></li>
                <li class="menu__item"><a href="usuario.php" class="menu__link">Perfil</a></li>
                <li class="menu__item"><a href="Controller/cerrar_sesion_controller.php" class="menu__link">Cerrar Sesion</a></li>
            </ul>
        </div>
    </nav>

    <header class="header">
        <div class="container4">
            <div class="row">
                <div class="two columns u-pull-right">
                    <div id="carrito">
                        <p class="vacio"> <i class="fas fa-shopping-cart"></i> Carrito</p>
                        <table id="lista-carrito" class="u-full-width">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Curso</th>
                                    <th>Fases</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                foreach ($cursos_fases_paga as $renglon) { foreach ($renglon as $columna => $valor) { 
                                 if ($columna == "id_curso" && $valor != null) {  $id_curso = $valor; }
                                 if ($columna == "id_fases" && $valor != null) {  $id_fases = $valor; }
                                 if ($columna == "tipo" && $valor != null) {  $tipo_curso = $valor; }
                                 if ($columna == "imagen" && $valor == null) { 
                                    $img = 'IMGUSUARIOS/curso.jpg';  }
                                else if ($columna == "imagen") { $foto = $valor; 
                                    $img = 'data:image/*; base64,' . base64_encode($foto);  }
                                 if ($columna == "titulo" && $valor != null) {  $titulo = $valor;  }
                                 if ($columna == "fases" && $valor != null) {  $nombre_fases = $valor; }
                                 if ($columna == "monto" && $valor != null) {  $costo = $valor; }
                                 }  ?>
                                    <tr>
                                    <td name="imagen" id="imagen"><img src="<?php echo $img ?>"></td>
                                    <td name="titulo" id="titulo"><?php echo $titulo ?></td>
                                    <td name="nombre_fases" id="nombre_fases"><?php echo $nombre_fases ?></td>
                                    <td name="costo" id="costo">$ <?php echo $costo ?></td>
                                    <td name="id_curso" id="id_curso" hidden="true"><?php echo $id_curso ?></td>
                                    <td name="id_fases" id="id_fases" hidden="true"><?php echo $id_fases ?></td>
                                    <td name="tipo_curso" id="tipo_curso" hidden="true"><?php echo $tipo_curso ?></td>
                                    <?php $total_carrito = $total_carrito +  $costo; if ($i == 0){ $toda_fase = $id_fases; $i++; } 
                                     else { $toda_fase = $toda_fase . ',' . $id_fases; } $todo_curso = $todo_curso.$id_curso.','; ?>
                                    <td><a href="Controller/vaciar_carrito_controller.php?ids_curso=<?php echo $id_curso; ?>&ids_fases=<?php echo $id_fases; ?>&id=<?php echo $id; ?>&bt=1"  class="borrar-curso">X</a></td>
                                    </tr>
                                  <?php } ?>
                                    
                                    <?php
                                foreach ($fases_gratis as $renglon) { foreach ($renglon as $columna => $valor) { 
                                 if ($columna == "id_curso" && $valor != null) {  $id_curso = $valor; }
                                 if ($columna == "id_fases" && $valor != null) {  $id_fases = $valor; }
                                 if ($columna == "tipo" && $valor != null) {  $tipo_curso = $valor; }
                                 if ($columna == "imagen" && $valor == null) { 
                                    $img = 'IMGUSUARIOS/curso.jpg';  }
                                else if ($columna == "imagen") { $foto = $valor; 
                                    $img = 'data:image/*; base64,' . base64_encode($foto);  }
                                 if ($columna == "titulo" && $valor != null) {  $titulo = $valor;  }
                                 if ($columna == "fases" && $valor != null) {  $nombre_fases = $valor; }
                                 if ($columna == "monto" && $valor != null) {  $costo = $valor; }
                                 }  ?>
                                    <tr>
                                    <td name="imagen" id="imagen"><img src="<?php echo $img ?>"></td>
                                    <td name="titulo" id="titulo"><?php echo $titulo ?></td>
                                    <td name="nombre_fases" id="nombre_fases"><?php echo $nombre_fases ?></td>
                                    <td name="costo" id="costo">$ <?php echo $costo ?></td>
                                    <td name="id_curso" id="id_curso" hidden="true"><?php echo $id_curso ?></td>
                                    <td name="id_fases" id="id_fases" hidden="true"><?php echo $id_fases ?></td>
                                    <td name="tipo_curso" id="tipo_curso" hidden="true"><?php echo $tipo_curso ?></td>
                                    <?php $total_carrito = $total_carrito +  $costo; $toda_fase = $toda_fase . ',' . $id_fases; 
                                               $todo_curso = $todo_curso.$id_curso.','; ?>
                                    <td><a href="Controller/vaciar_carrito_controller.php?ids_curso=<?php echo $id_curso; ?>&ids_fases=<?php echo $id_fases; ?>&id=<?php echo $id; ?>&bt=1"  class="borrar-curso">X</a></td>
                                    </tr>
                                  <?php } ?>
                                    
                                    <?php
                                foreach ($cursos_gratis as $renglon) { foreach ($renglon as $columna => $valor) { 
                                 if ($columna == "id_curso" && $valor != null) {  $id_curso = $valor; }
                                 if ($columna == "id_fases" && $valor != null) {  $id_fases = $valor; }
                                 if ($columna == "tipo" && $valor != null) {  $tipo_curso = $valor; }
                                 if ($columna == "imagen" && $valor == null) { 
                                    $img = 'IMGUSUARIOS/curso.jpg';  }
                                else if ($columna == "imagen") { $foto = $valor; 
                                    $img = 'data:image/*; base64,' . base64_encode($foto);  }
                                 if ($columna == "titulo" && $valor != null) {  $titulo = $valor;  }
                                 if ($columna == "fases" && $valor != null) {  $nombre_fases = $valor; }
                                 if ($columna == "monto" && $valor != null) {  $costo = $valor; }
                                 }  ?>
                                    <tr>
                                    <td name="imagen" id="imagen"><img src="<?php echo $img ?>"></td>
                                    <td name="titulo" id="titulo"><?php echo $titulo ?></td>
                                    <td name="nombre_fases" id="nombre_fases"><?php echo $nombre_fases ?></td>
                                    <td name="costo" id="costo">$ <?php echo $costo ?></td>
                                    <td name="id_curso" id="id_curso" hidden="true"><?php echo $id_curso ?></td>
                                    <td name="id_fases" id="id_fases" hidden="true"><?php echo $id_fases ?></td>
                                    <td name="tipo_curso" id="tipo_curso" hidden="true"><?php echo $tipo_curso ?></td>
                                    <?php $total_carrito = $total_carrito +  $costo; $toda_fase = $toda_fase . ',' . $id_fases; 
                                     if($i == $length){$todo_curso = $todo_curso.$id_curso; } 
                                     else { $todo_curso = $todo_curso.','.$id_curso.','; }$i++;   ?>
                                    <td><a href="Controller/vaciar_carrito_controller.php?ids_curso=<?php echo $id_curso; ?>&ids_fases=<?php echo $id_fases; ?>&id=<?php echo $id; ?>&bt=1"  class="borrar-curso">X</a></td>
                                    </tr>
                                  <?php } ?>

                            </tbody>
                        </table>
                        <?php if(count($cursos_fases_paga) == 0 && count($cursos_gratis) == 0 && count($fases_gratis) == 0) { ?>
                        <p class="vacio"> <i ></i> Vacío</p> <br><br><br><br><br><br>
                        <?php } else { ?>
                        <form class="TotalCarrito">
                            <label style="color:#44fd06;">Total</label>
                            <input readonly type="text" class="input_total" value="$ <?php echo $total_carrito ?>">
                        </form>
                        <a href="Controller/vaciar_carrito_controller.php?ids_curso=<?php echo $todo_curso; ?>&ids_fases=<?php echo $toda_fase; ?>&id=<?php echo $id; ?>&bt=2" class="button_u-full-width">Vaciar Carrito</a>
                        <a href="pagar.php" class="button_u-full-width2" id="btn-abrir">Tramitar Pedido</a><br><br><br>
                        
                        <?php }  ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </header>

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
    <script src="JS/pagar.js"></script>
    
</body>
</html>