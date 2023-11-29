<?php include './views/components/session.php'?>

<!DOCTYPE html>
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
    </nav>


<h1>BIENVENIDO</h1>
    <br>
    <a href="./views/CarsView.php?brand=lexus">Lexus</a>
    <br>
    <a href="./views/CarsView.php?brand=jeep">Jeep</a>
    <br>
    <a href="./views/CarsView.php?brand=mercedes">Mercedes</a>
    <br>
    <?php
        if(isset($_SESSION['id_usuario'])){
            echo '<a href="./views/favoritos.php">Favoritos</a>';
        };
    ?>
    <br>


    </body>
</html>


