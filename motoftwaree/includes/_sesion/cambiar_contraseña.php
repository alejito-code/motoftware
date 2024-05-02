<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Tus meta tags y enlaces de CSS y scripts -->
  <title>Motoftware</title>
  <link rel="stylesheet" href="style-contraseña.css">
  <link rel="shortcut icon" type="image/icon" href="../../../img/tuerca (1).png"/>
</head>
<body>
<div class="contenedor-principal">
    <form action="./cambiar_contra2.php" method="POST" name="registro">
        <div class="contendor_3">
            <h1 class="cambio">Cambio de contraseña</h1>
        </div>
        <div class="contendor_4">

        <div class="contenedor-input">
          <label for="floatingInput" class="new_password">Contraseña nueva</label>
            <div class="input-container">
              <input type="password" class="form-control contra" id="nueva" name="new_password">
              <span class="icono">
                <img src="svg/eye-slash.svg" class="imgSvg" id="cerra"/>
              </span>
            </div>
        </div>    

        <div class="contenedor-input">
          <label for="floatingInput" class="new_password">Confirmar contraseña</label>
            <div class="input-container">
              <input type="password" class="form-control contra" id="confirme" name="new_password">
              <span class="icono">
                <img src="svg/eye-slash.svg" class="imgSvg" id="cerrado"/>
              </span>
            </div>
          <input type="hidden" name="id" class="password" value="<?php echo $_GET['id']; ?>">
        </div> 
          <button class="boton" type="submit">Enviar</button>
        </div>
    </form>
</div>
</body>
<script src="ver_contra_cam.js"></script>

<script src="valida_registro_cambio.js"></script>

<script src="../../package/dist/sweetalert2.all.js"></script>
</html>