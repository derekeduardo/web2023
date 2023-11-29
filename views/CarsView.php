<?php include './components/header.php'?>


    <!-- Contenedor con la información de la marca seleccionada -->

    <?php 
        $URL = 'http://localhost/semestral%202023/services/vehiculos/get_info.php?brand='.$marca.'';

        $response_container = file_get_contents($URL);
        
        if($response_container !== false){
            $info = json_decode($response_container, true);
            $container = "<div>";
        
            if (!empty($info)) {
                foreach($info as $brand){
                    $container .= '
                        <div>
                            <img height="200px" src="data:image/jpg;base64,' . $brand['banner'] . '">
                            <div>
                                <h3>'. $brand['marca'] .'</h3>
                                <h3>'. $brand['descripcion'] .'</h3>
                            </div>
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
    $api_url = 'http://localhost/semestral%202023/services/vehiculos/api_marca.php?name='.$marca.'';
    $response = file_get_contents($api_url);
    
    if ($response !== false) {
        $data = json_decode($response, true);
    
        // Manipular los datos y mostrarlos en el contenedor
        $contenedorDatos = '<div>';
        if (!empty($data)) {
            foreach ($data as $carro) {
                $contenedorDatos .= '
                    <div>
                        <h2>' . $carro['nombre'] . '</h2>
                        <h3>' . $carro['marca'] . '</h3>
                        <p>' . $carro['descripcion'] . '</p>
                        <form action="../services/api_favoritos.php" method="get">
                            <input type="text" name="action" value="1" style="display:none;">
                            <button type="submit" name="id" value="'. $carro['id'] .'">Favorito</button>
                        </form>
                        <form action="../services/api_testdrive.php" method="post">
                            <button type="submit" name="id" value="'. $carro['id'] .'">Test Drive</button>
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

<?php include './components/footer.php'?>
<!-- </body>
</html> -->