<?php
class FavoritosServicio{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function addFavorito($id_carro)
    {
        //header("Content-Type: application/json");
        $con = $this->db->getConnection();
        session_start();
        if(!isset($_SESSION['id_usuario'])){
            echo "No se han entrado una sesión de usuario";
        }

        $id_usuario = $_SESSION['id_usuario'];

        if($this -> existsFavorite($id_usuario, $id_carro)){
            header("Location: http://localhost/semestral%202023/views/v_favoritos.php?alert=v_exist");
            $con -> close();
            exit();
        }

        $dato1 = $con -> real_escape_string($id_usuario);
        $dato2 = $con -> real_escape_string($id_carro);

        $sql = "INSERT INTO favoritos (id_carro, id_user) VALUES ('$dato2', '$dato1')";

        $resultado = $con -> query($sql);

        if ($resultado)
        {
            $this->createCookie($dato1, $dato2);
        }else{
            echo 'Ha ocurrido un error al momento de guardar la información';
            $con -> close();
        }    
    }

    public function createCookie($id_usuario, $id_carro){
        $con = $this->db->getConnection();

        $sql = 'SELECT carros.nombre,carros.marca,carros.descripcion from carros inner join favoritos on carros.id_carro = favoritos.id_carro where favoritos.id_user = ? AND favoritos.id_carro = ?;';

        $stmt = $con -> prepare($sql);
        $stmt -> bind_param('ii', $id_usuario, $id_carro);
        $stmt -> execute();

        $resultado = $stmt -> get_result();

        if ($row = $resultado->fetch_assoc()) {
            
            if (!empty($row['imagen'])) {
                $imagen_base64 = base64_encode($row['imagen']);
                $row['imagen'] = $imagen_base64;
            }
        }

        $stmt->close();
        $con->close();

        setcookie("id_usuario", $id_usuario, time() + 1800, "/");
        setcookie("nombre", $row['nombre'], time() + 1800, "/");
        setcookie("marca", $row['marca'], time() + 1800, "/");
        setcookie("descripcion", $row['descripcion'], time() + 1800, "/"); 
        header("Location: http://localhost/semestral%202023/views/v_favoritos.php?alert=v_create");
    }

    public function deleteFavorito($id_carro)
    {
        $con = $this->db->getConnection();
        session_start();

        $id_usuario = $_SESSION['id_usuario'];

        if(!$this -> existsFavorite($id_usuario, $id_carro)){
            header("Location: http://localhost/semestral%202023/views/v_favoritos.php?alert=reg_not_exist");
            $con -> close();
            exit();
        }

        $sql = 'DELETE FROM favoritos WHERE id_user = ? AND id_carro = ?';

        $stmt = $con -> prepare($sql);
        $stmt -> bind_param("ii", $id_usuario, $id_carro);

        $resultado = $stmt -> execute();

        if($resultado)
        {
            setcookie("id_usuario", '', time() - 3600, "/");
            setcookie("nombre", '', time() - 3600, "/");
            setcookie("marca", '', time() - 3600, "/");
            setcookie("descripcion", '', time() - 3600, "/");
            header("Location: http://localhost/semestral%202023/views/v_favoritos.php?alert=reg_not_exist");
        }else{
            echo 'Ha ocurrido un error durante el proceso de eliminación' . $stmt -> error;
        }
        $stmt->close();
        $con -> close();
    }

    public function getListFavorito($id_usuario){
        header("Content-Type: application/json");
        $con = $this->db->getConnection();

        $sql = 'SELECT carros.id_carro,carros.nombre,carros.marca,carros.descripcion,carros.imagen from carros inner join favoritos on carros.id_carro = favoritos.id_carro where favoritos.id_user = ?';

        $stmt = $con -> prepare($sql);
        $stmt -> bind_param('i', $id_usuario);
        $stmt -> execute();

        $resultado = $stmt -> get_result();

        if($resultado == false){
            http_response_code(500);
            echo json_encode(['message' => 'Ha ocurrido un error durante el proceso de consulta']);
            $stmt -> close();
            $con -> close();
            exit();
        }

        $listaDeFavoritos = array();

        while($row = $resultado -> fetch_assoc()){

            if (!empty($row['imagen'])) {
                $imagen_base64 = base64_encode($row['imagen']);
                $row['imagen'] = $imagen_base64;
            }

            $listaDeFavoritos[] = $row;
        }

        $stmt -> close();
        $con -> close();

        http_response_code(200);
        echo json_encode($listaDeFavoritos, JSON_PRETTY_PRINT);
    }

    public function existsFavorite($id_usuario, $id_carro){
        $con = $this->db->getConnection();

        $sql = 'SELECT COUNT(*) FROM favoritos WHERE id_user = ? AND id_carro = ?';
        $stmt = $con -> prepare($sql);
        $stmt->bind_param('ii', $id_usuario, $id_carro);

        $stmt -> execute();
    
        $stmt -> bind_result($count);

        $stmt -> fetch();

        $stmt -> close();

        return $count > 0;
    }
}

?>