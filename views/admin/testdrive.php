<!-- Añadier session.php para trabajar con la sesión del usuario
    Insertar el archivo link css
-->
<?php include __DIR__.'../../components/session.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title><?php echo $title_info ?></title>
</head>
<body>    
    <nav>
        <div>
            <ul>
                <li><h1>Logo</h1></li>
                <li><div>
                    <a href="./views/perfil.php">Perfil</a>
                    <a href="./services/logout.php">Logout</a>
                </div></li>
                <li><div>
                    <a href="./views/login.php">Iniciar Sesión</a>
                    <a href="./views/registro.php">Registrarse</a>
                </div></li>
            </ul>
        </div>
    </nav>

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
$api_url = 'http://localhost/semestral%202023/api.php?resource=testdrive&service=get';
$response = file_get_contents($api_url);

if ($response !== false) {
    $data = json_decode($response, true);

    // Manipular los datos y mostrarlos en el contenedor
    $contenedorDatos = '<div id="datos-api">';

    if (!empty($data)) {
        foreach ($data as $testdrive) {
            $contenedorDatos .= '
                <div>
                    <h2>ID Test: ' . $testdrive['id_test'] . '</h2>
                    <h3>ID Carro: ' . $testdrive['id_carro'] . '</h3>
                    <p>ID Usuario: ' . $testdrive['id_user'] . '</p>
                    <p>Nombre del Carro: ' . $testdrive['nombre'] . '</p>
                    <p>Usuario: ' . $testdrive['usuario'] . '</p>
                    <p>Correo: ' . $testdrive['correo'] . '</p>
                    <p>Fecha: ' . $testdrive['fecha'] . '</p>
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