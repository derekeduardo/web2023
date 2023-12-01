<?php
$db = "semestral_2023"; // nombre de la base de datos
$host = "localhost"; // nombre del servidor
$pw = ""; // contraseña
$user = "root"; // usuario

function conectarDB(){
    global $db, $host, $pw, $user;  // Agregamos 'global' para acceder a las variables fuera del ámbito de la función
    $conexion = mysqli_connect($host, $user, $pw, $db);
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    return $conexion;
}
?>
