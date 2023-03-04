<?php
    class User{

        // conn
        private $conn;

        // table
        private $dbTable = "users";

        // col
        public $id;
        public $name;
        public $email;
        public $password;
       
      
        // db conn
        public function __construct($db){
            $this->conn = $db;
        }

        // GET Users
        public function getUsers(){
            $sqlQuery = "SELECT * FROM " . $this->dbTable;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE User
        public function createUser(){
            $oldData="SELECT * FROM users WHERE email = '$this->email' ";
            $stmt = $this->conn->prepare($oldData);
            $stmt->execute();
            $checkEmail = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if($checkEmail == []){
                $sqlQuery = "INSERT INTO
                        ". $this->dbTable ."
                    SET
                    name = :name, 
                    email = :email, 
                    password = :password";
                $stmt = $this->conn->prepare($sqlQuery);
        
                // sanitize
                $this->name=htmlspecialchars(strip_tags($this->name));
                $this->password=htmlspecialchars(strip_tags($this->password));
                $this->email=htmlspecialchars(strip_tags($this->email));
                // bind data
                $stmt->bindParam(":name", $this->name);
                $stmt->bindParam(":password", $this->password);
                $stmt->bindParam(":email", $this->email);
                if($stmt->execute()){
                    return true;
                }
                return false;


            } else {
                echo 'Your Email is Already Exist';
            }
            
                    
        
            
        }

       // GET User
       public function getSingleUser(){
        $sqlQuery = "SELECT
                    id, 
                    name, 
                    email
                  FROM
                    ". $this->dbTable ."
                WHERE 
                   id = :id
                LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->name = $dataRow['name'];
        // $this->last_name = $dataRow['last_name'];
        $this->email = $dataRow['email'];
      
    }      
        

        // UPDATE User
        public function updateUser(){
            $sqlQuery = "UPDATE
                        ". $this->dbTable ."
                    SET
                    name = :name, 
                    email = :email,
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

       // DELETE User
        function deleteUser(){
            $sqlQuery = "DELETE FROM " . $this->dbTable . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    
        public function findUser (){
            $sqlQuery = "SELECT
                        *
                        FROM
                        ". $this->dbTable ."
                        WHERE email = :email AND password = :password LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            return $dataRow;
            if ($dataRow) {
                echo (json_decode($dataRow));
            }else {
                echo "user not found";
            }

            

        }
    }      
?>