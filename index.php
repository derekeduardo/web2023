<?php include './views/components/header.php'?>
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
<?php include './views/components/footer.php' ?>

