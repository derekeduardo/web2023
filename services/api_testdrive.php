<?php
session_start();
header("Content-Type: application/json");

// if(isset($_SESSION['usuario_id'])){
//     http_response_code(401);
//     echo json_encode(['message' => 'Usuario no autorizado']);
//     exit();
// }

require_once('../db/configbd.php');
$conn = conectarDB();
$user_id = $_SESSION['id_usuario'];
$id_carro = $_POST['id'];


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificación del método de solicitud
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del cuerpo de la solicitud
        // Insertar datos en la base de datos
        $sql = "INSERT INTO testdrive (id_carro,id_user) VALUES ('$id_carro', '$user_id')";
        
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["mensaje" => "Testdrive agregado con éxito"]);
        } else {
            echo json_encode(["error" => "Error al agregar testdrive: " . $conn->error]);
        }
   
} else {
    echo json_encode(["error" => "Método no permitido"]);
}

// Cerrar la conexión
$conn->close();
?>


