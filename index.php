<?php include './views/static/header.php'?>
<h1>BIENVENIDO</h1>
    <br>
    <a href="./views/login.php">Iniciar Sesión</a>
    <br>
    <a href="./views/registro.php">Registrarse</a>
    <br>
    <a href="./views/CarsView.php?brand=Lexus">Lexus</a>
    <br>
    <a href="./views/CarsView.php?brand=Jeep">Jeep</a>
    <br>
    <a href="./views/CarsView.php?brand=Mercedes">Mercedes</a>
    <br>
    <br>
    <a href="./services/logout.php">Logout</a>
    <br>
    <?php
        if(isset($_SESSION['id_usuario'])){
            echo '<a href="./views/favoritos.php">Favoritos</a>';
        };
    ?>
    <br>
<?php include './views/static/footer.php' ?>

