<?php include './static/header.php'?>

    <h1><?php echo $marca_c ?></h1>
    <br>

    <!-- Contenedor para mostrar los datos de la API -->
    <div id="datos-api"></div>

    <?php
        //banner vehiculo
        //nombre
        //descripción
    
    ?>

    <?php

    // Hacer la solicitud a la API
    $api_url = 'http://localhost/semestral%202023/services/api_marca.php?name='.$marca.'';
    $response = file_get_contents($api_url);
    
    if ($response !== false) {
        $data = json_decode($response, true);
    
        // Manipular los datos y mostrarlos en el contenedor
        $contenedorDatos = '<div id="datos-api">';
    
        if (!empty($data)) {
            foreach ($data as $carro) {
                $contenedorDatos .= '
                    <div>
                        <h2>' . $carro['nombre'] . '</h2>
                        <h3>' . $carro['marca'] . '</h3>
                        <p>' . $carro['descripcion'] . '</p>
                        <form action="../services/api_favoritos.php" method="get">
                        <button type="submit" name="id" value="'. $carro['id'] .'">Favorito</button>
                        </form>
                        <form action="#" method="get">
                            <button type="submit" value="'. $carro['id'] .'">Test Drive</button>
                        </form>
                        <img height="200px" src="data:image/jpg;base64,' . $carro['imagen'] . '">
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

<?php include './static/footer.php'?>
<!-- </body>
</html> -->