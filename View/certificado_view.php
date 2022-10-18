<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="html2pdf.bundle.min.js"></script>
    <script src="script.js"></script>
    <title>certificado</title>
</head>

<body>
    <div class="container">
        <h1>
            < BASICS >
        </h1>
        <h3>Certificado de Reconocimiento</h3>
        <div>Este certificado se concede a:</div>
        <h2>Hector García</h2>
        <div>por haber finalizado el curso de:</div>
        <div class="nombre-curso">Programacion Avanzada</div>
        <h4>Basic Cursos</h4>
        <div>Titular</div>
        <img src="../IMGUSUARIOS/certificado.svg" alt="">
    </div>
</body>

<div>
    <button class="certificado" id="certificado">Generar PDF</button>
</div><br>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Aleo:wght@300&family=Clicker+Script&family=Klee+One:wght@600&display=swap');

    * {
        background-color: black;
        color: white;
        font-family: 'Aleo', serif;
    }

    .certificado {
        position: absolute;
        border: 1px solid #5CE1E6;
        left: 50%;
        top: 100%;
        cursor: pointer;
        height: 40px;
        width: 100px;
    }

    h1 {
        color: #fff;
        font-family: 'Klee One', cursive;
        font-size: 3.5em;
    }

    .container {
        height: 700px;
        width: 1200px;
        text-align: center;
        align-items: center;
        border: 3px solid #61CF31;
        position: absolute;
        left: 8%;
        margin-top: 40px;
    }

    img {
        width: 300px;
        height: 300px;
        background: none;
        position: relative;
        top: -139px;
        left: -450px;
    }

    h3 {
        color: #5CE1E6;
        font-size: 2.0em;
        margin: 5px;
    }

    h2 {
        color: #5CE1E6;
        font-size: 4.0em;
        font-weight: bold;
        margin: 5px;
        margin-top: 30px;
        letter-spacing: 0.2em;
    }

    div {
        font-size: 1.2em;
    }

    .nombre-curso {
        font-size: 1.4em;
        margin-top: 10px;
        color: #61CF31;
        font-weight: bold;
    }

    h4 {
        font-family: 'Clicker Script', cursive;
        font-size: 2.0em;
        border-bottom: 2px solid #5CE1E6;
        width: 400px;
        position: relative;
        left: 400px;
        margin: 5px;
        margin-top: 50px;
    }
</style>

</html>