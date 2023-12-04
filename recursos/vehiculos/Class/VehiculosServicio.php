<?php 
class VehiculosServicio{

    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getListOfVehicles($brand){
        header("Content-Type: application/json");
        $con = $this->db->getConnection();

        $sql = 'SELECT id_carro, nombre, marca, descripcion, imagen FROM carros WHERE marca = ?';

        $stmt = $con -> prepare($sql);
        $stmt -> bind_param('s', $brand);
        $stmt -> execute();

        $result = $stmt -> get_result();

        $response = [];
        if(!$result){
            http_response_code(500);
            $response['message'] = 'Ha ocurrido un error interno de servidor';
        }

        while($row = $result->fetch_assoc()){

            if(!empty($row['imagen'])){
                $imagen_base64 = base64_encode($row['imagen']);
                $row['imagen'] = $imagen_base64;
            }

            $response[] = $row;

        }

        $stmt -> close();
        $con -> close();

        http_response_code(200);
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function getInfoOfBrands($brand){
        header("Content-Type: application/json");
        $con = $this->db->getConnection();

        $sql = 'SELECT nombre, descripcion, banner FROM marcas WHERE nombre = ?';

        $stmt = $con -> prepare($sql);
        $stmt -> bind_param('s', $brand);
        $stmt -> execute();
        $stmt -> bind_result($brand, $description, $banner);

        if ($stmt -> fetch()){
            $brand_info = array(
                'marca' => $brand,
                'descripcion' => $description,
                'banner' => base64_encode($banner)
            );
            $response[] = $brand_info;
        }else{
            http_response_code(500);
            $response['message'] = 'Ha ocurrido un error interno de servidor';
        }

        $stmt -> close();
        $con -> close();

        http_response_code(200);
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function getListOfAllVehicles(){
        header("Content-Type: application/json");
        $con = $this->db->getConnection();

        $sql = 'SELECT id_carro, nombre, marca, descripcion FROM carros';

        $stmt = $con -> prepare($sql);
        $stmt -> execute();

        $result = $stmt -> get_result();

        $response = [];
        if(!$result){
            http_response_code(500);
            $response['message'] = 'Ha ocurrido un error interno de servidor';
        }

        while($row = $result->fetch_assoc()){

            $response[] = $row;

        }

        $stmt -> close();
        $con -> close();

        http_response_code(200);
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function deleteVehicle($id_carro){
        
        $con = $this->db->getConnection();
        session_start();

        $sql = 'DELETE FROM carros WHERE id_carro = ?';

        $stmt = $con -> prepare($sql);
        $stmt -> bind_param('i', $id_carro);
        $stmt -> execute();

        $result = $stmt -> affected_rows;

        $response = [];
        if(!$result){
            http_response_code(500);
            $response['message'] = 'Ha ocurrido un error interno de servidor';
        }else{
            $response['message'] = 'El vehículo se ha eliminado con éxito';
        }

        $stmt -> close();
        $con -> close();
    }




}

?>