<?php
  require_once('configbd.php');

  $con = conectarDB();
   
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
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Autos</title>
</head>
<body>
    <center>
        <h1>Registro de Autos</h1>

        <form action="registrocarros.php" method = "POST" enctype="multipart/form-data">
            <label>Nombre del auto:</label>
            <input type="text" name="nombre"><br><br>
            <label>Marca del auto:</label>
                <select name="marca">
                    <option value="mercedes">Mercedes</option>
                    <option value="jeep">Jeep</option>
                    <option value="lexus">Lexus</option>
                </select><br><br>
            <label>Descripción del auto:</label>
            <input type="text" name="descripcion"><br><br>
            <label>Imagen del vehiculo:</label>
            <input type="file" name="imagen"><br><br>

            <center>
                <input type="submit" name="registrar" value="Registrar">
                <button><a href="index.php">Catálogo</a></button>
            </center>

        </form>
    </center>
</body>
</html>