<?php
    if(isset($_POST['user']) && !empty($_POST['user']) && isset($_POST['contrasena']) &&
     !empty($_POST['contrasena']) && isset($_POST['correo']) &&
     !empty($_POST['correo'])) {

        //variables que contienen los valores introducidos y captados mediante el método POST
        $userReg= $_POST['user'];
        $contrasenaReg= $_POST['contrasena'];
        $correoReg= $_POST['correo'];
       

        //declaración de las variables para la conexión con la BD
        require_once('../db/configbd.php');

        $con = conectarDB();

        $sql= "INSERT INTO `usuarios`(`id_usuario`, `correo`, `usuario`, `contrasena`, `rol`) 
        VALUES ('','$correoReg','$userReg','$contrasenaReg','')";

        if ($con->query($sql) === TRUE) {
            echo "Guardado correctamente <br>";
            echo "<a href='../views/login.php'>Ir al Login</a>";
        }
        else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
        
        $con->close();


     }
     else
     {
        echo "Debe de llenar los campos";
     }
?>