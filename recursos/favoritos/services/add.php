<?php
    require_once(__DIR__ . '../../../connection/Database.php');
    require_once(__DIR__ . '../../Class/FavoritoServicio.php');
    //LLamar a la instancia de la base de datos
    $db = Database::getInstance();
    $favoritos_servicio = new FavoritosServicio($db);

    //Solicitamos los datos necesarios
    //$id_usuario = $_POST['key'] ?? '';
    $id_carro = $_POST['id'] ?? '';
    if($id_carro != ''){

        $favoritos_servicio -> addFavorito($id_carro);

    }else{
        http_response_code(400);
        echo json_encode(['message' => 'Hacen falta datos para completar la solicitud']);
    }

    //http://localhost/semestral%202023/api.php
?>