with(document.registro){
    onsubmit = function(e){
        e.preventDefault();
        ok = true;
        if(ok && contra.value!= confirm_password.value){
            Swal.fire({
                icon: "error",
                title: "Algo salio mal",
                text: "Revisa las contraseñas",
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
              });
              return false;
        }else{
            Swal.fire({
                icon: "success",
                title: "Registro exitoso",
                text: "Inicia sesion para continuar",
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
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