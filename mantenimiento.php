<?php
    if(isset($_POST['modelo']) && !empty($_POST['modelo']) && isset($_POST['marca']) &&
     !empty($_POST['marca']) && isset($_POST['descripcion']) && !empty($_POST['descripcion'])) {

        //variables que contienen los valores introducidos y captados mediante el método POST
        $modelo = $_POST['modelo'];
        $marca = $_POST['marca'];
        $descripcion = $_POST['descripcion'];
       

        //declaración de las variables para la conexión con la BD
        require_once('configbd.php');

        $con = conectarDB();

        $sql= "INSERT INTO `usuarios`(`id_usuario`, `correo`, `usuario`, `contrasena`, `rol`) 
        VALUES ('','$correoReg','$userReg','$contrasenaReg','')";

        if ($con->query($sql) === TRUE) {
            echo "Guardado correctamente <br>";
            echo "<a href='login.html'>Ir al Login</a>";
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