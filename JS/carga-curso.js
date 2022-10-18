
document.getElementById("img").addEventListener('click', function () {
    document.getElementById("file-input").click();
});

document.getElementById("file-input").addEventListener('change', function () {
    document.getElementById("imgSalida").hidden = false;
});

$(document).ready(function () {

    $('#btnAgFas').click(function () {
        $(".product-list").append('<div class="fase-agregar"><hr color="green"><button class="btn-delete-fas">Borrar fase</button><div class="form-fases"><label>Fases:</label><br><label>Nombre de la fase:</label><br><input id="nomFas" class="INPUT-INFO" type="text" value="" placeholder="Nombre de la fase"><br><label>Descripcion de la fase:</label><br><textarea id="descFas" class="INPUT-DESCRIPCION" placeholder="Descripcion de la Fase"></textarea><br><label>Costo de la fase:</label><br><input id="costoFas" class="INPUT-COSTO" type="number"><input id="tipoFas" type="checkbox"><label class="gratis"> Gratis</label></div><div class="contenidos-list"><button id="btnAdd" class="btn-edit">Agregar contenido</button><table class="tabla-agregar-fase"><tr><th>Nombre</th><th>Contenido</th><th style="display: none;" id="title"></th><th>Instrucciones</th></tr><tr class="contents"><td><input id="nomCont" class="tabla" type="text" placeholder="Nombre Contenido"></td><td id="opcion"><select class="tabla" id="statusCont" name="statusCont"><option value="" selected>--Seleccionar--</option><option value="file">Archivo</option><option value="link">Link</option></select></td><td style="display: none;"><input id="fase_agregada" type="text" value="Una fase" ></td><td id="file" style="display: none;"><input id="archivoFile" class="tabla" type="file"></td><td id="link" style="display: none;"><input id="archivoLink" class="tabla" type="text" placeholder="URL/Link"></td><td><input class="tabla" type="text" id="instruccion"></td></tr></table></div></div>');
    });

    $('.product-list').on('click', '.btn-edit', function () {
        $(this).closest('.contenidos-list').append('<table class="tabla-agregar-fase"><tr><th>Nombre</th><th>Contenido</th><th style="display: none;" id="title"></th><th>Instrucciones</th></tr><tr class="contents"><td><input id="nomCont" class="tabla" type="text" placeholder="Nombre Contenido"></td><td id="opcion"><select class="tabla" id="statusCont" name="statusCont"><option value="" selected>--Seleccionar--</option><option value="file">Archivo</option><option value="link">Link</option></select></td><td id="file" style="display: none;"><input id="archivoFile" class="tabla" type="file"></td><td id="link" style="display: none;"><input id="archivoLink" class="tabla" type="text" placeholder="URL/Link"></td><td><input class="tabla" type="text" id="instruccion"></td><td><button class="btn-delete">X</button></td></tr></table>');
    });

    $('.product-list').on('click', '.btn-delete', function () {
        $(this).closest('.tabla-agregar-fase').remove();
    });

    $('.product-list').on('click', '.btn-delete-fas', function () {
        $(this).closest('.fase-agregar').remove();
    });

    $('.product-list').on('change', '#statusCont', function () {
        var valor = $(this).val();
        var linkP = $(this).closest('tr').find('#link');
        var titleP = $(this).closest('tr').find('#title');
        var fileP = $(this).closest('tr').find('#file');

        if (valor == 'link') {
            linkP.show();
            titleP.show();
            fileP.hide();
        }

        if (valor == 'file') {
            fileP.show();
            linkP.hide();
            titleP.show();
        }

        if (valor == '') {
            fileP.hide();
            linkP.hide();
            titleP.hide();
        }
    });
});

function mostrar(id) {
    if (id == "costo") {
        $("#costo").show();
        $("#costo-fase").hide();
        $("#costo-curso").hide();
        $("#gratuito").hide();
    }

    if (id == "costo-fase") {
        $("#costo-curso").hide();
        $("#costo-fase").show();
        $("#gratuito").hide();
    }

    if (id == "gratuito") {
        $("#costo-fase").hide();
        $("#gratuito").show();
        $("#costo-curso").hide();
        $("#costo").hide();
    }

    if (id == "costo-curso") {
        $("#costo-curso").show();
        $("#costo-fase").hide();
        $("#gratuito").hide();
    }
}

function validarContenidos(idCurso, idFase){
    var idFaseInicial = idFase;
    var idcur = idCurso;
    var vidPorFas = 0;
    idFase = 0;
    var check = false;

    $('.contents').each(function () {

        if ($(this).find('#fase_agregada').val() != null) {
            idFase++;
            check = false;
        }
        if ($(this).find('#statusCont').val() == 'file') {
            let tipoAr = $(this).find('#archivoFile').prop('files')[0].type.toString();
            if( (tipoAr.substring(0,5) == "Video" || tipoAr.substring(0,5) == "video") && check == false ){
                vidPorFas++;
                check = true;
            }
        } else if ($(this).find('#statusCont').val() == 'link') {
            if( check == false ){
                vidPorFas++;
                check = true;
            }
        }
    });

        if( vidPorFas == idFase ) {
            contenidos(idcur, idFaseInicial);
        } else {
            contenidos(idcur, idFaseInicial);
        }
}

function contenidos(idCurso, idFase) {
    idFase--;
    let contenidos = new Array();
    let fases = new Array();
    let categorias_curso = new Array();
    let curso = new Array();
    let form_data = new FormData();
    let form_data_cur = new FormData();
    var tipoCur;
    var controlCur;

    $('.Cursos').each(function () {
        var precioCur;

        if ($(this).find('#tipoCur').val() == 'gratuito') {
            precioCur = 0.00;
            tipoCur = 0;
        } else if ($(this).find('#tipoCur').val() == 'costo') {
            if ($(this).find('#tipoCur2').val() == 'costo-curso') {
                tipoCur = 1;
                precioCur = parseFloat($(this).find('#precioCur').val());
            } else if ($(this).find('#tipoCur2').val() == 'costo-fase') {
                precioCur = 0.00;
                tipoCur = 2;
            }
        }

        controlCur = $(this).find('#file-input').prop('files')[0];
        form_data_cur.append('file-input[]', $(this).find('#file-input').prop('files')[0]);
        form_data_cur.append('id_curso', idCurso);
        form_data_cur.append('titulo', $(this).find('#nomCur').val());
        form_data_cur.append('descripcion', $(this).find('#descCur').val());
        form_data_cur.append('tipo', tipoCur);
        form_data_cur.append('precio', precioCur);

        curso.push({
            id_curso: idCurso,
            titulo: $(this).find('#nomCur').val(),
            descripcion: $(this).find('#descCur').val(),
            imagen: $(this).find('#file-input').prop('files')[0],
            precio: precioCur,
            tipo: tipoCur,
            name: controlCur.name,
            type: controlCur.type,
            size: controlCur.size
        });
    });

    $('.contents').each(function () {

        if ($(this).find('#fase_agregada').val() != null) {
            idFase++;
        }
        if ($(this).find('#statusCont').val() == 'file') {
            form_data.append('archivoFile[]', $(this).find('#archivoFile').prop('files')[0]);
            
            form_data_cur.append('archivoFile[]', $(this).find('#archivoFile').prop('files')[0]);

            contenidos.push({
                nombre: $(this).find('#nomCont').val(),
                instrucciones: $(this).find('#instruccion').val(),
                archivo: $(this).find('#archivoFile').val(),
                fase: idFase,
                tipo: 0,
                name: $(this).find('#archivoFile').prop('files')[0].name,
                type: $(this).find('#archivoFile').prop('files')[0].type
            });

        } else if ($(this).find('#statusCont').val() == 'link') {

            contenidos.push({
                nombre: $(this).find('#nomCont').val(),
                instrucciones: $(this).find('#instruccion').val(),
                archivo: $(this).find('#archivoLink').val(),
                fase: idFase,
                tipo: 1,
                name: "",
                type: ""
            });
        }
    });

    $('.fase-agregar').each(function () {
        var valid = $(this).find('#tipoFas').is(':checked');
        var costoFas;
        var tipoFas;

        if (valid) {
            costoFas = 0.00;
            tipoFas = 0;
        } else {
            costoFas = parseFloat($(this).find('#costoFas').val());
            tipoFas = 1;
        }

        if (tipoCur == 1) {
            costoFas = 0.00;
        }

        if (tipoCur == 0) {
            costoFas = 0.00;
            tipoFas = 0;
        }

        fases.push({
            nombre: $(this).find('#nomFas').val(),
            descripcion: $(this).find('#descFas').val(),
            monto: costoFas,
            tipo: tipoFas
        });
    });

    $('#categorias-select').each(function () {
        if ($(this).val() == null) {
            categorias_curso = null;
        } else {
            categorias_curso = $(this).val();
        }
    });
    
    form_data_cur.append('categorias', JSON.stringify(categorias_curso));
    form_data_cur.append('fases', JSON.stringify(fases));
    form_data_cur.append('contenidos', JSON.stringify(contenidos));

    $.ajax({
        url: "Controller/sube_archivos_controller_1.php",
        type: "POST",
        data: form_data_cur,
        contentType: false,
        cache: false,
        processData: false,
        success: function (html) {
        }
    });
  
    alert("Espere algunos segundos y de OK"); 
    alert("Su curso se subió con éxito, gracias por su aporte");
    window.location.href = "ver_cursos_creados.php";
}