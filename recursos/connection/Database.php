<?php
    class Database {
        private $_connection;
        private static $_instance;
        private $_host = 'localhost';
        private $_username = 'root';
        private $_password = '';
        private $_database = 'semestral_2023';


        public static function getInstance()
        {
            if(!self::$_instance)
            {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        //Constructor de la clase
        private function __construct()
        {
            $this -> _connection = new mysqli(
                $this -> _host, $this -> _username, $this -> _password, $this -> _database
            );

            if(mysqli_connect_error())
            {
                trigger_error("Fallo al conectar con la base de datos: " . mysqli_connect_error(), E_USER_ERROR);
            }
        }

         //Evitar duplicidad de conexiones
        private function __clone(){}

        //Obtener conexión
        public function getConnection()
        {
            return $this -> _connection;
        }

        public function closeConnection()
        {
            if ($this -> _connection)
            {
                $this -> _connection -> close();
            }
        }

        public function testConnection()
        {
            $sql = "SELECT 1";
            $result = $this -> _connection -> query($sql);

            if($result)
            {
                echo "Connected Successfully";
            } else {
                echo "Connection Error" . $this -> _connection -> error;
            }
        }
    }

    // $db = Database::getInstance();
    // $db -> testConnection();

    //http://localhost/semestral%202023/recursos/connection/Database.php
?>