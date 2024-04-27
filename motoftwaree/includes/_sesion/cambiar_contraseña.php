<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Tus meta tags y enlaces de CSS y scripts -->
  <link rel="stylesheet" href="style-contraseña.css">
  <link rel="shortcut icon" type="image/icon" href="../../../img/tuerca (1).png"/>

</head>
<body>
<div class="contenedor-principal">
    <form action="./cambiar_contra2.php" method="POST">
        <div class="contendor_3">
            <h1 class="cambio">Cambio de contraseña</h1>
        </div>
        <div class="contendor_4">
            <label for="floatingInput" class="new_password">contraseña nueva</label>
            <input type="password" class="form-control" id="floatingInput" name="new_password">
            <input type="hidden" name="id" class="password" value="<?php echo $_GET['id']; ?>">
            <button class="boton" type="submit">Enviar</button>
        </div>
    </form>
</div>
</body>
</html>