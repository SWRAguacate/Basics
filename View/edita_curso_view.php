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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/estilos.css">
    <script src="https://kit.fontawesome.com/9d0e50ae14.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/estilosraros.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="CSS/cargaCurso.css">
    
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
    

    <section class="Cursos">
        <div class="subirDatos">
            <h3>EDITAR CURSO</h3><br><br>
            <form>
                <label>Nombre del curso:</label><br>
                <input id="nomCur" class="INPUT-INFO" type="text" class="NomCurso" value="<?php echo $titulo_curso; ?>"><br><br><br>
                <input id="id_cur" type="text" value="<?php echo $id_curso; ?>" hidden>
                <label class="title-imgcurso">Imagen del Curso:</label><br>
                
                <i type="file" name="img" id="img" class="fas fa-edit"> Agrega una imagen de portada para el curso</i>
                <input class="INPUT-INFO" class="input-img" name="file-input" id="file-input" type="file" accept="image/jpeg, image/jpg, image/png, image/gif, image/svg" hidden /> <br />
                
                <?php if ($img == '') { ?>
                <img class="imgCarga" id="imgSalida" width="30%" height="30%" src="" hidden/><br><br>
                <?php } else { ?>
                <img class="imgCarga" id="imgSalida" width="30%" height="30%" src="<?php echo $img; ?>" /><br><br>
                <?php } ?>
                <div class="container-fluid">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label class="categoria-label">Categorias:</label>
                                <select id="categorias-select" class="mul-select" multiple="true">
                                    <?php foreach ($categorias as $renglon) { foreach ($renglon as $columna => $valor) {
                                            if ($columna == "id_categoria" && $valor != null) { $id_cat = $valor; }
                                            if ($columna == "nombre" && $valor != null) { $nombre_cat = $valor; } }
                                            $valid = false;
                                            foreach ($categorias_curso_mostrar as $renglon2) { foreach ($renglon2 as $columna2 => $valor2) {
                                            if ($columna2 == "id_categoria" && $valor2 != null) { if($id_cat == $valor2) { $valid = true; } } } }
                                            if($valid == false) {
                                            echo "<option value='".$id_cat."'>".$nombre_cat."</option>";                                          
                                            } else {
                                                echo "<option value='".$id_cat."' selected>".$nombre_cat."</option>"; 
                                            } } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function () {
                        $(".mul-select").select2({
                            placeholder: "seleccionar categoria", //placeholder
                            tags: true,
                            tokenSeparators: ['/', ',', ';', " "]
                        });
                    })
                </script>

                <h4 class="text-categoria">No encontró la categoria que buscaba?</h4>
                <button type='button' class="btn-abrir-popup" id="btn-abrir-popup">Agregar Categoria</button><br><br>
            </form><br>

            <section class="derecha">
            <form method="post">
                <label>Gratuito o Con costo</label><br>
                <select id="tipoCur" class="ConSin" id="status" name="status" onChange="mostrar(this.value);">
                    <option>--- Select ---</option>
                    <?php if ($tipo_curso == 0) { ?>
                    <option value="gratuito" selected>Gratuito</option>
                    <option value="costo">Costo</option>
                    <?php } else if ($tipo_curso == 1 || $tipo_curso == 2) { ?>
                    <option value="gratuito">Gratuito</option>
                    <option value="costo" selected>Costo</option>
                    <?php } ?>
                </select>
            </form>

            <form method="post">
                <div id="costo" style="display: none;">
                    <label>Costo por Fase o Costo por Curso</label><br>
    
                        <?php if ($tipo_curso == 1) { ?>
                    <select id="tipoCur2" class="costo" size="1" onChange="mostrar(this.value);">
                        <option>--- Select ---</option>
                        <option value="costo-fase">Costo Fase</option>
                        <option value="costo-curso" selected>Costo Curso</option>
                        </select>
                        <?php } else if ($tipo_curso == 2) { ?>
                        <select id="tipoCur2" class="costo" size="1" onChange="mostrar(this.value);">
                        <option>--- Select ---</option>
                        <option value="costo-fase" selected>Costo Fase</option>
                        <option value="costo-curso">Costo Curso</option>
                        </select>
                        <?php } ?>
                    
                </div>
            </form><br>

            <div id="costo-curso" style="display: none;">
                <label>Costo del Curso: </label><br>
                <input id="precioCur" class="INPUT-INFO" type="number" value="<?php echo $precio_curso; ?>">
            </div>

            <div id="gratuito" style="display: none;">
                <label>Costo del Curso:</label><br>
                <input id="precioCur" class="INPUT-INFO" type="text" value="000.00" readonly>
            </div>

            <label class="descripcion-label">Descripcion del Curso:</label><br>
            <input id="descCur" class="INPUT-DESCRIPCION2" value="<?php echo $descripcion_curso; ?>"><br><br><br>
            <img class="subir" src="IMGUSUARIOS/subir.svg" alt="">
            
        </section>
            <br>
            <div class="product-list">
                
                <?php 
                    foreach ($fases_mostrar as $renglon) { foreach ($renglon as $columna => $valor) { 
                    if ($columna == "id_fase" && $valor != null) {  $id_fas = $valor; }
                    if ($columna == "nombre" && $valor != null) {  $nombre_fas = $valor; }
                    if ($columna == "descripcion" && $valor != null) {  $descripcion_fas = $valor; }
                    if ($columna == "monto" && $valor != null) {  $monto_fas = $valor; }
                    if ($columna == "tipo" && $valor != null) {  $tipo_fas = $valor; }
                     } 
                ?>
            <div class="fase-agregar">
<!--                <hr color="green">-->
            <div class="form-fases">
                <label>Fases:</label><br>
                <label>Nombre de la fase:</label><br>
                <input id="nomFas" class="INPUT-INFO" type="text" value="<?php echo $nombre_fas; ?>"><br>
                <input id="id_fas" type="text" value="<?php echo $id_fas; ?>" hidden>
                <label>Descripcion de la fase:</label><br>
                <input id="descFas" class="INPUT-DESCRIPCION" value="<?php echo $descripcion_fas; ?>" ><br>
                <label>Costo de la fase:</label><br>
                <input id="costoFas" class="INPUT-COSTO" type="number" value="<?php echo $monto_fas; ?>">
                <?php if ($tipo_fas == 0) { ?>
                <input id="tipoFas" type="checkbox" checked="true">
                <label class="gratis"> Gratis</label> 
                <?php } else if ($tipo_fas == 1) { ?>
                    <input id="tipoFas" type="checkbox">
                    <label class="gratis"> Gratis</label> 
                <?php } ?>
            </div>
                <hr color="green">
            </div>
                    <?php } ?>
                </div>
        </div>

        <div class="overlay" id="overlay">
            <div class="popup" id="popup">
                <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
                <h3>Agregar Categoría</h3>
                    <div class="contenedor-inputs">
                        <form action="Controller/agrega_categoria_controller.php" method="post">
                            <br><input id="nomAltaCat" name="nomAltaCat" type="text" 
                                       style="color: whitesmoke;" placeholder="Nombre de la Categoria"><br><br>
                            <input id="descAltaCat" name="descAltaCat" type="text" class="descripcion-categoria" 
                                style="color: whitesmoke;" placeholder="Descripción de la Categoria"><br><br>
                            <button type='submit' class="btn-submit"> Agregar</button>
                            </form>
                    </div>
            </div>
        </div>

    </section>
    
    <br><button type='button' class="btn-submit" style="margin-left: 50px;" onclick="contenidos(<?php echo $id_curso; ?>)"> REVISA </button><br><br>
   
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
    <script text="text/javascript" src="JS/carga-imagen.js"></script>
    <script text="text/javascript" src="JS/pop-up.js"></script>
    <script text="text/javascript" src="JS/edita-curso.js"></script>
</body>
</html>