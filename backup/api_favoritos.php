<?php
session_start();

// Verificar si el usuario está autenticado (esto depende de tu lógica de autenticación)
if (!isset($_SESSION['id_usuario'])) {
    http_response_code(401); // No autorizado
    echo json_encode(['message' => 'Usuario no esta autorizado']);
    exit();
}

if (!isset($_GET['action'])){
    http_response_code(400); // No autorizado
    echo json_encode(['message' => 'Usuario no esta autorizado']);
    exit();
}

require_once('../db/configbd.php');
$conn = conectarDB();
$user_id = $_SESSION['id_usuario'];
$action = $_GET['action'];


switch ($action){
    case 1:
        $vehiculo_id = $_GET['id'];
        $sql = "INSERT INTO favoritos (id_carro, id_user) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ii", $vehiculo_id, $user_id); // "ii" significa que son dos parámetros de tipo entero
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                http_response_code(200); // Éxito
                echo json_encode(['message' => 'Carro marcado como favorito con éxito',
            'id' => $vehiculo_id]);
            } else {
                http_response_code(500); // Error interno del servidor
                echo json_encode(['message' => 'Error al marcar el carro como favorito']);
            }
            $stmt->close();
        } else {
            http_response_code(500); // Error interno del servidor
            echo json_encode(['message' => 'Error en la preparación de la consulta']);
        }
    break;

    case 2: 
        $sql = "SELECT carros.id_carro,carros.nombre,carros.marca,carros.descripcion,carros.imagen from carros inner join favoritos on carros.id_carro = favoritos.id_carro where favoritos.id_user = $user_id";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            $resultado = mysqli_num_rows($query);

            if ($resultado > 0) {
                $carros = array();

                while ($data = mysqli_fetch_array($query)) {
                    $carro = array(
                        "id" => $data["id_carro"],
                        "nombre" => $data["nombre"],
                        "marca" => $data["marca"],
                        "descripcion" => $data["descripcion"],
                        "imagen" => base64_encode($data['imagen'])
                    );

                    $carros[] = $carro;
                }

                echo json_encode($carros, JSON_PRETTY_PRINT);
            } else {
                echo json_encode(["mensaje" => "No hay registros"]);
            }
        } else {
            echo json_encode(["error" => "Error: " . mysqli_error($conn)]);
        }
    break;

    default:
        http_response_code(400);
        echo json_encode(['message' => 'Action no valido']);
    break;
}

/** Close connection */
$conn->close();
?>