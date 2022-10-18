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
        <link rel="stylesheet" href="CSS/editar.css">
        <script src="https://kit.fontawesome.com/9d0e50ae14.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
                    <li class="menu__item"><a href="usuario.php" class="menu__link  menu__link--select">Perfil</a></li>
                    <li class="menu__item"><a href="Controller/cerrar_sesion_controller.php" class="menu__link">Cerrar Sesion</a></li>

                </ul>
            </div>
        </nav>

        <section>
            <div class="container2">

                <form enctype="multipart/form-data" action="btn_editar_perfil.php" method="post" class="sign-up-form" onsubmit="return validarEdit();">
                    <br> <br><h2 class="title"> Datos de Usuario </h2>

                    <div id="busca_img" class="foto-avatar">
                        
                        <?php if(!isset($foto)){?>
                        <img class="foto-avatar2" id="imgSalida" name="imgSalida" src="IMGUSUARIOS/avatardefault.webp">
                        <?php } else { echo $img; }?>
                        
                        <i type="file" name="img" id="img" class="fas fa-edit"></i>
                        <input id="ruta" name="ruta" default="null" type="file" accept="image/jpeg, image/jpg, image/png, image/gif, image/svg" hidden>
                    </div>

                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>" placeholder="Nombre">
                        <input type="text" id="idd" name="idd" value="<?php echo $id ?>" hidden>
                    </div>

                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="correo" name="correo" value="<?php echo $email ?>" placeholder="Correo Electrónico">
                    </div>

                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="contraseña" name="contraseña" value="<?php echo $contra ?>" placeholder="Contraseña">
                    </div>
                            
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <select style="background-color: #1a1818;" class="tipo" id="genero" name="genero" size="1">
                            <?php if ($genero == 1) {  ?>
                            <option class="tipo" selected>Masculino</option>
                            <option class="tipo">Femenino</option>
                            <?php } else { ?>
                            <option class="tipo">Masculino</option>
                            <option class="tipo" selected>Femenino</option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="input-field">
                        <i class="fas fa-calendar"></i>
                        <input id="fech_nac" value="<?php echo $fech_nac; ?>" name="fech_nac" type="text" placeholder="Fecha de Nacimiento" onfocus="(this.type='date')" onblur="(this.type='text')">
                    </div>

                    <input type="submit" value="Guardar" class="botn solid">
                </form>
            </div>

        </section>
    </body>


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
    <script text="text/javascript" src="JS/img-editar.js"></script>
    <script>
        document.getElementById("img").addEventListener('click', function() {
        document.getElementById("ruta").click();
        });
        
                function validarEdit(){
    var nombre, correo, contraseña, expresion, expresion2;
    nombre = document.getElementById("nombre").value;
    correo = document.getElementById("correo").value;
    contraseña = document.getElementById("contraseña").value;

    expresion = /\w+@\w+\.+[a-z]/;
    expresion2 = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z0-9\d$@$!%*?&]{8,35}/;
    var expresion3 = /[A-Za-z]/;

    if(nombre === "" || correo === "" || contraseña === "" ){
        alert("Favor de llenar todos los datos");
        return false;
    }

    else if(!expresion3.test(nombre)){
        alert("Nombre solo debe incluir letras")
        return false;
    }

    else if(nombre.length>80){
        alert("El nombre es muy largo")
        return false;
    }

    else if(correo.length>80){
        alert("El nombre es muy largo")
        return false;
    }

    else if(!expresion.test(correo)){
        alert("Correo no valido")
        return false;
    }

    else if(!expresion2.test(contraseña)){
        alert("Su contraseña debe de ser minimo de 8 caracteres, 1 mayuscula, 1 minuscula, 1 numero, 1 cacracter especial")
        return false;
    }
}

    </script>
</html>