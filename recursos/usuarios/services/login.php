<?php
require_once(__DIR__. '../../../connection/Database.php');
require_once(__DIR__. '../../Class/UsuarioServicio.php');

$db = Database::getInstance();
$usuario_servicio = new UsuarioServicio($db);

$username = $_POST['user'] ?? '';
$password = $_POST['password'] ?? '';

if($username != '' || $password != ''){
    $usuario_servicio -> login($username, $password);
}else{
    header("Location: http://localhost/semestral%202023/views/login.php?alert=3");
    exit();
}
?>