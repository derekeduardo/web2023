
<?php 
session_start();
$user = $_SESSION['user'];
if($user == null || $user == ''){
    header("Location: login.php");


}

$id_user = $_SESSION['id_usuario'];
// Conectar a la base de datos 
require_once('../db/configbd.php'); 
$conexion = conectarDB();
$consulta = "SELECT * FROM usuarios WHERE id_usuario='$id_user'";
$resultado = mysqli_query($conexion, $consulta);

?>

<?php
// Verificar si se ha proporcionado un ID para eliminar
if (isset($_GET['id_carro'])) {
    // Obtener el ID del carro a eliminar
    $id_carro = $_GET['id_carro'];

    // Incluir el archivo de configuración de la base de datos
    require_once('configbd.php');

    // Establecer la conexión a la base de datos
    $conexion = conectarDB();

    // Preparar la declaración SQL para eliminar el carro
    $sql = "DELETE FROM carros WHERE id_carro = ?";

    // Preparar la sentencia
    $stmt = $conexion->prepare($sql);

    // Vincular el parámetro
    $stmt->bind_param('i', $id_carro);

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        // El carro se eliminó con éxito
        echo "Carro eliminado con éxito.";
    } else {
        // Error al eliminar el carro
        echo "Error al eliminar el carro: " . $stmt->error;
    }

    // Cerrar la sentencia y la conexión
    $stmt->close();
    $conexion->close();
}
?>

