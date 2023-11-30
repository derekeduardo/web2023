<?php
    session_start();
    $title_info = "Welcome!";
    if (isset($_GET['brand'])){
        $marca = $_GET['brand'];
        $marca_c = ucfirst($marca);
        $title_info = ucfirst($marca);
    }
    if (isset($_SESSION['id_usuario'])){
        $key = $_SESSION['id_usuario'];
    }
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title><?php echo $title_info ?></title>
</head>
<body>    
    <nav>
        <div>
            <ul>
                <li><h1>Logo</h1></li>
                <li><div>
                    <a href="./views/perfil.php">Perfil</a>
                    <a href="./services/logout.php">Logout</a>
                </div></li>
                <li><div>
                    <a href="./views/login.php">Iniciar Sesión</a>
                    <a href="./views/registro.php">Registrarse</a>
                </div></li>
            </ul>
        </div>
    </nav> -->

    