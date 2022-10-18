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
        <script src="JS/validar.js"></script>
        <link rel="stylesheet" href="CSS/estilos.css">
        <link rel="stylesheet" href="CSS/registrar.css">
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
                    <li class="menu__item"><a href="index.php" class="menu__link">Inicio</a></li>
                    <li class="menu__item"><a href="busqueda.php" class="menu__link">Busqueda</a></li>
                    <li class="menu__item"><a href="sesion.php" class="menu__link menu__link--select">Iniciar Sesión</a>
                    </li>
                </ul>
            </div>
        </nav>

        <section>
            <div class="container2">
                <div class="forms-container">
                    <div class="signin-signup">
                        <form action="Controller/sesion_controller.php" method="post" class="sign-in-form" >
                            <h2 class="title"> Inicia Sesión </h2>
                            <div class="input-field">
                                <i class="fas fa-user-graduate"></i>
                                <select id="tipo_usuario" name="tipo_usuario" class="tipo" size="1">
                                    <option class="tipo">Alumno</option>
                                    <option class="tipo">Maestro</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <i class="fas fa-envelope"></i>
                                <input id="correo2" name="correo2" type="email" placeholder="Correo Electrónico" required>
                            </div>
                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input id="contraseña2" name="contraseña2" type="password" placeholder="Contraseña" required>
                            </div>
                            <input type="submit" value="Iniciar" class="botn solid">

<!--                            <p class="social-text">Ingresa con Facebook</p>
                            <div class="social-media">
                                <a href="#" class="social-icon">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </div>-->
                        </form>

                        <form action="Controller/registrar_controller.php" method="post" class="sign-up-form" onsubmit="return validar();">
                            <h2 class="title"> Registrate </h2>
                            <div class="input-field">
                                <i class="fas fa-user"></i>
                                <input id="nombre" name="nombre" type="text" placeholder="Nombre">
                            </div>

                            <div class="input-field">
                                <i class="fas fa-envelope"></i>
                                <input id="correo" name="correo" type="email" placeholder="Correo Electrónico">
                            </div>

                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input id="contraseña" name="contraseña" type="password" placeholder="Contraseña">
                            </div>
                            <div class="input-field">
                                <i class="fas fa-user-graduate"></i>
                                <select class="tipo" id="tipo_usu" name="tipo_usu" size="1">
                                    <option class="tipo">Alumno</option>
                                    <option class="tipo">Maestro</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <i class="fas fa-user"></i>
                                <select class="tipo" id="genero" name="genero" size="1">
                                    <option class="tipo">Masculino</option>
                                    <option class="tipo">Femenino</option>
                                </select>
                            </div>

                            <div class="input-field">
                                <i class="fas fa-calendar"></i>
                                <input id="fech_nac" name="fech_nac" type="text" placeholder="Fecha de Nacimiento" onfocus="(this.type='date')" onblur="(this.type='text')">
                            </div>

                            <input type="submit" value="Registrar" class="botn solid">

<!--                            <p class="social-text"> Registrate con Facebook</p>
                            <div class="social-media">
                                <a href="#" class="social-icon">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </div>-->
                        </form>
                    </div>
                </div>

                <div class="panels-container">
                    <div class="panel left-panel">
                        <div class="content">
                            <h3>No tienes cuenta?</h3>
                            <p>Registrate aqui para que puedas tener a acceso a nuestros cursos y promociones.</p>
                            <button class="botn transparent" id="sign-up-btn">Registrate!</button>
                        </div>
                        <img src="IMGUSUARIOS/compu.svg" class="image" alt="">
                    </div>

                    <div class="panel right-panel">
                        <div class="content">
                            <h3>Bienvenido!</h3>
                            <p>Que bueno que regresaste! Inicia Sesión para acceder a los cursos</p>
                            <button class="botn transparent" id="sign-in-btn">Iniciar Sesión</button>
                        </div>
                        <img src="IMGUSUARIOS/escritorio.svg" class="image" alt="">
                    </div>
                </div>
            </div>
            <script src="JS/in-up.js"></script>
    </body>
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