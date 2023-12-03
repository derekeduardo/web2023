<?php include './components/session.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    
    <?php   if(isset($_GET['alert'])){

        switch($_GET['alert']){
            case 'v_exist':
                $title = "Vehículo Existente";
                $message = "El vehículo seleccionado ya forma parte de tus favoritos";
            break;
            case 'v_create':
                $title = "Vehículo Creado";
                $message = "Se ha añadido un nuevo vehículo a su lista de favoritos";
            break;
        }?>
        <div>

            <div class="alertMessage">
                <strong><?php $title ?></strong> <?php $message?>
            </div>

        </div>
    <?php } ?>

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
                    <form action="../recursos/api_testdrive.php" method="post">
                    <input type="text" name="key" value="'.$key.'" style="display: none;">
                    <button type="submit" name="id" value="'. $carro['id_carro'] .'">Test Drive</button>
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