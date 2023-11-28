<?php

// Conectar a la base de datos
require_once('../db/configbd.php');

$conexion = conectarDB();

$user = $_POST["user"];
$password = $_POST["password"];

//añadir una query antes de la consulta para que el user no pueda ser el mismo (controlar que no se repita el user)
$consulta = "SELECT * FROM usuarios WHERE usuario='$user' AND contrasena='$password'";
$resultado = mysqli_query($conexion, $consulta);


if (mysqli_num_rows($resultado) == 1) {
    // Iniciar sesión
    session_start();
    $fila = mysqli_fetch_assoc($resultado);
    $_SESSION["user"] = $fila['usuario'];
    $_SESSION["id_usuario"] = $fila['id_usuario'];

    // Redirigir al usuario a la página principal
    header("Location: ../index.php");
} else {
    // Mostrar un mensaje de error
    echo "<p>Error de autenticación</p>";
    echo "imprime el: $user y la $password";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);

?>