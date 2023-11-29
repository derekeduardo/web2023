<?php
header("Content-Type: application/json");

require_once('../../db/configbd.php');

$con = conectarDB();

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $marca = $_GET["name"];
}

$sql = "SELECT id_carro, nombre, marca, descripcion, imagen FROM carros WHERE marca = '$marca'";
$query = mysqli_query($con, $sql);

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
    echo json_encode(["error" => "Error: " . mysqli_error($con)]);
}

$con->close();
?>
