<?php
session_start();

// Verificar si el usuario está autenticado (esto depende de tu lógica de autenticación)
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401); // No autorizado
    echo json_encode(['message' => 'Usuario no esta autorizado']);
    exit();
}

// if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    
// }
$user_id = $_SESSION['usuario_id'];
$vehiculo_id = $_GET['id'];

// // Obtener datos del cuerpo de la solicitud
// $data = json_decode(file_get_contents("php://input"));

// Obtener el ID del usuario de la sesión


// Configuración de la conexión a la base de datos
require_once('configbd.php');

// Crear conexión
$con = conectarDB();

// Consulta SQL para insertar el registro en la tabla de favoritos (suponiendo que tienes una tabla llamada 'favoritos')
$sql = "INSERT INTO favoritos (id_carro, id_user) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ii", $vehiculo_id, $user_id); // "ii" significa que son dos parámetros de tipo entero
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        http_response_code(200); // Éxito
        echo json_encode(['message' => 'Carro marcado como favorito con éxito']);
    } else {
        http_response_code(500); // Error interno del servidor
        echo json_encode(['message' => 'Error al marcar el carro como favorito']);
    }

    $stmt->close();
} else {
    http_response_code(500); // Error interno del servidor
    echo json_encode(['message' => 'Error en la preparación de la consulta']);
}

// Cerrar la conexión
$conn->close();
?>