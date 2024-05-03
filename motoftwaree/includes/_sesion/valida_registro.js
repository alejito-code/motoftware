with(document.registro){
    onsubmit = function(e){
        e.preventDefault();
        ok = true;
        if(ok && contra.value!= confirm_password.value){
            Swal.fire({
                icon: "error",
                title: "Algo salio mal",
                text: "Revisa las contraseñas"
              });
              return false;
        }else{
            Swal.fire({
                icon: "success",
                title: "Regsitro exitoso",
                text: "Inicia sesion para continuar",
              }).then((result) => {
                if (result.value) {
                    window.location.href = "index.html"
                    if(ok){ submit();
                    }
                }
              })
        }
    }
}