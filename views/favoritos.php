<?php include './static/header.php'?>

    <!-- Contenedor para mostrar los datos de la API -->
    <!-- <div id="datos-api"></div> -->


    <?php 
    // Hacer la solicitud a la API
    $api_url = 'http://localhost/semestral%202023/services/api_favoritos.php?action=2';
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
                            <h2>' . $caro['nombre'] . '<r/h2>
                            <h3>' . $carro['marca'] . '</h3>
                            <p>' . $carro['descripcion'] . '</p>
                        </div>
                        <div>
                            <form action="#" method="get">
                            <input type="text" name="action" value="1" style="display:none;">
                            <button type="submit" name="id" value="'. $carro['id'] .'">Quitar Favorito</button>
                            </form>
                            <form action="#" method="get">
                                <button type="submit" value="'. $carro['id'] .'">Test Drive</button>
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

<?php include './static/footer.php'?>