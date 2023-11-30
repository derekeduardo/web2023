<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET'){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $servicio = $_POST['service'] ?? '';
    }else{
        $servicio = $_GET['service'] ?? '';
    }

    switch($servicio){
        case 'add':
            include 'services/add.php';
        break;

        case 'delete':
            include 'services/delete.php';
        break;

        case 'get':
            include 'services/get.php';
        break;
    
        default:
            http_response_code(400);
            echo json_encode(['message' => 'Servicio no encontrado']);
        break;
    }
}
?>