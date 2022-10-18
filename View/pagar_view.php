<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="JS/jquery.js"></script>
    <script text="text/javascript" src="JS/pagar.js"></script>
    <link rel="stylesheet" href="CSS/estilos.css">
    <link rel="stylesheet" href="CSS/pagar.css">
    <title>Document</title>
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
                <li class="menu__item"><a href="carrito.php" class="menu__link  ">Carrito</a></li>
                <li class="menu__item"><a href="usuario.php" class="menu__link">Perfil</a></li>
                <li class="menu__item"><a href="Controller/cerrar_sesion_controller.php" class="menu__link">Cerrar Sesion</a></li>
            </ul>
        </div>
    </nav>

    <section class="left">
        <div>
            <form id="pagar-form" class="pagar-form" name="pagar-form" action="Controller/pago_completado_controller.php" method="post">
                <p class="titulo-pago">Selecciona tu metodo de pago:</p><br>
                <select name="metodo" id="metodo" onChange="mostrar(this.value);">
                    <option value="0">~Metodo de Pago~</option>
                    <?php foreach ($formas_pago as $renglon) { foreach ($renglon as $columna => $valor) {
                            if ($columna == "id_fp" && $valor != null) { $id_fp = $valor; }
                            if ($columna == "nombre" && $valor != null) { $nombre_fp = $valor; } }
                        echo "<option value='".$id_fp."'>".$nombre_fp."</option>"; } ?>
                </select>
                <input type="text" name="ids_curso" id="ids_curso" value="<?php echo $todo_curso ?>" hidden="true">
                <input type="text" name="ids_fases" id="ids_fases" value="<?php echo $toda_fase ?>" hidden="true">
                <br><br>
            </form>
        </div>

        <div id="Tarjeta" style="display: none;">
                <p>Numero de Tarjeta:<br /><br>
                    <input class="numTarjeta" type="number" />
                </p>
                <p>Fecha de expiración:<br /><br>
                    <select class="selectTarjeta" name="meses" id="meses">
                        <option value="">Mes</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                    <select class="selectTarjeta" name="año" id="año">
                        <option value="">Año</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                        <option value="2031">2031</option>
                        <option value="2032">2032</option>
                        <option value="2032">2033</option>
                        <option value="2032">2032</option>
                        <option value="2034">2034</option>
                        <option value="2035">2035</option>
                        <option value="2036">2036</option>
                        <option value="2037">2037</option>
                        <option value="2038">2038</option>
                        <option value="2039">2039</option>
                        <option value="2040">2040</option>
                    </select>
                    <input class="cvv" type="number" placeholder="CVV" /><br><br>
                    <input form="pagar-form" type="submit" class="btn-pagar" value="Pagar"/>
                </p>
        </div>

        <div id="PayPal" style="display: none;">
            <h2 class="payPal-titulo">Antes de seguir con la compra, inicia sesión con tu cuenta de PayPal</h2><br>
            <button class="btn-PayPal" form="pagar-form" type="submit">Pagar con PayPal
        </div><br>

        <div id="Efectivo"style="display: none;">  
            <h2 class="payPal-titulo" >Con este número de referencia ve a tu tienda de conveniencia más cercana y realiza tu pago</h2>
                <p class="title-numero">Numero de referencia:
                <input  class="input-referencia" type="number" readonly value="59650882613" /></p>
                <input form="pagar-form" type="submit" class="btn-pagar" value="Pagado"/>
        </div>
        
        <div id="Otro" style="display: none;">
                <input form="pagar-form" type="submit" class="btn-pagar" value="Pagar" onclick="alert('Pago con Exito!');"/>
        </div><br>

    </section>

    <section class="right">
        <div>
            <h2 class="info">Información</h2>
            <?php foreach ($cursos_fases_paga as $renglon) { foreach ($renglon as $columna => $valor) {
                if ($columna == "titulo" && $valor != null) {  $titulo = $valor;  }
                if ($columna == "fases" && $valor != null) {  $nombre_fases = $valor; }
                if ($columna == "monto" && $valor != null) {  $costo = $valor; } } ?>
                <section class="curso-comprado"> 
                <div class="input-curso">Título: <?php echo $titulo ?></div>
                <p class="descripcion">Fases: <?php echo $nombre_fases ?>.</p>
                <div class="precio-curso">Precio: $ <?php echo $costo ?></div> 
                </section><br> <?php } ?>
                
                <?php foreach ($fases_gratis as $renglon) { foreach ($renglon as $columna => $valor) {
                if ($columna == "titulo" && $valor != null) {  $titulo = $valor;  }
                if ($columna == "fases" && $valor != null) {  $nombre_fases = $valor; }
                if ($columna == "monto" && $valor != null) {  $costo = $valor; } } ?>
                <section class="curso-comprado"> 
                <div class="input-curso">Título: <?php echo $titulo ?></div>
                <p class="descripcion">Fases: <?php echo $nombre_fases ?>.</p>
                <div class="precio-curso">Precio: $ <?php echo $costo ?></div> 
                </section><br> <?php } ?>
                
                <?php foreach ($cursos_gratis as $renglon) { foreach ($renglon as $columna => $valor) {
                if ($columna == "titulo" && $valor != null) {  $titulo = $valor;  }
                if ($columna == "fases" && $valor != null) {  $nombre_fases = $valor; }
                if ($columna == "monto" && $valor != null) {  $costo = $valor; } } ?>
                <section class="curso-comprado"> 
                <div class="input-curso">Título: <?php echo $titulo ?></div>
                <p class="descripcion">Fases: <?php echo $nombre_fases ?>.</p>
                <div class="precio-curso">Precio: $ <?php echo $costo ?></div> 
                </section><br> <?php } ?>

            <label class="label-total">total:</label>
            <input type="text" class="input-curso2" readonly placeholder="Total" value="$ <?php echo $total_carrito ?>">
        </div>
        <a class="editar" href="carrito.php">Editar</a>
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

</body>

</html>