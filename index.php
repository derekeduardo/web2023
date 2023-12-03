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
    <!-- navbar -->
    <?php if(isset($_SESSION['id_usuario'])) { ?>
        <nav class="navbar">
            <div class="logo"> 
                <a href="index.php"> <h1>F&F</h1> </a>
            </div>
        
            <div class="navlink">
                <a href="about.html">About</a>
                <a href="servicios.html">Services</a>
                <a href="./views/v_favoritos.php">Favoritos</a>
            </div>

            <div class="autorizacion">
                <a href="./views/usuario/editar_usuario.php">Perfil</a>
                <a href="./recursos/usuarios/services/logout.php/logout.php">Logout</a> 
            </div>
        </nav>
    <?php } else { ?>
        <nav class="navbar">
            <div class="logo"> 
                <h1>F&F</h1>
            </div>
        
            <div class="navlink">
                <a href="about.html">About</a>
                <a href="servicios.html">Services</a>
            </div>

            <div class="autorizacion">
                <a href="./views/login.php">Iniciar sesión</a>
                <a href="./views/registro.php">Registrarse</a>
            </div>
        </nav>
    <?php } ?>


    <!-- img de contenido -->
    <div class="contenedor">
        <img class="img" src="./assets/jeep.png">
        <div class="contenido">
            <div class="textos">
                <h1 class="titulo">Descubre tu acompañante de aventuras</h1>
                <p class="parrafo"> Explora una exquisita selección de vehículos que no solo satisfacen tus necesidades prácticas, sino que también despiertan la pasión por la conducción</p>
            </div>
            <a href="./views/concesionario.php?brand=jeep" class="boton">Descubre jeep</a>
        </div>
    </div> 

    <!-- marcas -->
    <div class="marcas">
        <a class="cuadro" href="./views/concesionario.php?brand=jeep">
            <p class="marca">Marca</p> 
            <h3>Jeep</h3>
            <br>
            <p> Descubre el poder de la aventura, la resistencia todoterreno y el estilo inconfundible en cada recorrido. </p>
            <br>
            <p class="marca">Ver mas</p> 
        </a>


        <a class="cuadro" href="./views/concesionario.php?brand=lexus">
            <p class="marca">Marca</p> 
            <h3>Lexus</h3>
            <br>
            <p> Eleva tu experiencia de conducción. Lujo, innovación y un rendimiento excepcional se fusionan en cada detalle.</p>
            <br>
            <p class="marca">Ver mas</p> 
        </a>

        <a class="cuadro" href="./views/concesionario.php?brand=mercedes">
            <p class="marca">Marca</p> 
            <h3>Mercedes Benz</h3>
            <br>
            <p> Cada detalle refleja lujo y rendimiento incomparables. Conduce hacia el futuro con un icono de prestigio.</p>
            <br>
            <p class="marca">Ver mas</p> 
        </a>
    </div>


    <!-- Ultimo Favorito -->
    <?php 
        if(isset($_COOKIE['id_usuario']) && isset($_SESSION['id_usuario'])){
            if($_COOKIE['id_usuario'] == $_SESSION['id_usuario']){
                echo '
                <div class=\"cookie_container\">
                    
                    <div class=\"cookie__icono\">
                        <h1>ICONO</h1>
                    </div>

                    <div class=\"cookie__info\">
                        <h3 class=\"cookie__info__nombre\">'.$_COOKIE['nombre'].'</h3>
                        <spam class=\"cookie__info__marca\">'.$_COOKIE['marca'].'</spam>
                        <p class=\"cookie__info__descripcion\">'.$_COOKIE['descripcion'].'</p>
                    </div>
                
                </div>
            ';
            }
        }
    ?>


    <!-- <br>
    <?php
        if(isset($_SESSION['id_usuario'])){
            echo '<a href="./views/favoritos.php">Favoritos</a>';
        };
    ?>
    <br> -->


    </body>
</html>