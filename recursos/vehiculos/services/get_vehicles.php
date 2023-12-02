<?php
header("Content-Type: application/json");
require_once(__DIR__. '../../../connection/Database.php');
require_once(__DIR__. '../../Class/VehiculosServicio.php');

$db = Database::getInstance();
$v_servicio = new VehiculosServicio($db);

$marca = $_GET['brand'] ?? '';

if($marca !== ''){
    $v_servicio ->getListOfVehicles($marca);
}else{
    http_response_code(400);
    echo json_encode(['message' => 'Faltan parámetros para completar la solicitud']);
}
?>