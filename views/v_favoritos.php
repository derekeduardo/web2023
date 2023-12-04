
<?php include './components/session.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
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

    <div> <img class="img" src="../assets/favoritos.png" alt=""></div>


    
    <?php   if(isset($_GET['alert'])){

        switch($_GET['alert']){
            case 'v_exist':
                $title = "Vehículo Existente";
                $message = "El vehículo seleccionado ya forma parte de tus favoritos";
            break;
            case 'v_create':
                $title = "Vehículo Creado";
                $message = "Se ha añadido un nuevo vehículo a su lista de favoritos";
            break;
        }?>
        <div>

            <div class="alertMessage">
                <strong><?php $title ?></strong> <?php $message?>
            </div>

        </div>
    <?php } ?>

    <?php 
    // Hacer la solicitud a la API
    $api_url = 'http://localhost/semestral%202023/api.php?resource=favoritos&service=get&key='.$key;
    $response = file_get_contents($api_url);
    if ($response !== false) {
    $data = json_decode($response, true);

    // Manipular los datos y mostrarlos en el contenedor
    $contenedorDatos = '<div id="datos-api">';
    if (!empty($data)) {
    foreach ($data as $carro) {
        $contenedorDatos .= '
            <div class="favorito">
                <img height="200px" src="data:image/jpg;base64,' . $carro['imagen'] . '">
                <div>
                    <div class="separacion">
                        <p class="modelito"> Modelo </p>
                        <h2>' . $carro['nombre'] . '<r/h2>
                        <h3 class="marca-carro">' . $carro['marca'] . '</h3>
                    </div>
                    <p class="carro-descripcion">' . $carro['descripcion'] . '</p>
                </div>
                <div class="buttons">
                    <form action="../api.php" method="post">
                    <input type="text" name="resource" value="favoritos" style="display:none;">
                    <input type="text" name="service" value="delete" style="display:none;">
                    <button class="favoritoB" type="submit" name="id" value="'. $carro['id_carro'] .'">Quitar Favorito</button>
                    </form>
                    <form action="../api.php" method="post">
                    <input type="text" name="resource" value="testdrive" style="display:none;">
                    <input type="text" name="service" value="insert" style="display:none;">
                    <button class="test-drive" type="submit" name="id" value="'. $carro['id_carro'] .'">Test Drive</button>
                    </form>
                </div>
            </div>';
    }
    } else {
    $contenedorDatos .= '<div class="sesion-mensaje">

    <div class="sesion__mensaje__imagen">
        <img class="alerta" src="../assets/Info.png">
    </div>

    <div class="mensaje-info">
        <h4>Aun no haz añadido un favorito</h4>
        <spam class="mensaje"> Encuentra tus carros favoritos en las marcas que puedes encontrar al fondo de nuestra <strong><a href="../index.php"> página principal</a></strong></spam>
    </div>
</div>';
    }

    $contenedorDatos .= '</div>';
    echo $contenedorDatos;
    } else {
    echo 'Error al obtener datos de la API';
    }
    ?>
    
</body>
<footer></footer>
</html>