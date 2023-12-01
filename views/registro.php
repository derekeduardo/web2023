<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="login.css" rel="stylesheet" />

</head>
<body>
      
<h1>Registro</h1>
    <form action="../api.php" method="post">
        <input type="text" name="resource" value="usuarios" style="display: none;"> <!-- Necesario para completar la solicitud -->
        <input type="text" name="service" value="register" style="display: none;"> <!-- Necesario para completar la solicitud --> 
        <label for="correo">Correo: </label>
        <input type="email" name="correo" id="correo">
        <br>
        <label for="user">Usuario: </label>
        <input type="text" name="user" id="user">
        <br>
        <label for="contrasena">Contraseña: </label>
        <input type="password" name="contrasena" id="contrasena">
        <br>
        <button type="submit">Enviar</button>
      </form>
<div>
  <br>
  <button><a href="login.php">Login</a></button>
    
</div>
</body>
</html>