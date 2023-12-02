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
          <a href="../index.php"><h1>F&F</h1></a>
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
      <div class="div"></div>
      <div class="contenedorF">
          <h1 class="login">Registro</h1>
              <form action="../api.php" method="post">
                  <input type="text" name="resource" value="usuarios" style="display: none;"> <!-- Necesario para completar la solicitud -->
                  <input type="text" name="service" value="register" style="display: none;"> <!-- Necesario para completar la solicitud --> 

                  <div class="separacion">
                  <label class="label" for="correo">Correo: </label>
                  <input class="input" type="email" name="correo" id="correo">
                  </div>
                  <br>

                  <div class="separacion">
                  <label class="label" for="user">Usuario: </label>
                  <input class="input" type="text" name="user" id="user">
                  </div>
                  <br>

                  <div class="separacion">
                  <label class="label" for="contrasena">Contraseña: </label>
                  <input class="input" type="password" name="contrasena" id="contrasena">
                  </div>
                  <br>

                  <button class="boton" type="submit">Enviar</button>
                </form>
          <br>
          <button><a href="login.php">Login</a></button>
        </div>
    </div>
  </div>
</body>
</html>