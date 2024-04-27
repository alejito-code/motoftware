<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style-contraseña.css">
  <script src="../../js/fonts.js"></script>
  <title>Validacion</title>
  <link rel="shortcut icon" type="image/icon" href="../../../img/tuerca (1).png"/>

</head>
<a href="./index.html" class="atras"
      ><i class="fas fa-chevron-left"></i> Atras</a>

<body class="text-center">
  <main class="contenedor">
    <div class="contendor_1">
      <h1 class="titulo_enlace">Por favor ingresa el correo al cual enviaremos un enlace para que puedas restablecer tu contraseña</h1>
    </div>
    <div class="contendor_2">
      <form action="./enviar_correo.php" method="POST">
        <div class="form-floating mb-3">
          <input type="email" class="form-control email" id="floatingInput" placeholder="name@example.com" name="email" required>
        </div>
        <div class="d-flex justify-content-center">
          <button id="recuperar" type="submit" class="btn">Enviar</button>
        </div>
      </form>
    </div>
  </main>
</body>
</html>