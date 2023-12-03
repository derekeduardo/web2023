<?php

    if($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET'){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $service = $_POST['service'];
        }else{
            $service = $_GET['service'];
        }

        switch($service){
            case 'get_vehicles':
                include 'services/get_vehicles.php';
            break;

            case 'get_info':
                include 'services/get_info.php';
            break;

            case 'delete_vehicle':
                include 'services/delete_vehicle.php';
            break;
            
            case 'get_all_vehicles':
                include 'services/get_all_vehicles.php';

            default:
                http_response_code(400);
                echo json_encode(['message' => 'No se ha encontrado el servicio seleccionado']);
            break;
        }

    }


?>