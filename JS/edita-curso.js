
document.getElementById("img").addEventListener('click', function () {
    document.getElementById("file-input").click();
});

document.getElementById("file-input").addEventListener('change', function () {
    document.getElementById("imgSalida").hidden = false;
});

$(document).ready(function () {
    if ($('#tipoCur').val() == "costo") {
        $("#costo").show();
        $("#costo-fase").hide();
        $("#costo-curso").hide();
        $("#gratuito").hide();
    }
    
    $(".product-list").find('hr').last().remove()

    if ($('#tipoCur').val() == "costo-fase") {
        $("#costo-curso").hide();
        $("#costo-fase").show();
        $("#gratuito").hide();
    }

    if ($('#tipoCur').val() == "gratuito") {
        $("#costo-fase").hide();
        $("#gratuito").show();
        $("#costo-curso").hide();
        $("#costo").hide();
    }

    if ($('#tipoCur').val() == "costo-curso") {
        $("#costo-curso").show();
        $("#costo-fase").hide();
        $("#gratuito").hide();
    }
    
    if ($('#tipoCur2').val() == "costo") {
        $("#costo").show();
        $("#costo-fase").hide();
        $("#costo-curso").hide();
        $("#gratuito").hide();
    }

    if ($('#tipoCur2').val() == "costo-fase") {
        $("#costo-curso").hide();
        $("#costo-fase").show();
        $("#gratuito").hide();
    }

    if ($('#tipoCur2').val() == "gratuito") {
        $("#costo-fase").hide();
        $("#gratuito").show();
        $("#costo-curso").hide();
        $("#costo").hide();
    }

    if ($('#tipoCur2').val() == "costo-curso") {
        $("#costo-curso").show();
        $("#costo-fase").hide();
        $("#gratuito").hide();
    }

    $('#btnAgFas').click(function () {
        $(".product-list").append('<div class="fase-agregar"><hr color="green"><button class="btn-delete-fas">Borrar fase</button><div class="form-fases"><label>Fases:</label><br><label>Nombre de la fase:</label><br><input id="nomFas" class="INPUT-INFO" type="text" value="" placeholder="Nombre de la fase"><br><label>Descripcion de la fase:</label><br><textarea id="descFas" class="INPUT-DESCRIPCION" placeholder="Descripcion de la Fase"></textarea><br><label>Costo de la fase:</label><br><input id="costoFas" class="INPUT-COSTO" type="number"><input id="tipoFas" type="checkbox"><label class="gratis"> Gratis</label></div><div class="contenidos-list"><button id="btnAdd" class="btn-edit">Agregar contenido</button><table class="tabla-agregar-fase"><tr><th>Nombre</th><th>Contenido</th><th style="display: none;" id="title"></th><th>Instrucciones</th></tr><tr class="contents"><td><input id="nomCont" class="tabla" type="text" placeholder="Nombre Contenido"></td><td id="opcion"><select class="tabla" id="statusCont" name="statusCont"><option value="" selected>--Seleccionar--</option><option value="file">Archivo</option><option value="link">Link</option></select></td><td style="display: none;"><input id="fase_agregada" type="text" value="Una fase" ></td><td id="file" style="display: none;"><input id="archivoFile" class="tabla" type="file"></td><td id="link" style="display: none;"><input id="archivoLink" class="tabla" type="text" placeholder="URL/Link"></td><td><input class="tabla" type="text" id="instruccion"></td></tr></table></div></div>');
    });

    $('.product-list').on('click', '.btn-edit', function () {
        $(this).closest('.contenidos-list').append('<table class="tabla-agregar-fase"><tr><th>Nombre</th><th>Contenido</th><th style="display: none;" id="title"></th><th>Instrucciones</th></tr><tr class="contents"><td><input id="nomCont" class="tabla" type="text" placeholder="Nombre Contenido"></td><td id="opcion"><select class="tabla" id="statusCont" name="statusCont"><option value="" selected>--Seleccionar--</option><option value="file">Archivo</option><option value="link">Link</option></select></td><td id="file" style="display: none;"><input id="archivoFile" class="tabla" type="file"></td><td id="link" style="display: none;"><input id="archivoLink" class="tabla" type="text" placeholder="URL/Link"></td><td><input class="tabla" type="text" id="instruccion"></td><td><button class="btn-delete">Borrar</button></td></tr></table>');
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

function contenidos(idCurso) {
    let fases = new Array();
    let categorias_curso = new Array();
    let curso = new Array();
    let form_data_cur = new FormData();
    var tipoCur;
    var controlCur;

    $('.Cursos').each(function () {
        var tituloCur = $(this).find('#nomCur').val();
        var descCur = $(this).find('#descCur').val();
        var imgCur = $(this).find('#file-input').val();
        var validCur = $(this).find('#tipoCur').val();
        var precioCur;

        if (validCur == 'gratuito') {
            precioCur = 0.00;
            tipoCur = 0;
        } else if (validCur == 'costo') {
            var validCur2 = $(this).find('#tipoCur2').val();
            if (validCur2 == 'costo-curso') {
                tipoCur = 1;
                precioCur = parseFloat($(this).find('#precioCur').val());
            } else if (validCur2 == 'costo-fase') {
                precioCur = 0.00;
                tipoCur = 2;
            }
        }
        
        if (imgCur != '' && imgCur != null) {
            controlCur = $(this).find('#file-input').prop('files')[0];
            form_data_cur.append('file-input[]', $(this).find('#file-input').prop('files')[0]);
            curso.push({
            id_curso: idCurso,
            titulo: tituloCur,
            descripcion: descCur,
            imagen: imgCur,
            precio: precioCur,
            tipo: tipoCur,
            name: controlCur.name,
            type: controlCur.type,
            size: controlCur.size
        });
        } else {
        curso.push({
            id_curso: idCurso,
            titulo: tituloCur,
            descripcion: descCur,
            imagen: "",
            precio: precioCur,
            tipo: tipoCur,
            name: "",
            type: "",
            size: ""
        });
    }
    });

    $('.fase-agregar').each(function () {
        var idFas = $(this).find('#id_fas').val();
        var nombreFas = $(this).find('#nomFas').val();
        var descripcionFas = $(this).find('#descFas').val();
        var valid = $(this).find('#tipoFas').is(':checked');
        var costoFas;
        var tipoFas;

        if (valid) {
            costoFas = 0.00;
            tipoFas = false;
        } else {
            costoFas = parseFloat($(this).find('#costoFas').val());
            tipoFas = true;
        }

        if (tipoCur == 1) {
            costoFas = 0.00;
        }

        if (tipoCur == 0) {
            costoFas = 0.00;
            tipoFas = false;
        }

        fases.push({
            id_fase: idFas,
            nombre: nombreFas,
            descripcion: descripcionFas,
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

    $.ajax({
        type: "POST",
        url: "Controller/btn_edita_curso_controller.php",
        data: {
            curso: JSON.stringify(curso),
            categorias: JSON.stringify(categorias_curso),
            fases: JSON.stringify(fases)
        },
        dataType: "html",
        error: function () {
            alert("error al editar");
        },
        success: function (data) {
            $("#response").empty();
            $("#response").append(data);
        }
    });
    
    alert("Su curso se editó con éxito");
    window.location.href = "ver_cursos_creados.php";
}