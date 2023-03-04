<?php
    header("Access-Control-Allow-Origin:*");
    header("Content-Type: application/json;");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config.php';
    // include_once './users.php';

    $database = new DB();
    $db = $database->getConnection();
    $data = json_decode(file_get_contents("php://input"));
    $user_id = $data->user_id;
    $categoryName = $data->categoryName;
    $status =$data->status;
    // print_r($data);
    // print_r(json_encode($tasks));

    $sql = "SELECT * FROM tasks WHERE tasks.user_id = $user_id";
    if( $status &&  $categoryName){
        $sql .= " AND completed = '$status' AND category_id = $categoryName";
        // echo "category $categoryName , status $status";
    }
    if( $status && !$categoryName){
        $sql .= " AND completed = '$status'";
        // echo "category $categoryName , status $status";
    }
    if($categoryName && !$status){
        $sql .= " AND category_id = $categoryName";
        // echo "category $categoryName , status $status";
    }
    $stmt = $db->prepare($sql);
    // $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r(json_encode($tasks));
?>