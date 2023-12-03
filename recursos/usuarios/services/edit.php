<?php
    header("Content-Type: application/json");
    require_once(__DIR__ . '../../Class/UsuarioServicio.php');
    require_once(__DIR__ . '../../../connection/Database.php');

    $db = Database::getInstance();
    $u_servicio = new UsuarioServicio($db);

    $replace_data = $_POST['new_data'] ?? '';
    $column = $_POST['column'] ?? '';

    if($replace_data !== '' && $column !== ''){
        $u_servicio->editUserData($replace_data, $column);
    }else{
        http_response_code(400);
        echo json_encode(['message' => 'Faltan parámetros para continuar con la solicitud']);
    }



?>