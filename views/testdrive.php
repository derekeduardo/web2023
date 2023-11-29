<?php include './static/header.php'?>

    <h1>TestDrive</h1>
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
    $api_url = 'http://localhost/semestral%202023/services/admin/api_admintestdrive.php';
    $response = file_get_contents($api_url);
    
    if ($response !== false) {
        $data = json_decode($response, true);
    
        // Manipular los datos y mostrarlos en el contenedor
        $contenedorDatos = '<div id="datos-api">';
        if (!empty($data)) {
            foreach ($data as $testdrive) {
                $contenedorDatos .= '
                    <div>
                        <h2>' . $testdrive['id_test'] . '</h2>
                        <h3>' . $testdrive['id_carro'] . '</h3>
                        <p>' . $testdrive['id_user'] . '</p>
                        <p>' . $testdrive['fecha'] . '</p>
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