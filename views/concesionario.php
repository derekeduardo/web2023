<?php include './components/session.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title><?php echo $title_info ?></title>
</head>
<body>    
    <nav>
        <div>
            <ul>
                <li><h1>Logo</h1></li>
                <li><div>
                    <a href="./views/perfil.php">Perfil</a>
                    <a href="./services/logout.php">Logout</a>
                </div></li>

                <li><div>
                    <a href="./views/login.php">Iniciar Sesión</a>
                    <a href="./views/registro.php">Registrarse</a>
                </div></li>
            </ul>
        </div>
    </nav>

    <!-- Contenedor con la información de la marca seleccionada -->

    <?php 
        $URL = 'http://localhost/semestral%202023/recursos/vehiculos/get_info.php?brand='.$marca.'';

        $response_container = file_get_contents($URL);
        
        if($response_container !== false){
            $info = json_decode($response_container, true);
            $container = "<div>";
            if (!empty($info)) {
                foreach($info as $brand){
                    $container .= '
                        <div style="background-color: red;">
                            <img height="200px" src="data:image/jpg;base64,' . $brand['banner'] . '">
                            <div>
                                <h3>'. $brand['marca'] .'</h3>
                                <h3>'. $brand['descripcion'] .'</h3>
                            </div>
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
    $api_url = 'http://localhost/semestral%202023/recursos/vehiculos/api_marca.php?name='.$marca.'';
    $response = file_get_contents($api_url);

    if(!isset($_SESSION['id_usuario'])){
        echo '
            <div class="sesion__mensaje">

                <div class="sesion__mensaje__imagen">
                    Coloca en este div, ya sea una imagen o icono. O puedes quitarlo
                </div>

                <div class="sesion__mensaje__info">
                    <spam>Al no <strong><a href="./login.php">iniciar sesión</a></strong> solo podrá visualizar los vehículos.</spam>
                </div>
            </div>
        ';
    }

    ?>

    <?php if ($response !== false) { $data = json_decode($response, true); ?>

        <?php if(!empty($data)) { ?>

            <?php $listaDeCarros = '<div class="contenedor__principal">'; foreach($data as $carro) { ?>

                <?php $listaDeCarros .= '
                    <div class="contenedor__carro">
                        <div class="contenedor__info">
                            <h2 class="carro__nombre">' . $carro['nombre'] . '</h2>
                            <h3 class="carro__marca">' . $carro['marca'] . '</h3>
                            <p class="carro_descripcion">' . $carro['descripcion'] . '</p>
                        </div>
                        <div class="contenedor__imagen">
                            <img height="200px" src="data:image/jpg;base64,' . $carro['imagen'] . '">
                        </div>
                    ';   
                    if(isset($_SESSION['id_usuario'])){
                        $listaDeCarros .= '
                            <div class="contenedor__formularios">
                                <form action="../api.php" method="post">
                                    <input type="text" name="resource" value="favoritos" style="display:none;">
                                    <input type="text" name="service" value="add" style="display:none;">
                                    <button type="submit" name="id" value="'. $carro['id'] .'">Favorito</button>
                                </form>
                                <form action="../recursos/api_testdrive.php" method="post">
                                    <input type="text" name="key" value="'.$key.'" style="display: none;">
                                    <button type="submit" name="id" value="'. $carro['id'] .'">Test Drive</button>
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
