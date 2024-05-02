with(document.registro){
    onsubmit = function(e){
        e.preventDefault();
        ok = true;
        if(ok && nueva.value!= confirme.value){
            Swal.fire({
                icon: "error",
                title: "Nooo",
                text: "Revisa!"
              });
              return false;
        }if(ok && nueva.value==""){
            Swal.fire({
                icon: "error",
                title: "Nooo.",
                text: "Revisa!"
              });
              return false;
        }
        
        else{
            Swal.fire({
                icon: "success",
                title: "melo",
                text: "Si te cambio",
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