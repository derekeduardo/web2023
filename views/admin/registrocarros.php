<?php
  require_once(__DIR__. '../../../recursos/connection/Database.php');

  if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
    $db = Database::getInstance();

  $con = $db->getConnection();
   
  if (empty($_POST['nombre']) && empty($_POST['marca']) && empty($_POST['descripcion'])) {

    echo "Debe de llenar los campos";
  }else{
          //variables que contienen los valores introducidos y captados mediante el método POST
          $nombre= $_POST['nombre'];
          $marca= $_POST['marca'];
          $descripcion= $_POST['descripcion'];
          $imagen= addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
       

        $query= "INSERT INTO `carros`(`id_carro`, `nombre`, `marca`, `descripcion`, `imagen`) 
        VALUES ('','$nombre','$marca','$descripcion','$imagen')";

        $res = $con->query($query);

        if ($res) {
            echo "Guardado correctamente <br>";
        }
        else {
            echo "Error: " . $query . "<br>" . $con->error;
        }
  }
      
        $con->close();
  }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/styles-admin.css">
    <title>Registro Autos</title>
</head>
<body>
  <?php include '../components/session.php' ?>
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

        <h1 class="title">Registro de Autos</h1>

        <form action="registrocarros.php" method = "POST" enctype="multipart/form-data">
            <label>Nombre del auto:</label>
            <input type="text" name="nombre"><br><br>
            <label>Marca del auto:</label>
                <select name="marca">
                    <option value="mercedes">Mercedes</option>
                    <option value="jeep">Jeep</option>
                    <option value="lexus">Lexus</option>
                </select><br><br>
            <div>
                <label>Descripción del auto:</label><br>
                <textarea name="descripcion" cols="30" rows="10"></textarea>
            </div><br>
            <label>Imagen del vehiculo:</label>
            <input type="file" name="imagen"><br><br>

            <input type="submit" name="registrar" value="Registrar">
            <button><a href="index.php">Catálogo</a></button>
            

        </form>

    <?php } else { ?>
        <?php echo '<div>
            <h1>No tiene las credenciales suficientes para utilizar este apartado</h1>
            <a href="../../index.php">Volver</a>
        </div>' ?>
    <?php } ?> 
    
</body>
</html>