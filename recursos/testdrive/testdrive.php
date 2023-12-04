<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET'){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $servicio = $_POST['service'] ?? '';
    }else{
        $servicio = $_GET['service'] ?? '';
    }

    switch($servicio){
        case 'get':
            include 'services/gettestdrive.php';
        break;

    
        default:
            http_response_code(400);
            echo json_encode(['message' => 'Servicio no encontrado']);
        break;
    }
}
?>