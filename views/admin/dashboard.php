<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

    <?php session_start(); ?> 

    <h1>Bienvenido <?php echo $_SESSION['user'] ?> 👨‍💻</h1>
    
    <nav>
        <span>Dashboard</span>
        <ul>
            <li><a href="#">Añadir vehículos</a></li>
            <li><a href="#">Listado de vehículos</a></li>
            <li><a href="../../api.php?resource=usuarios&service=logout">Logout</a></li>
        </ul>
    </nav>

</body>
</html>