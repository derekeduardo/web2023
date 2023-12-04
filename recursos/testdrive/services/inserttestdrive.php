<?php
    header("Content-Type: application/json");
    require_once(__DIR__ . '../../../connection/Database.php');
    require_once(__DIR__ . '../../Class/TestDriveServicio.php');
    //LLamar a la instancia de la base de datos
    $db = Database::getInstance();
    $testdriveservicio = new TestDriveServicio($db);

    $id_carro = $_POST['id'] ?? '';

    if($id_carro !== ''){
       $testdriveservicio->insertTestDrive($id_carro); 
    }else{
        http_response_code(400);
        echo json_encode(['message' => 'No se ha podido establecer el servicio...']);
    }
  
?>