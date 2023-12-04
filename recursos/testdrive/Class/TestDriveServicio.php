<?php 
class TestDriveServicio{

    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getListTestDrive(){
        header("Content-Type: application/json");
        $con = $this->db->getConnection();
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
         }


    public function insertTestDrive($id_carro){
        session_start();
        $id_user = $_SESSION['id_usuario'];

        $con = $this->db->getConnection();


        // Verificación del método de solicitud
        if ($id_user !== null) {
            // Obtener datos del cuerpo de la solicitud
                // Insertar datos en la base de datos
                $sql = "INSERT INTO testdrive (id_carro,id_user) VALUES ('$id_carro', '$id_user')";
                
                if ($con->query($sql) === TRUE) {
                    header("Location:  http://localhost/semestral%202023/index.php?alert=1");
                } else {
                    echo 'Ha ocurrido un error interno de servidor' . $con->error_log;
                }
        
        } else {
            echo 'No se ha podido encontrar la id del usuario';
        }
        // Cerrar la conexión
        $con->close();
    }
}

?>