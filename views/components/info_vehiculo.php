<!-- <?php

$URL = 'http://localhost/semestral%202023/services/vehiculos/get_info.php?brand='.$marca.'';

$response_container = file_get_contents($URL);

if($response_container !== false){
    $info = json_decode($response, true);
    echo "DEBERIA SALIR ESTO";
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

?> -->