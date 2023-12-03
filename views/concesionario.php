<?php include '../views/components/session.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title><?php echo $title_info ?></title>
</head>
<body>    
    <!-- navbar -->
    <?php if(isset($_SESSION['id_usuario'])) { ?>
        <nav class="navbar">
            <div class="logo"> 
                <a href="../index.php"> <h1>F&F</h1> </a>
            </div>
        
            <div class="navlink">
                <a href="about.html">About</a>
                <a href="servicios.html">Services</a>
                <a href="./v_favoritos.php">Favoritos</a>
            </div>

            <div class="autorizacion">
                <a href="./views/perfil.php">Perfil</a>
                <a href="./../recursos/usuarios/services/logout.php">Logout</a> 
            </div>
        </nav>
    <?php } else { ?>
        <nav class="navbar">
            <div class="logo"> 
                <a href="../index.php"><h1>F&F</h1></a>
            </div>
        
            <div class="navlink">
                <a href="about.html">About</a>
                <a href="servicios.html">Services</a>
            </div>

            <div class="autorizacion">
                <a href="login.php">Iniciar sesión</a>
                <a href="registro.php">Registrarse</a>
            </div>
        </nav>
    <?php } ?>

    <!-- Contenedor con la información de la marca seleccionada -->

    <?php 
        $URL = 'http://localhost/semestral%202023/api.php?resource=vehiculos&service=get_info&brand='.$marca.'';

        $response_container = file_get_contents($URL);
        
        if($response_container !== false){
            $info = json_decode($response_container, true);
            $container = "<div>";
            if (!empty($info)) {
                foreach($info as $brand){
                    $container .= '
                        <div>
                            <img class="img" src="data:image/jpg;base64,' . $brand['banner'] . '">
                            <div class= "encabezado">
                                <h3 class="titulo">'. $brand['marca'] .'</h3>
                                <h3 class="parrafo">'. $brand['descripcion'] .'</h3>
                            </div>
                            <hr class="hr">
                        </div>
                    ';
                }
            }
            $container .= '</div>';
            echo $container;
        } else {
            echo 'Error al obtener los datos de la api';
        }
    
    ?>


    <!--Listas de Vehiculos -->

    <?php
    $api_url = 'http://localhost/semestral%202023/api.php?resource=vehiculos&service=get_vehicles&brand='.$marca.'';
    $response = file_get_contents($api_url);

    if(!isset($_SESSION['id_usuario'])){
        echo '
            <div class="sesion-mensaje">

                <div class="sesion__mensaje__imagen">
                    <img class="alerta" src="../assets/Info.png">
                </div>

                <div class="mensaje-info">
                    <h4>Para poder acceder a los servicios de la página debe iniciar sesión</h4>
                    <spam class="mensaje">Desbloquea todas las funcionalidades al <strong><a href="./login.php">iniciar sesión</a></strong></spam>
                </div>
            </div>
        ';
    }

    ?>

    <?php if ($response !== false) { $data = json_decode($response, true); ?>

        <?php if(!empty($data)) { ?>

            <?php $listaDeCarros = '<div class="muestra">'; foreach($data as $carro) { ?>

                <?php $listaDeCarros .= '
                    <div class="carros">
                        <div class="contenedor__imagen">
                            <img height="200px" src="data:image/jpg;base64,' . $carro['imagen'] . '">
                        </div>
                        <div class="separacion">
                            <p class="modelito"> Modelo </p>
                            <h2 class="carro__nombre">' . $carro['nombre'] . '</h2>
                            <h3 class="marca-carro">' . $carro['marca'] . '</h3>
                        </div>
                        <p class="carro-descripcion">' . $carro['descripcion'] . '</p>
                    ';   
                    if(isset($_SESSION['id_usuario'])){
                        $listaDeCarros .= '
                            <div class="buttons">
                                <form action="../recursos/api_testdrive.php" method="post">
                                    <input type="text" name="key" value="'.$key.'" style="display: none;">
                                    <button class="test" type="submit" name="id" value="'. $carro['id_carro'] .'">Test Drive</button>
                                </form>
                                <form action="../api.php" method="post">
                                    <input type="text" name="resource" value="favoritos" style="display:none;">
                                    <input type="text" name="service" value="add" style="display:none;">
                                    <button class="fav" type="submit" name="id" value="'. $carro['id_carro'] .'">Favorito</button>
                                </form>
                            </div>
                        ';
                    }
                    $listaDeCarros .= '
                        </div>
                    ';
                ?>

           <?php } 
                $listaDeCarros .= '</div>' ;
                    echo $listaDeCarros;
                ?>
      <?php  } else { 
                echo '
                    <div class="contenedor__empty">
                        <h2>No se han encontrado datos</h2>
                    </div>
                '
            ?>
        <?php } ?>
    <?php } else { 
                echo '
                <div class="contenedor__error__api">
                    <h2>La API no ha envidado datos</h2>
                </div>
            '
            ?>
       <?php } ?>
</body>
</html>
