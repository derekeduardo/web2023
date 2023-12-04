<?php include '../views/components/session.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title><?php echo $title_info ?></title>
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
            <a href="contactos.html">Contacts</a>
        </div>

        <div class="autorizacion">
            <a href="./views/login.php">Iniciar sesión</a>
            <a href="./views/registro.php">Registrarse</a>
            <!-- <a href="./views/perfil.php">Perfil</a>
            <a href="./services/logout.php">Logout</a> -->
        </div>
    </nav>  

    <div class="banner-container">
        <img src="../assets/Diseño sin título.png" alt="Banner Image" style="width: 100%; height: auto;">
        <div class="banner-text">
            <h2 class="texth1">About</h2>
            <p>Encargados de que obtengas el auto de tus sueños.</p>
        </div>
        <div class="button-container">
            <button>Ver más</button>
        </div>
    </div>
   
    <div class="project-section">
        <h3>Sobre nuestro proyecto</h3>
        <p>¡Te damos la bienvenida a nuestra agencia de automóviles, donde encontrar el coche perfecto es sencillo y personalizado! En nuestra plataforma, puedes seleccionar tus coches favoritos, agendar pruebas de manejo y gestionar tu cuenta de manera intuitiva.

Con solo unos clics, añade a tus favoritos los modelos que más te encanten y agenda un test drive para asegurarte de que sea la elección ideal. Además, dentro de tu cuenta, tienes control total para gestionar tus datos y actualizar tus preferencias en cualquier momento.

Nuestros administradores cuentan con herramientas especiales para mantener la plataforma actualizada y relevante. Ellos tienen acceso a toda la información de los vehículos, registros y la capacidad de mantener la base de datos al día.</p>
    </div>
    <br>

<!-- Título "Sobre nosotros" -->
<div class="about-us-section">
    <h2>Sobre nosotros</h2>
    <!-- Contenedor para los párrafos de las 5 personas -->
    <div class="persons-container">
        <div class="person">
            <h3>su nombre</h3>
            <p>sobre ustedes</p>
        </div>
        <div class="person">
            <h3>su nombre</h3>
            <p>sobre ustedes 2</p>
        </div>

        <div class="person">
            <h3>su nombre</h3>
            <p>sobre ustedes 2</p>
        </div>
    </div>
<div class="persons-container2">
    <div class="personx">
            <h3>su nombre</h3>
            <p>sobre ustedes</p>
        </div>

        <div class="personx">
            <h3>su nombre</h3>
            <p>sobre ustedes</p>
        </div>

    <div>
</div>
    </div>
</div>

</body>
</html>

