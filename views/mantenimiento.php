<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento</title>
    <link href="login.css" rel="stylesheet" />

</head>
<body>
      
<h1>Mantenimiento</h1>
    <form name="registro" action="registro.php" method="post">
        <label for="modelo">Modelo de su auto: </label>
        <input type="text" name="modelo" id="modelo">
        <br>
        <label>Marca del auto:</label>
                <select name="marca">
                    <option value="mercedes">Mercedes</option>
                    <option value="jeep">Jeep</option>
                    <option value="lexus">Lexus</option>
                </select><br><br>
        <label for="descripcion">Servicio de mantenimiento: </label>
        <input type="text" name="descripcion" id="descripcion">
        <br>
        
        <button type="submit">Enviar</button>
      </form>
<div>
    
</div>
</body>
</html>