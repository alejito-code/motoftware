let cerra = document.getElementById("cerra"),
    recupera = document.getElementById("nueva"),
    cerrado = document.getElementById("cerrado"),
    reco = document.getElementById("confirme");
    
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