<!-- Añadier session.php para trabajar con la sesión del usuario
    Insertar el archivo link css
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="login.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>Login</h1>
    <form action="../recursos/api_login.php" method="post">
        <input type="text" name="user" placeholder="Usuario">
        <input type="password" name="password" placeholder="Contraseña">
        <br>
        <button type="submit">Iniciar sesión</button>
    </form>
    <br>
    <button><a href="registro.php">Registrarse</a></button>
</body>
</html>