<?php
session_start();
//header("Content-Type: application/json");

require_once('../db/configbd.php');


$conn = conectarDB();

$user_id = $_POST['key'];
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
            header("Location:  http://localhost/semestral%202023/index.php?alert=1");
        } else {
            // http_response_code(500);
            // echo json_encode(["error" => "Error al agregar testdrive: " . $conn->error]);
            header("Location: http://localhost/semestral%202023/index.php?alert=2");
        }
   
} else {
    // http_response_code(400);
    // echo json_encode(["error" => "Método no permitido"]);
    header("Location:  http://localhost/semestral%202023/index.php?alert=2");
}

// Cerrar la conexión
$conn->close();
?>


