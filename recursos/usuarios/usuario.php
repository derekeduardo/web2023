<?php 
    header("Content-Type: application/json");
    if($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET'){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $service = $_POST['service'] ?? ''; 
        }else{
            $service = $_GET['service'] ?? ''; 
        }

        switch($service){
            case 'login':
                include 'services/login.php';
            break;

            case 'register':
                include 'services/register.php';
            break;

            case 'logout':
                include 'services/logout.php';
            break;

            case 'edit':
                include 'services/edit.php';
            break;
                
            default:
                http_response_code(400);
                echo json_encode(['message' => 'La ruta no cumple con los credenciales solicitados.' .$service]);
            break;
        }
    }
?>