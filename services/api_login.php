<?php

// Conectar a la base de datos
require_once('../db/configbd.php');

$conexion = conectarDB();

$user = $_POST["user"];
$password = $_POST["password"];

$consulta = "SELECT * FROM usuarios WHERE usuario='$user' AND contrasena='$password'";
$resultado = mysqli_query($conexion, $consulta);


if (mysqli_num_rows($resultado) == 1) {
    // Iniciar sesión
    session_start();
    $_SESSION["user"] = $user;

    // Redirigir al usuario a la página principal
    header("Location: ../index.php");
} else {
    // Mostrar un mensaje de error
    echo "<p>Error de autenticación</p>";
    echo "imprime el: .$user. y la .$password";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);

?>