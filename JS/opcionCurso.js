function hola(id) {
  
    if (id == "link") {
        $("#link").show();
        $("#title").show();
        $("#file").hide();
    }

    if (id == "file") {
        $("#file").show();
        $("#link").hide();
        $("#title").show();
    }

    if (id == "") {
        $("#file").hide();
        $("#link").hide();
        $("#title").hide();
    }

}