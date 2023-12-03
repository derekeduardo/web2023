<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
  <!-- navbar -->
  <nav class="navbar">
    <div class="logo"> 
        <h1>F&F</h1>
    </div>

    <div class="navlink">
        <a href="about.html">About</a>
        <a href="servicios.html">Services</a>
    </div>

    <div class="autorizacion">
        <a href="../index.php">Volver al Catalogo ></a>
    </div>
  </nav>

    <!-- login -->
  <div class = "contenedor">
    <img src="../assets/opcion2.png" class="img">
    <div class="contenedorR">
      <h2 class="bienvenidos">Bienvenido a F&F</h2>
      <div class="bloque"></div>
      <div class="contenedorF">
          <h1 class="login">Registrarse</h1>
              <form action="../api.php" method="post">
                <div class="separacion">
                  <div></div>
                  <input type="text" name="resource" value="usuarios" style="display: none;"> <!-- Necesario para completar la solicitud -->
                  <input type="text" name="service" value="register" style="display: none;"> <!-- Necesario para completar la solicitud --> 
                  
                  <label class="label" for="correo">Correo: </label>
                  <input class="input" type="email" name="correo" id="correo">

                  <label class="label" for="user">Usuario: </label>
                  <input class="input" type="text" name="user" id="user">

                  <label class="label" for="contrasena">Contraseña: </label>
                  <input class="input" type="password" name="contrasena" id="contrasena">

                  <div class="buttons">
                    <button class="boton" type="submit">Enviar</button>
                    <label>¿Ya tienes una cuenta?  <a href="login.php">Inicia Sesión</a></label>
                  </div>
                </div>
                </form>
        </div>
    </div>
  </div>
</body>
</html>