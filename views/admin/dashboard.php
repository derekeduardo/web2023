<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/styles-admin.css">
    <title>Document</title>
</head>
<body>
    

    <?php session_start(); ?> 

    <?php if($_SESSION['rol'] === 'admin'){ ?>


    <nav class="navbar">
        <div class="logo"> 
            <a href="dashboard.php"> <h1>F&F</h1> </a>
        </div>
    
        <div class="navlink">
            <a href="registrocarros.php">Añadir vehículos</a>
            <a href="testdrive.php">Solicitudes de Test Drive</a>
        </div>

        <div class="autorizacion">
            <a href="../../api.php?resource=usuarios&service=logout">Logout</a>
        </div>
    </nav>

    <h1 class="admin">Bienvenido <?php echo $_SESSION['user'] ?> 👨‍💻</h1>

    <div class="dashboard">
        <h2 class="title">Vehículos Añadidos</h2>

        <!-- Solicitando la información a la API-->
        <?php $api_url = 'http://localhost/semestral%202023/recursos/vehiculos/services/get_all_vehicles.php'; 
            $response = file_get_contents($api_url);
        ?>

        <?php if ($response !== false) { $data = json_decode($response, true); ?>


            <?php if(!empty($data)) { ?>

                <?php $tabla = '<table class="default"><tr><th>Modelo</th><th>Marca</th><th>Descripción</th><th>Acciones</th></tr>' ?>
                <?php foreach($data as $elemento) { ?>
                    <?php $tabla .= '<tr>
                        <div class="fila">
                            <td>'.$elemento['nombre'].'</td>
                        </div>
                        <td>'.$elemento['marca'].'</td>
                        <td>'.$elemento['descripcion'].'</td>
                        <td>
                            <form action="./../../recursos/vehiculos/services/delete_vehicle.php" method="post">
                                <button class="boton2" type="submit" name="id" value="'.$elemento['id_carro'].'">Eliminar</button>
                            </form>
                        </td>
                    </tr>' ?>
                <?php } $tabla .= '</table>'; echo $tabla; ?>
            <?php }else{ ?>
                
                <?php echo '<div>
                    <h3>No se han encontrado elementos</h3>
                    <p>Le recomendamos <strong><a href="./registrocarros.php">Añadir Vehículos</a></strong></p>
                </div>'; ?>

            <?php } ?>

        <?php } else { 
                echo '
                <div class="">
                    <h2>La API no ha envidado datos</h2>
                </div>
            '
            ?>
        <?php } ?>

            

        <?php } else { ?>
            <?php echo '<div>
                <h1>No tiene las credenciales suficientes para utilizar este apartado</h1>
                <a href="../../index.php">Volver</a>
            </div>' ?>
        <?php } ?> 
    </div>

    

</body>
</html>