
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