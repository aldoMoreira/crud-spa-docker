<?php 
    class Database {
        private $host = "172.17.0.3";
        private $database_name = "proficiencia";
        private $username = "root";
        private $password = "master";

        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "BD não conectado: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>
 