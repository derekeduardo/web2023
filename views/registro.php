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
    <form action="../services/api_register.php" name="registro" method="post">
        <label for="correo">Correo: </label>
        <input type="text" name="correo" id="correo">
        <br>
        <label for="user">Usuario: </label>
        <input type="text" name="user" id="user">
        <br>
        <label for="contrasena">Contraseña: </label>
        <input type="text" name="contrasena" id="contrasena">
        <br>
        
        <button type="submit">Enviar</button>
      </form>
<div>
  <br>
  <button><a href="login.php">Login</a></button>
    
</div>
</body>
</html>