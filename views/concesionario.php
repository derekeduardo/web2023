<?php include './components/session.php'?>

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

    <!-- Contenedor con la información de la marca seleccionada -->

    <?php 
        $URL = 'http://localhost/semestral%202023/recursos/vehiculos/get_info.php?brand='.$marca.'';

        $response_container = file_get_contents($URL);
        
        if($response_container !== false){
            $info = json_decode($response_container, true);
            $container = "<div>";
            if (!empty($info)) {
                foreach($info as $brand){
                    $container .= '
                        <div>
                            <img class="img" src="data:image/jpg;base64,' . $brand['banner'] . '">
                            <div class= "encabezado">
                                <h3 class="titulo">'. $brand['marca'] .'</h3>
                                <h3 class="parrafo">'. $brand['descripcion'] .'</h3>
                            </div>
                            <hr class="hr">
                        </div>
                    ';
                }
            }
            $container .= '</div>';
            echo $container;
        } else {
            echo 'Error al obtener los datos de la api';
        }
    
    ?>


    <!--Listas de Vehiculos -->
    <?php

    // Hacer la solicitud a la API
    $api_url = 'http://localhost/semestral%202023/recursos/vehiculos/api_marca.php?name='.$marca.'';
    $response = file_get_contents($api_url);
    
    if ($response !== false) {
        $data = json_decode($response, true);
    
        // Manipular los datos y mostrarlos en el contenedor
        $contenedorDatos = '<div class="muestra">';
        if (!empty($data)) {
            foreach ($data as $carro) {
                $contenedorDatos .= '
                    <div class="carros">
                        <img height="200px" src="data:image/jpg;base64,' . $carro['imagen'] . '">
                        <div class="separacion">
                            <p class="modelito"> Modelo </p>
                            <h2>' . $carro['nombre'] . '</h2>
                            <h3 class="marca-carro">' . $carro['marca'] . '</h3>
                        </div>
                        <p class="carro-descripcion">' . $carro['descripcion'] . '</p>
                        <div class="buttons">
                            <form action="../recursos/api_testdrive.php" method="post">
                                <input type="text" name="key" value="'.$key.'" style="display: none;">
                                <button class="test" type="submit" name="id" value="'. $carro['id'] .'">Test Drive</button>
                            </form>
                            <form action="../api.php" method="post">
                                <input type="text" name="resource" value="favoritos" style="display:none;">
                                <input type="text" name="service" value="add" style="display:none;">
                                <button class="fav" type="submit" name="id" value="'. $carro['id'] .'">Favorito</button>
                            </form>
                        </div>
                    </div>';
            }
        } else {
            $contenedorDatos .= '<p>No hay registros</p>';
        }
    
        $contenedorDatos .= '</div>';
        echo $contenedorDatos;
    } else {
        echo 'Error al obtener datos de la API';
    }

    
    ?>

</body>
</html>
