<?php
    class task{

        // conn
        private $conn;

        // table
        private $dbTable = "tasks";

        // col
        public $id;
        public $name;
        public $user_id;
        public $category_id;
        public $completed;
        public $priority;
       
        
       
      
        // db conn
        public function __construct($db){
            $this->conn = $db;
        }

        // GET group
        public function getPost(){
            $sqlQuery = "SELECT * FROM " . $this->dbTable;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        //CREATE User
        public function createtask(){
          
                $sqlQuery = "INSERT INTO
                        ". $this->dbTable ."
                    SET
                    user_id = :user_id, 
                    category_id = :category_id, 
                    priority = :priority, 
                    completed = :completed, 
                    name = :name";

                $stmt = $this->conn->prepare($sqlQuery);
        
                // sanitize
                $this->user_id=htmlspecialchars(strip_tags($this->user_id));
                $this->category_id=htmlspecialchars(strip_tags($this->category_id));
                $this->name=htmlspecialchars(strip_tags($this->name));
                
                       
                // bind data
                $stmt->bindParam(":user_id", $this->user_id);
                $stmt->bindParam(":category_id", $this->category_id);
                $stmt->bindParam(":name", $this->name);
                $stmt->bindParam(":priority", $this->priority);
                $stmt->bindParam(":completed", $this->completed);
               
                if($stmt->execute()){
                   return true;
                }
                return false;


            
                    
        
            
        }

       // GET User
    //    public function getSingleUser(){
    //     $sqlQuery = "SELECT
    //                 id, 
    //                 user_name, 
    //                 email
    //               FROM
    //                 ". $this->dbTable ."
    //             WHERE 
    //                id = :id
    //             LIMIT 0,1";

    //     $stmt = $this->conn->prepare($sqlQuery);
    //     $stmt->bindParam(":id", $this->id);
    //     $stmt->execute();
    //     $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        
    //     $this->user_name = $dataRow['user_name'];
    //     // $this->last_name = $dataRow['last_name'];
    //     $this->email = $dataRow['email'];
      
    // }      
        

       // UPDATE group
        public function updatePost(){
            $sqlQuery = "UPDATE
                        ". $this->dbTable ."
                    SET
                    name = :name,
                    group_id = :group_id,
                    user_id = :user_id
                    
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->category_id=htmlspecialchars(strip_tags($this->category_id));
            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":category_id", $this->category_id);
            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

    //    // DELETE User
    //     function deleteUser(){
    //         $sqlQuery = "DELETE FROM " . $this->dbTable . " WHERE id = ?";
    //         $stmt = $this->conn->prepare($sqlQuery);
        
    //         $this->id=htmlspecialchars(strip_tags($this->id));
        
    //         $stmt->bindParam(1, $this->id);
        
    //         if($stmt->execute()){
    //             return true;
    //         }
    //         return false;
    //     }

    
      
    }      
?>