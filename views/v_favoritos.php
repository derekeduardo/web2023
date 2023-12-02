<?php include './components/session.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title_info ?></title>
    <link rel="stylesheet" href="./assets/css/style.css">
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

    <?php 
    // Hacer la solicitud a la API
    $api_url = 'http://localhost/semestral%202023/api.php?resource=favoritos&service=get&key='.$key;
    $response = file_get_contents($api_url);
    if ($response !== false) {
        $data = json_decode($response, true);
    
        // Manipular los datos y mostrarlos en el contenedor
        $contenedorDatos = '<div id="datos-api">';
        if (!empty($data)) {
            foreach ($data as $carro) {
                $contenedorDatos .= '
                    <div>
                        <img height="200px" src="data:image/jpg;base64,' . $carro['imagen'] . '">
                        <div>
                            <h2>' . $carro['nombre'] . '<r/h2>
                            <h3>' . $carro['marca'] . '</h3>
                            <p>' . $carro['descripcion'] . '</p>
                        </div>
                        <div>
                            <form action="../api.php" method="post">
                            <input type="text" name="resource" value="favoritos" style="display:none;">
                            <input type="text" name="service" value="delete" style="display:none;">
                            <button type="submit" name="id" value="'. $carro['id_carro'] .'">Quitar Favorito</button>
                            </form>
                            <form action="#" method="get">
                                <button type="submit" value="'. $carro['id_carro'] .'">Test Drive</button>
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
<footer></footer>
</html>