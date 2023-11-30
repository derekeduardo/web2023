<?php 
require_once(__DIR__ . '../../../connection/Database.php');
require_once(__DIR__ . '../../Class/FavoritoServicio.php');

$db = Database::getInstance();
$favoritos_servicio = new FavoritosServicio($db);

$id_usuario = $_GET['key'] ?? '';

if($id_usuario != ''){

    $favoritos_servicio -> getListFavorito($id_usuario);

}else{
    http_response_code(401); //Unauthorized
    echo json_encode(['message' => 'No tiene permiso para realizar esta solicitud']);
}

//http://localhost/semestral%202023/api.php?resource=favoritos&service=get&key=18
?>