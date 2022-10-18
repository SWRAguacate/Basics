function validar(){
    var nombre, correo, contraseña, expresion, expresion2;
    nombre = document.getElementById("nombre").value;
    correo = document.getElementById("correo").value;
    contraseña = document.getElementById("contraseña").value;
    correo2 = document.getElementById("correo2").value;
    contraseña2 = document.getElementById("contraseña2").value;

    expresion = /\w+@\w+\.+[a-z]/;
    expresion2 = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z0-9\d$@$!%*?&]{8,35}/;
    var expresion3 = /[A-Za-z]/;

    if(nombre === "" || correo === "" || contraseña === "" ){
        alert("Favor de llenar todos los datos");
        return false;
    }

    else if(!expresion3.test(nombre)){
        alert("Nombre solo debe inluir letras")
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

    else if(correo2.length>80){
        alert("El nombre es muy largo")
        return false;
    }

    alert("Registro exitoso")

}