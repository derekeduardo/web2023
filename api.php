<?php
header('Content:Type: application/json');

//Sistema de direccionamiento de la API

if($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET'){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $recurso = $_POST['resource'] ?? '';
    }else{
        $recurso = $_GET['resource'] ?? '';
    }

    switch($recurso){
        case 'favoritos':
            include 'recursos/favoritos/favoritos.php';
        break;
    
        default:
        http_response_code(400);
        echo json_encode(['message' => 'Recurso solicitado no encontrado 🤔']);
        break;
    }
}

?>