let ojito = document.getElementById("ojito"),
    password = document.getElementById("pass"),
    ojo = document.getElementById("ojo"),
    passw = document.getElementById("contra"),
    oji = document.getElementById("oji"),
    confi = document.getElementById("confirm_password"),
    cerra = document.getElementById("cerra"),
    recupera = document.getElementById("nueva"),
    cerrado = document.getElementById("cerrado"),
    reco = document.getElementById("confirme");

ojito.onclick = function(){
    if(password.type == "password"){
        password.type = "text";
        ojito.src = "svg/eye.svg";
    }else{
        password.type = "password";
        ojito.src = "svg/eye-slash.svg";
    }
}

ojo.onclick = function(){
    if(passw.type == "password"){
        passw.type = "text";
        ojo.src = "svg/eye.svg";
    }else{
        passw.type = "password";
        ojo.src = "svg/eye-slash.svg";
    }
}

oji.onclick = function(){
    if(confi.type == "password"){
        confi.type = "text";
        oji.src = "svg/eye.svg";
    }else{
        confi.type = "password";
        oji.src = "svg/eye-slash.svg";
    }
}

cerra.onclick = function(){
    if(recupera.type == "password"){
        recupera.type = "text";
        cerra.src = "svg/eye.svg";
    }else{
        recupera.type = "password";
        cerra.src = "svg/eye-slash.svg";
    }
}

cerrado.onclick = function(){
    if(reco.type == "password"){
        reco.type = "text";
        cerrado.src = "svg/eye.svg";
    }else{
        reco.type = "password";
        cerrado.src = "svg/eye-slash.svg";
    }
}