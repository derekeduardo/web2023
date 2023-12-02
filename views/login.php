<!-- Añadier session.php para trabajar con la sesión del usuario
    Insertar el archivo link css
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
    <div class="contenedor">
        <img src="../assets/opcion2.png" class="img">
        <div class="contenedorL">
            <h2 class="bienvenido">Bienvienido de vuelta</h2>
            <div class="div"></div>
            <div class="contenedorF">
                <h1 class=login>Login</h1>
                <form class="form" action="../api.php" method="post">
                    <input type="text" name="resource" value="usuarios" style="display: none;"><!-- Necesario para completar la solicitud --> 
                    <input type="text" name="service" value="login" style="display: none;"><!-- Necesario para completar la solicitud --> 

                    <div class="separacion">
                        <label class="label"> Usuario: </label>
                        <input class="input" type="text" name="user" placeholder="Usuario">
                    </div>

                    <div class="separacion">
                        <label class="label"> Contraseña: </label>
                        <input class="input" type="password" name="password" placeholder="Contraseña">
                    </div>

                    <button class="boton" type="submit">Iniciar sesión</button>
                </form>
                <button><a href="registro.php">Registrarse</a></button>
            </div>
        </div>
    </div>
    
</body>
</html>