with(document.registro){
    onsubmit = function(e){
        e.preventDefault();
        ok = true;
        if(ok && nueva.value!= confirme.value){
            Swal.fire({
                icon: "error",
                title: "Algo salio mal",
                text: "Revisa las contraseñas"
              });
              return false;
        }if(ok && nueva.value==""){
            Swal.fire({
                icon: "error",
                title: "Algo salio mal",
                text: "Te falto confirmar las contraseñas"
              });
              return false;
        }
        
        else{
            Swal.fire({
                icon: "success",
                title: "Cambio exitoso",
                text: "Cambio de contraseña correctamente",
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