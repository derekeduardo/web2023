<?php 
session_start();
$user = $_SESSION['user'];
if($user == null && $user == ''){
    header("Location: login.html");
}else{
    if(isset($_POST['btnclave'])){
        isset($_POST['old_pass']) ? $old_pass = $_POST['old_pass'] : $old_pass = null;
        isset($_POST['new_pass']) ? $new_pass = $_POST['new_pass'] : $new_pass = null;
        //isset($_POST['new_pass2']) ? $new_pass2 = $_POST['new_pass2'] : $new_pass2 = null;
        if($old_pass && $new_pass !== null){
            $id_user = $_SESSION['id_usuario'];
            // Conectar a la base de datos 
            require_once('../db/configbd.php'); 
            $conexion = conectarDB();
            $mini_consulta = "SELECT * FROM usuarios WHERE id_usuario='$id_user'";
            $mini_resultado = mysqli_query($conexion,$mini_consulta);
            $mini_datos = mysqli_fetch_object($mini_resultado);
            if($mini_datos->contrasena == $old_pass){
                $consulta = "UPDATE usuarios SET contrasena = '$new_pass' WHERE id_usuario = '$id_user'";
                $resultado = mysqli_query($conexion, $consulta);
                if($resultado){
                    mysqli_close($conexion);
                    echo"<script> alert('Modificacion exitosa');document.location.href = '../views/perfil.php';</script>";
                }else{
                    echo "Error". $consulta . "<br>" . mysqli_error($conexion);
                }


            }else{
                echo"<script> alert('Constraseña actual incorrecta');</script>";

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
    <title>Modificar contraseña</title>
</head>
<body>
    <h3>Modificar contraseña</h3>
    <form method="post" action="" autocomplete="off">
        <label for="pass_old">Clave actual: </label>
        <input type="text" name="old_pass" id="pass_old" required value=""><br><br>
        <label for="pass_new">Nueva clave: </label>
        <input type="text" name="new_pass" id="pass_pass" required value=""><br><br>
        <!--<label for="pass_new2">Repetir nueva clave: </label>
        <input type="text" name="new_pass2" id="pass_new2" required value=""><br><br>-->
        <input type="submit" name="btnclave" value="Enviar">

    </form>
    
</body>
</html>