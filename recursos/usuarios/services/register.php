<?php
    require_once(__DIR__ . '../../../connection/Database.php');
    require_once(__DIR__ . '../../Class/UsuarioServicio.php');
    //LLamar a la instancia de la base de datos
    $db = Database::getInstance();
    $usuario_servicio = new UsuarioServicio($db);

    //Solicitamos los datos necesarios
    $username = $_POST['user'] ?? '';
    $password = $_POST['contrasena'] ?? '';
    $email = $_POST['correo'] ?? '';

    if($username != '' && $password != '' && $email != ''){

        if(strlen($username) < 8){
            header("Location: http://localhost/semestral%202023/views/registro.php?alert=2");
            exit();
        }elseif(strlen($password) < 8){
            header("Location: http://localhost/semestral%202023/views/registro.php?alert=3");
            exit();
        }else{
            $usuario_servicio->register($email, $username, $password);
        }

    }else{
        header("Location: http://localhost/semestral%202023/views/registro.php?alert=4");
        exit();
    }
?>