<!-- Añadier session.php para trabajar con la sesión del usuario
    Insertar el archivo link css
-->
<?php include __DIR__.'../../components/session.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/styles-admin.css">
    <title><?php echo $title_info ?></title>
</head>
<body>    
    <nav class="navbar">
        <div class="logo"> 
            <a href="dashboard.php"> <h1>F&F</h1> </a>
        </div>
    
        <div class="navlink">
            <a href="registrocarros.php">Añadir vehículos</a>
            <a href="testdrive.php">Solicitudes de Test Drive</a>
        </div>

        <div class="autorizacion">
            <a href="../../api.php?resource=usuarios&service=logout">Logout</a>
        </div>
    </nav>

    <h1 class="title">Solicitudes de Test Drive</h1>
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
$api_url = 'http://localhost/semestral%202023/api.php?resource=testdrive&service=get';
$response = file_get_contents($api_url);

if ($response !== false) {
    $data = json_decode($response, true);

    // Manipular los datos y mostrarlos en el contenedor
    $contenedorDatos = '<div id="datos-api">';

    if (!empty($data)) {
        foreach ($data as $testdrive) {
            $contenedorDatos .= '
                <div class="testdrives">
                    <h2>ID Test: ' . $testdrive['id_test'] . '</h2>
                    <hr>
                    <div class="direccion">
                        <h4>ID Carro: ' . $testdrive['id_carro'] . '</h4>
                        <p>ID Usuario: ' . $testdrive['id_user'] . '</p>
                        <p>Nombre del Carro: ' . $testdrive['nombre'] . '</p>
                        <p>Usuario: ' . $testdrive['usuario'] . '</p>
                        <p>Correo: ' . $testdrive['correo'] . '</p>
                        <p>Fecha: ' . $testdrive['fecha'] . '</p>
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