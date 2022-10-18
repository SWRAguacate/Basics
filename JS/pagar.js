
function mostrar(id) {
    if (id == "1") {
        $("#Tarjeta").show();
        $("#PayPal").hide();
        $("#Efectivo").hide();
    }

    if (id == "2") {
        $("#Tarjeta").hide();
        $("#PayPal").show();
        $("#Efectivo").hide();
    }

    if (id == "3") {
        $("#Tarjeta").hide();
        $("#PayPal").hide();
        $("#Efectivo").show();
    }
    
    if (id == "0") {
        $("#Tarjeta").hide();
        $("#PayPal").hide();
        $("#Efectivo").hide();
    }
    
    if (id != "1" && id != "2" && id != "3" && id != "0") {
        $("#Tarjeta").hide();
        $("#PayPal").hide();
        $("#Efectivo").hide();
        $("#Otro").show();
    }
}