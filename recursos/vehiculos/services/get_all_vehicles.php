<?php
header("Content-Type: application/json");
require_once(__DIR__. '../../../connection/Database.php');
require_once(__DIR__. '../../Class/VehiculosServicio.php');

$db = Database::getInstance();
$v_servicio = new VehiculosServicio($db);

$v_servicio ->getListOfAllVehicles();

?>