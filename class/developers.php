<?php
    class Developer{
        private $conn;
        private $db_table = "developers";

        public $id;
        public $nome;
        public $sexo;
        public $idade;
        public $hobby;
        public $dnascto;
        public function __construct($db){
            $this->conn = $db;
        }
        public function getDevelopers(){
            $sqlQuery = "SELECT id, nome, sexo, idade, hobby, DATE_FORMAT(dnascto, '%d/%m/%Y') dnascto FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        public function createDeveloper(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    (
                        nome, 
                        sexo, 
                        idade, 
                        hobby, 
                        dnascto
                    )
                    VALUES (
                        :nome, 
                        :sexo, 
                        :idade, 
                        :hobby, 
                        :dnascto
                    )";
            
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->nome=htmlspecialchars(strip_tags($this->nome));
            $this->sexo=htmlspecialchars(strip_tags($this->sexo));
            $this->idade=htmlspecialchars(strip_tags($this->idade));
            $this->hobby=htmlspecialchars(strip_tags($this->hobby));
            $this->dnascto=htmlspecialchars(strip_tags($this->dnascto));
        
            $mysqldate = explode('/',$this->dnascto);
            $mysqldate_ = $mysqldate[2].'-'.$mysqldate[1].'-'.$mysqldate[0];
            $stmt->bindValue(':dnascto', $mysqldate_, PDO::PARAM_STR);
        
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':sexo', $this->sexo);
            $stmt->bindValue(':idade', $this->idade);
            $stmt->bindValue(':hobby', $this->hobby);

            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function getSingleDeveloper(){
            $sqlQuery = "SELECT
                        id, 
                        nome, 
                        sexo, 
                        idade, 
                        hobby, 
                        DATE_FORMAT(dnascto, '%d/%m/%Y') dnascto
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->nome = $dataRow['nome'];
            $this->sexo = $dataRow['sexo'];
            $this->idade = $dataRow['idade'];
            $this->hobby = $dataRow['hobby'];
            $this->dnascto = $dataRow['dnascto'];
        }        

        public function updateDeveloper(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        nome = :nome, 
                        sexo = :sexo, 
                        idade = :idade, 
                        hobby = :hobby, 
                        dnascto = DATE_FORMAT(:dnascto, '%Y-%m-%d')
                    WHERE 
                        id = :id";
            
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->nome=htmlspecialchars(strip_tags($this->nome));
            $this->sexo=htmlspecialchars(strip_tags($this->sexo));
            $this->idade=htmlspecialchars(strip_tags($this->idade));
            $this->hobby=htmlspecialchars(strip_tags($this->hobby));
            $this->dnascto=htmlspecialchars(strip_tags($this->dnascto));
            $this->id=htmlspecialchars(strip_tags($this->id));

            $mysqldate = explode('/',$this->dnascto);
            $mysqldate_ = $mysqldate[2].'-'.$mysqldate[1].'-'.$mysqldate[0];
            $stmt->bindValue(':dnascto', $mysqldate_, PDO::PARAM_STR);

            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':sexo', $this->sexo);
            $stmt->bindParam(':idade', $this->idade);
            $stmt->bindParam(':hobby', $this->hobby);
            $stmt->bindParam(':dnascto', $mysqldate_);
            $stmt->bindParam(':id', $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        function deleteDeveloper(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>
