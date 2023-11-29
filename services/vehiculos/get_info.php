<?php 
    header("Content-Type: application/json");
    require_once("../../db/configbd.php");

    $con = conectarDB();


    $marca = $_GET["brand"];


    $sql = "SELECT nombre, descripcion, banner  FROM marcas WHERE nombre = '$marca'";

    $query = mysqli_query($con, $sql);

    if($query){
        $info = array();
        if(mysqli_num_rows($query) == 1){
            $row = mysqli_fetch_assoc($query);
            $data = array(
                "marca" => $row["nombre"],
                "descripcion" => $row["descripcion"],
                "banner" => base64_encode($row["banner"])
            );
            $info[] = $data;
            http_response_code(200); //ok
            echo json_encode($info, JSON_PRETTY_PRINT);
        }else{
            //error
        }
    }else{
        // Error durante la consulta
    }
    $con -> close();
?>