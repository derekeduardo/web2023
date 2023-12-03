<?php
header("Content-Type: application/json");
require_once(__DIR__. '../../../connection/Database.php');
require_once(__DIR__. '../../Class/VehiculosServicio.php');

$db = Database::getInstance();
$v_servicio = new VehiculosServicio($db);

$id_carro = $_POST['id'] ?? '';

if($id_carro != ''){

    $v_servicio -> deleteVehicle($id_carro);
    header("Location: http://localhost/semestral%202023/views/admin/dashboard.php?alert=v_delete");
}else{
    http_response_code(400);
    echo json_encode(['message' => 'Hacen falta datos para completar la solicitud']);
}

?>