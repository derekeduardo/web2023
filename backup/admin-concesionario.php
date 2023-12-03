<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
    $api_url = 'http://localhost/semestral%202023/recursos/vehiculos/services/get_all_vehicles.php';
    $response = file_get_contents($api_url);
    ?>

    <?php if ($response !== false) { $data = json_decode($response, true); ?>

        <?php if(!empty($data)) { ?>

            <?php $listaDeCarros = '<div class="contenedor__principal">'; foreach($data as $carro) { ?>

                <?php $listaDeCarros .= '
                    <div class="">
                        <div class="">
                            <h2 class="">' . $carro['nombre'] . '</h2>
                            <h3 class="">' . $carro['marca'] . '</h3>
                            <p class="">' . $carro['descripcion'] . '</p>
                            
                        </div>
                       
                    ';   
                    if(isset($_SESSION['id_usuario'])){
                        $listaDeCarros .= '
                            <div class="contenedor__formularios">
                                <form action="../api.php" method="post">
                                    <input type="text" name="resource" value="favoritos" style="display:none;">
                                    <input type="text" name="service" value="add" style="display:none;">
                                    <button type="submit" name="id" value="'. $carro['id_carro'] .'">Favorito</button>
                                </form>
                                <form action="../recursos/api_testdrive.php" method="post">
                                    <input type="text" name="key" value="'.$key.'" style="display: none;">
                                    <button type="submit" name="id" value="'. $carro['id_carro'] .'">Test Drive</button>
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