
  
  <?php

  /**
   * Parte de registro de usuarios
   */

    include "../db.php"; 
	if(isset($_POST)){

		$nombre = $_POST['nombre'];
		$correo = $_POST['correo'];
		$telefono = $_POST['telefono'];
		$password = $_POST['password'];
		$rol= $_POST['rol'];


		$consulta = "INSERT INTO user (nombre, correo, telefono, password, rol)
		VALUES ('$nombre', '$correo', '$telefono', '$password', '$rol')";
		$resultado=mysqli_query($conexion, $consulta);

		if ($resultado) {
			echo "<script language='JavaScript'>
			alert('¡Registro exitoso! Inicie sesion para continuar.');
			location.assign('index.html');
			</script>";
		} else {
			echo "<script language='JavaScript'>
			 alert('No se pudo registrar, valide los datos ingresados.');
			 location.assign('index.html');
			 </script>";
		}
	}else{
		echo 'No data';
	}
	






