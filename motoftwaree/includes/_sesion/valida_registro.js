with(document.registro){
    onsubmit = function(e){
        e.preventDefault();
        ok = true;
        if(ok && contra.value!= confirm_password.value){
            Swal.fire({
                icon: "error",
                title: "Nooo",
                text: "Devuelvase que no son iguales las contraseñas!"
              });
              return false;
        }else{
            Swal.fire({
                icon: "success",
                title: "Melo",
                text: "Si te registro",
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