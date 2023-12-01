<?php
header("Content-Type: application/json");

// require_once('./db/configbd.php');
require_once('../../db/configbd.php');

$con = conectarDB();

$sql = "SELECT testdrive.id_test, testdrive.id_carro, testdrive.id_user,testdrive.fecha,
        carros.nombre AS nombre_carro, 
        usuarios.usuario AS usuario,
        usuarios.correo AS correo
        FROM testdrive
        INNER JOIN carros ON testdrive.id_carro = carros.id_carro
        INNER JOIN usuarios ON testdrive.id_user = usuarios.id_usuario";
$query = mysqli_query($con, $sql);

if ($query) {
    $resultado = mysqli_num_rows($query);

    if ($resultado > 0) {
        $testdrives = array();

        while ($data = mysqli_fetch_array($query)) {
            $testdrive = array(
                "id_test" => $data["id_test"],
                "id_carro" => $data["id_carro"],
                "id_user" => $data["id_user"],
                "correo" => $data["correo"],
                "fecha" => $data["fecha"],
                "nombre" => $data["nombre_carro"],
                "usuario" => $data["usuario"]
            );

            $testdrives[] = $testdrive;
        }

        echo json_encode($testdrives, JSON_PRETTY_PRINT);
    } else {
        echo json_encode(["mensaje" => "No hay registros"]);
    }
} else {
    echo json_encode(["error" => "Error: " . mysqli_error($con)]);
}

$con->close();
?>
