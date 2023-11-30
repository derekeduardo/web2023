<?php
class UsuarioServicio{
    private $db;
    private $key = 'semestral';
    private $m_cifrado = 'AES-128-CTR';
    private $i_vector = '123456789012345';
    private $option = 0;


    public function __construct(Database $db)
    {
        $this -> db = $db;
    }

    public function login($username, $password)
    {
        $con  = $this->db->getConnection();

        $userData = $this->getCredentials($username);
        if(!empty($userData) && $this->verificarPassword($password, $userData['pass'], $userData['vector_i'])){
            session_start();
            $_SESSION['user'] = $userData['username'];
            $_SESSION['id_usuario'] = $userData['id'];
            $_SESSION['rol'] = $userData['rol'];
            header("Location: http://localhost/semestral%202023/index.php");
            $con -> close();
        }else{
            header("Location: http://localhost/semestral%202023/views/login.php?alert=1");
            $con -> close();
        }
        exit();
    }

    public function getCredentials($username){

        $con = $this->db->getConnection();

        $sql = 'SELECT id_usuario, usuario, rol, contrasena, vector_i FROM usuarios WHERE usuario = ?';

        $stmt = $con->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($id_usuario, $user, $rol, $contrasena, $vector_i);
        
        if($stmt->fetch()){
            $user_data = array(
                'id' => $id_usuario,
                'username' => $user,
                'rol' => $rol,
                'pass' => $contrasena,
                'vector_i' => $vector_i
            );
            $stmt -> close();
            return $user_data;
        }else{
            header("Location: http://localhost/semestral%202023/index.php");
            $stmt -> close();
            $con -> close();
            exit();
        }
    }

    public function register($email, $username, $password)
    {
        $con  = $this->db->getConnection();
        $vector_i = openssl_random_pseudo_bytes(16);

        if($this->getUser($username)){
            header("Location: http://localhost/semestral%202023/views/registro.php?alert=1");
            $con->close();
            exit();
        }
        
        $passwordEncriptado = $this->encriptarPassword($password, $vector_i);

        $sql = "INSERT INTO usuarios (correo, usuario, contrasena, vector_i) VALUES (?,?,?,?)";

        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssss', $email, $username, $passwordEncriptado, $vector_i);
        
        if($stmt->execute()){
            header("Location: http://localhost/semestral%202023/views/login.php?alert=2");
        }else{
            echo "Ha ocurrido un error interno de servidor";
        }
        $stmt->close();
        $con->close();
    }

    public function getUser($username)
    {
        $con = $this->db->getConnection();

        $sql = 'SELECT COUNT(*) FROM usuarios WHERE usuario = ?';

        $stmt = $con->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($count);

        if($stmt->fetch()){
            $stmt->close();
            return $count > 0;
        }else{
            echo "Error interno de servidor";
            $stmt -> close();
            $con -> close();
            exit();
        }
    }

    function encriptarPassword($password, $vector_i){
        return openssl_encrypt($password, $this->m_cifrado, $this->key, $this->option, $vector_i);
    }

    function verificarPassword($password, $storage_password, $vector_i){
        $e_password = $this->encriptarPassword($password, $vector_i);
        return hash_equals($storage_password, $e_password);
    }
}



?>