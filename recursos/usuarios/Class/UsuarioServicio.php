<?php
class UsuarioServicio{
    private $db;

    public function __construct(Database $db)
    {
        $this -> db = $db;
    }

    public function login($username, $password)
    {
        $con  = $this->db->getConnection();
        $userData = $this->getCredentials($username);
        if(!empty($userData) && $this->verificarPassword($password, $userData['pass'])){
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

        $sql = 'SELECT id_usuario, usuario, rol, contrasena FROM usuarios WHERE usuario = ?';

        $stmt = $con->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($id_usuario, $user, $rol, $contrasena);
        
        if($stmt->fetch()){
            $user_data = array(
                'id' => $id_usuario,
                'username' => $user,
                'rol' => $rol,
                'pass' => $contrasena
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

        if($this->getUser($username)){
            header("Location: http://localhost/semestral%202023/views/registro.php?alert=1");
            $con->close();
            exit();
        }
        

        $sql = "INSERT INTO usuarios (correo, usuario, contrasena) VALUES (?,?,?)";

        $stmt = $con->prepare($sql);
        $stmt->bind_param('sss', $email, $username, $password);
        
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

    function verificarPassword($password, $storage_password){
        return $password === $storage_password;
    }
}



?>