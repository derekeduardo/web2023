<?php 
session_start();
$user = $_SESSION['user'];
if($user == null && $user == ''){
    header("Location: login.html");
     

}else{
    if(isset($_POST['btnmodificar'])){
        $id_user = $_SESSION['id_usuario'];
        isset($_POST['user_name']) ? $_user = $_POST['user_name'] : $_user = null;
        isset($_POST['email']) ? $user_email = $_POST['email'] : $user_email = null;
        isset($_POST['user_rol']) ? $user_rol = $_POST['user_rol'] : $user_rol = null;
        if($_user && $user_email && $user_rol !== null){
            // Conectar a la base de datos 
            require_once('../db/configbd.php'); 
            $conexion = conectarDB();
            $consulta = "UPDATE usuarios SET correo = '$user_email', usuario = '$_user', rol = '$user_rol' WHERE id_usuario = '$id_user'";
            $resultado = mysqli_query($conexion, $consulta);
            if($resultado){
                mysqli_close($conexion);
                echo"<script> alert('Modificacion exitosa');document.location.href = '../views/perfil.php';</script>";
            }else{
                echo "Error". $consulta . "<br>" . mysqli_error($conexion);
            }
        }else{
            echo"<script> alert('Introducir campos');</script>";
        }
    
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar datos</title>
</head>
<body>
    <h3>Modificar datos</h3>
    <form method="post" action="">
        <label for="name_user">Nombre de usuario: </label>
        <input type="text" name="user_name" id="name_user" required value=""><br><br>
        <label for="email">Correo: </label>
        <input type="text" name="email" id="email" required value=""><br><br>
        <label for="rol">Rol de usuario: </label>
        <input type="text" name="user_rol" id="rol" required value=""><br><br>
        <input type="submit" name="btnmodificar" value="Enviar">

    </form>
    
</body>
</html>