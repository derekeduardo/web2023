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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>
    <h3>Perfil</h3>
    <!--<form method="post" action="">-->
        <?php while($datos = mysqli_fetch_object($resultado)){ ?>
            <ul>
                <li><?php echo " ".$datos->id_usuario; ?></li><br>
                <li><?php echo " ".$datos->usuario; ?></li><br>
                <li><?php echo " ".$datos->rol; ?></li><br>
                <li><?php echo " ".$datos->correo; ?></li>
            </ul>
        <?php } mysqli_close($conexion); ?>
        <button type="button" name="boton0"><a href="../services/modificar.php">Modificar datos</a></button><br><br>
        <button type="button" name="boton1"><a href="../services/cambiar_clave.php">Cambiar constraseña</a></button>
        <button type="button" name="boton2"><a href="../index.php">Home</a></button>
    <!--</form>-->

    
</body>
</html>